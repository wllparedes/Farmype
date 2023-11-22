<?php


namespace App\Services;

use App\Models\Inventory;
use App\Models\ProductList;
use Auth;
use Illuminate\Http\Request;

class ClientListService
{

    public function getInventoryOnList(Request $request)
    {
        $user = Auth::user();

        $productsOnList = $user->productList()
            ->with([
                'inventories',
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

}












