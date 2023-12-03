<?php

namespace App\Http\Controllers;

use App\Models\DiscountCoupion;
use App\Models\Sale;
use App\Models\Shopping;
use Http;
use Illuminate\Http\Request;
use Auth;

class WebhooksController extends Controller
{
    public function __invoke(Shopping $shopping, Request $request)
    {

        $payment_id = $request->get('payment_id');
        $response = Http::get('https://api.mercadopago.com/v1/payments/' . $payment_id . '?access_token=' . config('services.mercadopago.token'));
        $response = json_decode($response);
        $status = $response->status;

        // obtener relaciónes
        $user = Auth::user();
        $inventoriesOnShopping = $user->shopping()
            ->with('inventories')
            ->get();

        $subTotal = $inventoriesOnShopping->sum(function ($shopping) {
            return $shopping->inventories->sum(function ($inventory) {
                return $inventory->on_sale ? $inventory->discounted_price * $inventory->pivot->quantity : $inventory->price * $inventory->pivot->quantity;
            });
        });

        $total = $inventoriesOnShopping[0]->discountCoupion ? $subTotal - ($subTotal * $inventoriesOnShopping[0]->discountCoupion->discount) / 100 : $subTotal;

        // orden de compra creada
        $idDiscounted = $inventoriesOnShopping[0]->discount_coupion_id ? $inventoriesOnShopping[0]->discount_coupion_id : null;
        $order = $user->order()->create([
            'discount_coupion_id' => $idDiscounted,
            'operation_number' => $payment_id,
            'subtotal' => $subTotal,
            'total' => $total,
            'status' => $status
        ]);

        $discount_coupion = null;
        if ($idDiscounted != null) {
            $discount_coupion = DiscountCoupion::find($idDiscounted);
            $discount_coupion->uses += 1;
            $discount_coupion->save();
        }

        foreach ($inventoriesOnShopping[0]->inventories as $inventory) {

            $quantity = $inventory->pivot->quantity;
            $inventory->stock -= $quantity;
            $inventory->save();
            // 1. si esta en oferta
            // 2. si no esta en oferta
            $subtotal = $inventory->on_sale ? $inventory->discounted_price * $quantity : $inventory->price * $quantity;

            $order->inventories()->attach($inventory->id, [
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);
        }

        $this->createOrderSale($inventoriesOnShopping, $discount_coupion, $payment_id, $subTotal, $total);

        // vaciar el carrito
        $shopping = $user->shopping()->first();
        $shopping->inventories()->sync([]);
        $shopping->discount_coupion_id = null;
        $shopping->save();


        // return $total;
        return redirect()->route('client.order.view', compact('order'));
    }



    public function createOrderSale($inventoriesOnShopping, $discount_coupion = null, $payment_id, $subtotal, $total)
    {
        $inventoriesForFarmacia = $inventoriesOnShopping->flatMap(function ($shopping) {
            return $shopping->inventories;
        })->groupBy('user_id');

        $subtotalSinDescuento = $subtotal;
        $totalConDescuento = $total;

        $porcentajeDescuento = 1 - ($totalConDescuento / $subtotalSinDescuento);

        foreach ($inventoriesForFarmacia as $farmaceutico_id => $inventories) {
            $ordenVenta = new Sale();
            $ordenVenta->user_id = $farmaceutico_id;
            $ordenVenta->operation_number_sale = $payment_id;

            $totalSinDescuentoFarmaceutico = $inventories->sum(function ($inventory) {
                return $inventory->on_sale ? $inventory->discounted_price * $inventory->pivot->quantity : $inventory->price * $inventory->pivot->quantity;
            });

            $totalConDescuentoFarmaceutico = $totalSinDescuentoFarmaceutico * (1 - $porcentajeDescuento);

            $ordenVenta->total = $totalConDescuentoFarmaceutico;
            $ordenVenta->save();

            foreach ($inventories as $inventory) {
                $precio = $inventory->on_sale ? $inventory->discounted_price : $inventory->price;
                $subtotalProducto = $precio * $inventory->pivot->quantity;
                $subtotalProductoConDescuento = $subtotalProducto * (1 - $porcentajeDescuento);

                $ordenVenta->inventories()->attach($inventory->id, [
                    'quantity' => $inventory->pivot->quantity,
                    'subtotal' => $subtotalProductoConDescuento,
                ]);
            }
        }
    }




}
