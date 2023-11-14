<?php

namespace App\Http\Controllers\Company\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $service)
    {
        $this->productService = $service;
    }

    public function index(){

        $user = Auth::User();
        $products = $this->productService->getProducts($user->id);
        $productTypes = config('parameters.productTypes');

        return view('company.products.index', compact('products', 'productTypes'));

    }

    public function create(){

        $productTypes = config('parameters.productTypes');
        return view('company.products.create-product', compact('productTypes'));

    }

    public function store(Request $request){

        $storage = env('FILESYSTEM_DRIVER');

        try {
            $this->productService->store($request, $storage);
            $success = true;
            $message = config('parameters.stored_message_ product');
        } catch (Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            "success" => $success,
            "message" => $message
        ]);

    }

    public function getMoreProducts(Request $request ){

        $user = Auth::User();

        if ($request->ajax()) {

            $products = $this->productService->getProducts($user->id);

            return view('company.products.render.query-products', compact('products'))->render();

        }
    }

    public function edit(Product $product){

        $product->loadImage();

        $type = config('parameters.productTypes')[$product->product_type ?? '-'];

        return response([

            'product' => $product,
            'type' => $type,
            'productTypes' => config('parameters.productTypes'),
            'url_img' => verifyImage($product->file),

        ]);

    }

    public function update(Request $request, $id){

        $storage = env('FILESYSTEM_DRIVER');
        $product = Product::find($id);
        try {
            $success = $this->productService->update($request, $product, $storage);
            $message = config('parameters.updated_message');
        } catch (Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            "product" => $product,
            "success" => $success,
            "message" => $message
        ]);
    }

    public function destroy($id){

        $product = Product::find($id);
        $storage = env('FILESYSTEM_DRIVER');

        try {
            $success = $this->productService->deleteProductAndImage($product, $storage);
        } catch (Exception $e) {
            $success = false;
        }

        return response()->json([
            "success" => $success
        ]);

    }

}
