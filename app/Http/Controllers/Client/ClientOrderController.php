<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupion;
use App\Models\Order;
use App\Models\Shopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;

class ClientOrderController extends Controller
{

    public function index(Request $request)
    {

        $orderDetail = Order::with([
            'discountCoupion',
            'inventories.user',
            'inventories' => function ($query) {
                $query->with([
                    'product' => function ($query) {
                        $query->with([
                            'file' => function ($query) {
                                $query->where('file_type', 'imagenes')
                                    ->where('category', 'products');
                            }
                        ]);
                    }
                ]);
            }
        ])->paginate(6);

        if ($request->ajax()) {
            $html = view('client.order.render.order', compact('orderDetail'))->render();

            return [
                'html' => $html
            ];
        }




        return view("client.order.index", compact('orderDetail'));
    }


    public function view(Order $order)
    {

        $orderDetail = $order->load([
            'discountCoupion',
            'inventories' => function ($query) {
                $query->with([
                    'product' => function ($query) {
                        $query->with([
                            'file' => function ($query) {
                                $query->where('file_type', 'imagenes')
                                    ->where('category', 'products');
                            }
                        ]);
                    }
                ]);
            }
        ]);


        return view('client.order.view', compact('orderDetail'));
    }


    public function pay(Shopping $shopping, Request $request)
    {

        $payment_id = $request->get('payment_id');
        $response = Http::get('https://api.mercadopago.com/v1/payments/' . $payment_id . '?access_token=' . config('services.mercadopago.token'));
        $response = json_decode($response);
        $status = $response->status;

        // obtener relaciónes
        $user = Auth::user();
        $inventoriesOnShopping = $user->shopping()
            ->with([
                'inventories' => function ($query) {
                    $query->with([
                        'product' => function ($query) {
                            $query->with([
                                'file' => function ($query) {
                                    $query->where('file_type', 'imagenes')
                                        ->where('category', 'products');
                                }
                            ]);
                        }
                    ]);
                }
            ])
            ->get();


        // orden de compra creada
        $idDiscounted = $inventoriesOnShopping[0]->discount_coupion_id ? $inventoriesOnShopping[0]->discount_coupion_id : null;
        $orderNew = [
            'discount_coupion_id' => $idDiscounted,
            'operation_number' => $payment_id,
            'status' => $status
        ];

        $order = $user->order()->create($orderNew);

        $total = 0;

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
            $total += $subtotal;

            $order->inventories()->attach($inventory->id, [
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);

        }

        $order->total = $total;
        $order->save();
        // vaciar el carrito
        $shopping = $user->shopping()->first();
        $shopping->inventories()->sync([]);
        $shopping->discount_coupion_id = null;
        $shopping->save();



        return redirect()->route('client.order.view', compact('order'));

    }


}
