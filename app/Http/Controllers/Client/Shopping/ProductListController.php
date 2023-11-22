<?php

namespace App\Http\Controllers\Client\Shopping;
// ! no used !
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductList;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function index(Request $request){

        $user = Auth::user()->id;

        $productsOnList = ProductList::where('user_id', $user)
                        ->with(['inventories',
                                'inventories.product.file' => fn($sq3) =>
                                $sq3->where('file_type', 'imagenes')
                                    ->where('category', 'products')
                                ])->get();

        if ($request->ajax()) {

            $html = view('client.products.render.list-selected-products', compact('productsOnList'))->render();
            return[
                'html' => $html
            ];

        }

        return view('client.products.selected-products', compact('productsOnList'));
    }

    public function addShoppingCart(){
        //
    }




    public function subtractCuantity(Inventory $id){

        $inventory = Inventory::find($id);
        $user_id = Auth::user()->id;

        $productLists = ProductList::where('user_id', $user_id)
                        ->with(['inventories' => function ($query) use ($inventory) {
                            $query->where('inventory_id', $inventory->id);
                        }])->get();

        foreach ($productLists as $productList ) {
            foreach ($productList->inventories as $inventory) {

                if ($inventory->stock != 0 and $inventory->pivot->quantity > 1) {
                    $newQuantity = $inventory->pivot->quantity - 1;
                    $productList->inventories()->updateExistingPivot($inventory->id, ["quantity" => $newQuantity]);
                    $message = true;
                } else{
                    $message = false;
                }
            }
        }

        return response()->json([
            'message' => $message
        ]);
    }






    public function addCuantity($id){

        $inventory = Inventory::find($id);
        $user_id = Auth::user()->id;

        $productLists = ProductList::where('user_id', $user_id)
                        ->with(['inventories' => function ($query) use ($inventory) {
                            $query->where('inventory_id', $inventory->id);
                        }])->get();

        foreach ($productLists as $productList ) {
            foreach ($productList->inventories as $inventory) {

                if ($inventory->stock != 0 and $inventory->pivot->quantity < 10)  {
                    $newQuantity = $inventory->pivot->quantity + 1;
                    $productList->inventories()->updateExistingPivot($inventory->id, ["quantity" => $newQuantity]);
                    $message = true;
                } else{
                    $message = false;
                }
            }
        }

        return response()->json([
            'message' => $message
        ]);
    }


}
