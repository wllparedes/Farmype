<?php


namespace App\Services;

use App\Models\Inventory;
use App\Models\ProductList;
use App\Models\Shopping;
use Auth;
use Exception;
use Illuminate\Http\Request;

class ClientListService
{

    public function getInventoryOnList(Request $request)
    {
        $user = Auth::user();
        $list = $user->productList()->first();
        $list = !$list ? ProductList::create(['user_id' => $user->id]) : $list;

        $productsOnList = $user->productList()
            ->with([
                'inventories',
                'inventories.user',
                'inventories.product.file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products')
            ])->get();

        if ($request->ajax()) {

            $html = view('client.products.render.list-selected-products', compact('productsOnList'))->render();
            return [
                'html' => $html
            ];

        }
        return view('client.products.selected-products', compact('productsOnList'));
    }

    public function subtractCuantity(Inventory $inventory)
    {

        $user = Auth::user();

        $productLists = $user->productList()
            ->with([
                'inventories' => function ($query) use ($inventory) {
                    $query->where('inventory_id', $inventory->id);
                }
            ])->get();

        foreach ($productLists as $productList) {
            foreach ($productList->inventories as $inventory) {

                if ($inventory->stock != 0 and $inventory->pivot->quantity > 1) {
                    $newQuantity = $inventory->pivot->quantity - 1;
                    $productList->inventories()->updateExistingPivot($inventory->id, ["quantity" => $newQuantity]);
                    $message = true;
                } else {
                    $message = false;
                }
            }
        }

        return response()->json([
            'message' => $message
        ]);
    }


    public function addCuantity(Inventory $inventory)
    {

        $user = Auth::user();

        $productLists = $user->productList()
            ->with([
                'inventories' => function ($query) use ($inventory) {
                    $query->where('inventory_id', $inventory->id);
                }
            ])->get();

        foreach ($productLists as $productList) {
            foreach ($productList->inventories as $inventory) {

                if ($inventory->stock != 0 and $inventory->pivot->quantity < 10) {
                    $newQuantity = $inventory->pivot->quantity + 1;
                    $productList->inventories()->updateExistingPivot($inventory->id, ["quantity" => $newQuantity]);
                    $message = true;
                } else {
                    $message = false;
                }
            }
        }

        return response()->json([
            'message' => $message
        ]);
    }

    public function deleteInventoryOfList(Inventory $inventory)
    {
        $user = Auth::user();
        $productList = $user->productList->first();
        $productList->inventories()->detach($inventory);

        return response()->json([
            'message' => "Producto eliminado de tu lista"
        ]);
    }

    public function addShoppingCart(Inventory $inventory)
    {

        $user = Auth::user();
        $inventory = $user->productList()
            ->with([
                'inventories' => function ($query) use ($inventory) {
                    $query->where('inventory_id', $inventory->id);
                }
            ])->get();

        $shoppingCart = $user->shopping()->first();
        $shoppingCart = !$shoppingCart ? Shopping::create(['user_id' => $user->id]) : $shoppingCart;

        foreach ($inventory as $inv) {
            foreach ($inv->inventories as $inventory) {
                try {

                    if ($inventory->stock == 0 or $inventory->pivot->quantity > $inventory->stock) {
                        $message = "Producto sin stock suficiente";
                        $success = false;
                        break;
                    }

                    $shoppingCart->inventories()->attach($inventory->id, ['quantity' => $inventory->pivot->quantity]);


                    // *****

                    // if($inventory->on_sale){
                    //     $subtotal = $inventory->pivot->quantity * $inventory->discounted_price;
                    // }else{
                    //     $subtotal = $inventory->pivot->quantity * $inventory->price;
                    // }

                    // $sub_totalEnd = $shoppingCart->subtotal + $subtotal;
                    // $shoppingCart->update(['subtotal' => $sub_totalEnd]);

                    // *****

                    $message = "Producto añadido a tu carrito";
                    $success = true;

                } catch (Exception $e) {

                    $message = "Ha ocurrido un error, vuelve a intentarlo";
                    $success = 'error';

                }
                break;
            }
            break;
        }
        return response()->json([
            'message' => $message,
            'success' => $success,
        ]);

    }


    public function addShoppingCartDirect(Inventory $inventory)
    {
        $user = Auth::user();

        try {
            $shoppingCart = $user->shopping()->first();
            $shoppingCart = !$shoppingCart ? Shopping::create(['user_id' => $user->id]) : $shoppingCart;

            if ($inventory->stock > 0) {
                $shoppingCart->inventories()->attach($inventory->id, ['quantity' => 1]);
                $message = "Producto añadido a tu carrito";
                $success = true;
            } else {
                $message = "Producto sin stock suficiente";
                $success = false;
            }

        } catch (Exception $e) {
            $message = $e->getMessage();
            $success = 'error';
        }

        return response()->json([
            'message' => $message,
            'success' => $success,
        ]);

    }


}












