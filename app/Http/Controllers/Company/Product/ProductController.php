<?php

namespace App\Http\Controllers\Company\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
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

        $productTypes = config('parameters.productTypes');
        return view('company.products.index', compact('productTypes'));
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

}
