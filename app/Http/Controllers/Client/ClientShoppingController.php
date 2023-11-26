<?php

namespace App\Http\Controllers\Client;

use App\Models\Inventory;
use Auth;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ClientShoppingController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();

        $inventoriesOnShopping = $user->shopping()
            ->with([
                'user',
                'inventories',
                'inventories.user',
                'inventories.product.file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products')
            ])->get();

        if ($request->ajax()) {

            $prodcuts = view("client.shopping-cart.render.render-shopping", compact('inventoriesOnShopping'))->render();
            return [
                'html' => $prodcuts,
            ];
        }

        return view("client.shopping-cart.index", compact('inventoriesOnShopping'));
    }


    public function emptyShoppingCart()
    {

        try {
            $user = Auth::user();
            $shopping = $user->shopping()->first();

            $shopping->inventories()->sync([]);

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



}
