<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductList;
use Auth;
use Illuminate\Http\Request;



class ClientInventoryService
{

    public function getProducts()
    {
        $products = Product::with([
            'file' => fn($sq3) =>
                $sq3->where('file_type', 'imagenes')
                    ->where('category', 'products')
        ])->paginate(8);

        return view('client.products.index', compact('products'));
    }

    public function getView(Product $product, Request $request)
    {

        $user = Auth::user();

        if ($user->productList) {
            $inventoryListId = $user->productList->value('id');
        } else {
            $productList = new ProductList;
            $user->productList()->save($productList);
            $inventoryListId = $productList->id;
        }
        $inventories = $product->inventories()
            ->withCount([
                'productLists' => function ($query) use ($inventoryListId) {
                    $query->where('product_lists_id', $inventoryListId);
                }
            ])
            ->with([
                'user',
                'product',
                'product.childCategories',
                'product.childCategories.parentCategory',
                'product.file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products')
            ])
            ->paginate(8);

        if ($request->ajax()) {
            $inventories = view('client.products.render.render-products', compact('inventories'))->render();
            return [
                'html' => $inventories,
            ];
        }
        return view('client.products.view-product', compact('inventories'));
    }


    public function addInventoryOnList(Inventory $inventory)
    {

        $user = Auth::user();
        $productList = $user->productList->first();

        if (!$productList) {
            $productList = ProductList::create(['user_id' => $user->id]);
        }

        $productList->inventories()->attach($inventory);
        return response()->json([
            'message' => 'Producto añadido a tu lista',
        ]);

    }

    public function deleteInventoryOnList(Inventory $inventory)
    {

        $user = Auth::user();
        $productList = $user->productList->first();
        $productList->inventories()->detach($inventory);

        return response()->json([
            'message' => 'Producto eliminado de tu lista',
        ]);


    }





}



