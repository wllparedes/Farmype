<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductList;
use App\Services\ProductService;
use Auth;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    protected $productService;

    function __construct(ProductService $service)
    {
        $this->productService = $service;
    }

    // public function reindex(Request $request)
    // {

    //     $user_id = Auth::user()->id;
    //     $productListId = ProductList::where('user_id', $user_id)->value('id');

    //     $products = Product::withCount([
    //         'productLists' => function ($query) use ($productListId) {
    //             $query->where('product_lists_id', $productListId);
    //         }
    //     ])
    //         ->with([
    //             'file' => fn($sq3) =>
    //                 $sq3->where('file_type', 'imagenes')
    //                     ->where('category', 'products')
    //         ])
    //         ->paginate(8);

    //     if ($request->ajax()) {

    //         $products = view('client.products.render.query-products', compact('products'))->render();

    //         return [
    //             'html' => $products,
    //         ];

    //     }

    //     return view('client.products.index', compact('products'));
    // }

    public function index()
    {

        $products = Product::with([
            'file' => fn($sq3) =>
                $sq3->where('file_type', 'imagenes')
                    ->where('category', 'products')
        ])->paginate(8);

        return view('client.products.index', compact('products'));
    }



    public function view(Product $product, Request $request)
    {
        $user_id = Auth::user()->id;
        $inventoryListId = ProductList::where('user_id', $user_id)->value('id');

        $inventories = $product->inventories()
            ->withCount([
                'productLists' => function ($query) use ($inventoryListId) {
                    $query->where('product_lists_id', $inventoryListId);
                }
            ])
            ->with([
                'user',
                'product',
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



    public function add(Inventory $inventory)
    {

        $id = Auth::user()->id;
        $productList = ProductList::where('user_id', $id)->first();

        if (!$productList) {
            $productList = ProductList::create(['user_id' => $id]);
        }

        $productList->inventories()->attach($inventory);
        return response()->json([
            'message' => 'Producto añadido a tu lista',
        ]);

    }

    public function delete(Inventory $inventory)
    {

        $id = Auth::user()->id;

        $productList = ProductList::where('user_id', $id)->first();
        $productList->inventories()->detach($inventory);

        return response()->json([
            'message' => 'Producto eliminado de tu lista',
        ]);

    }

}
