<?php

namespace App\Http\Controllers\Client\Shopping;

use App\Http\Controllers\Controller;
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
                        ->with(['products',
                                'products.file' => fn($sq3) =>
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

    public function subtractCuantity($id){

        $product = Product::find($id);
        $user_id = Auth::user()->id;

        $productLists = ProductList::where('user_id', $user_id)
                        ->with(['products' => function ($query) use ($product) {
                            $query->where('product_id', $product->id);
                        }])->get();

        foreach ($productLists as $productList ) {
            foreach ($productList->products as $product) {

                if ($product->stock != 0 and $product->pivot->quantity > 1) {
                    $newQuantity = $product->pivot->quantity - 1;
                    $productList->products()->updateExistingPivot($product->id, ["quantity" => $newQuantity]);
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

        $product = Product::find($id);
        $user_id = Auth::user()->id;

        $productLists = ProductList::where('user_id', $user_id)
                        ->with(['products' => function ($query) use ($product) {
                            $query->where('product_id', $product->id);
                        }])->get();

        foreach ($productLists as $productList ) {
            foreach ($productList->products as $product) {

                if ($product->stock != 0 and $product->pivot->quantity < 10)  {
                    $newQuantity = $product->pivot->quantity + 1;
                    $productList->products()->updateExistingPivot($product->id, ["quantity" => $newQuantity]);
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
