<?php

namespace App\Http\Controllers\Client;

use App\Models\DiscountCoupion;
use App\Models\Inventory;
use App\Models\Shopping;
use Auth;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

// use LaravelMercadoPago\MercadoPago;
use LaravelMercadoPago\Facades\MercadoPago;



class ClientShoppingController extends Controller
{
    public function index(Request $request)
    {
        MercadoPago::initSdk(config('services.mercadopago.token'));
        $preference = MercadoPago::preference();
        $item = MercadoPago::item();
        $user = Auth::user();

        $preference->auto_return = 'approved';

        $shopping = $user->shopping()->first();
        if (!$shopping) {
            $shopping = Shopping::create([
                'user_id' => $user->id,
            ]);
        }


        $inventoriesOnShopping = $user->shopping()
            ->with([
                'user:id,address,district,province,departament',
                'discountCoupion:id,code,discount',
                'inventories',
                'inventories.user:id,names_surnames',
                'inventories.product.file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products')
            ])->get();

        $preference->back_urls = [
            'success' => route('client.order.pay'),
        ];

        if ($request->ajax()) {

            $prodcuts = view("client.shopping-cart.render.render-shopping", compact('inventoriesOnShopping', 'preference', 'item'))->render();
            return [
                'html' => $prodcuts,
                'key' => config('services.mercadopago.key'),
                'id' => $preference->id,
            ];
        }

        return view("client.shopping-cart.index", compact('inventoriesOnShopping', 'preference', 'item'));
    }


    public function emptyShoppingCart()
    {

        try {
            $user = Auth::user();
            $shopping = $user->shopping()->first();

            $shopping->inventories()->sync([]);
            $shopping->discount_coupion_id = null;
            $shopping->save();

            $message = 'Carrito de compras vaciado correctamente';
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return response()->json([
            'message' => $message,
            'success' => true,
        ]);
    }



    public function addCuantity(Inventory $inventory)
    {

        $user = Auth::user();

        $inventoriesShopping = $user->shopping()->with([
            'inventories' => function ($query) use ($inventory) {
                $query->where('inventory_id', $inventory->id);
            }
        ])->get();

        foreach ($inventoriesShopping as $inventoryShopping) {
            foreach ($inventoryShopping->inventories as $inventory) {
                try {

                    if ($inventory->stock != 0 and $inventory->pivot->quantity < 10 and $inventory->pivot->quantity < $inventory->stock) {
                        $newQuantity = $inventory->pivot->quantity + 1;
                        $inventoryShopping->inventories()->updateExistingPivot($inventory->id, ["quantity" => $newQuantity]);
                        $success = true;
                    } else {
                        $success = false;
                    }

                } catch (Exception $e) {
                    $success = 'error';
                }
                break;
            }
            break;
        }

        return response()->json([
            'success' => $success
        ]);
    }

    public function subtractCuantity(Inventory $inventory)
    {

        $user = Auth::user();
        $shoppingCart = $user->shopping()->get();
        $inventoriesShopping = $user->shopping()->with([
            'inventories' => function ($query) use ($inventory) {
                $query->where('inventory_id', $inventory->id);
            }
        ])->get();

        foreach ($inventoriesShopping as $inventoryShopping) {
            foreach ($inventoryShopping->inventories as $inventory) {
                try {

                    if ($inventory->stock != 0 and $inventory->pivot->quantity > 1) {
                        $newQuantity = $inventory->pivot->quantity - 1;
                        $inventoryShopping->inventories()->updateExistingPivot($inventory->id, ["quantity" => $newQuantity]);
                        $success = true;
                    } else {
                        $success = false;
                    }

                } catch (Exception $e) {
                    $success = 'error';
                }
                break;
            }
            break;
        }

        return response()->json([
            'success' => $success
        ]);
    }


    public function deleteInventoryOfShopping(Inventory $inventory)
    {

        $user = Auth::user();
        $shoppingCart = $user->shopping()->first();
        $shoppingCart->inventories()->detach($inventory);

        return response()->json([
            'message' => "Producto eliminado de tu carrito"
        ]);
    }


    public function verifycoupions(Request $request)
    {

        $user = Auth::user();
        $data = $request->all();

        try {
            $discountCoupions = DiscountCoupion::select('id', 'code', 'discount', 'is_active', 'max_uses', 'uses')
                ->where('is_active', 1)
                ->where('code', $data['code'])
                ->first();

            $discountCoupions = isset($discountCoupions) ? $discountCoupions : null;

            $success = $discountCoupions == null ? false : true;

            if ($success) {

                if ($discountCoupions->max_uses > $discountCoupions->uses) {

                    $user->shopping()->update([
                        'discount_coupion_id' => $discountCoupions->id
                    ]);

                } else {
                    $success = false;
                }

            }


        } catch (Exception $e) {
            $success = false;
        }

        return response()->json([
            'success' => $success,
        ]);
    }


    public function deleteDiscountCoupion()
    {

        $user = Auth::user();
        $shopping = $user->shopping()->first();
        $shopping->discount_coupion_id = null;
        $shopping->save();

        return response()->json([
            'success' => true,
            'message' => "Cupón de descuento eliminado correctamente"
        ]);
    }


}
