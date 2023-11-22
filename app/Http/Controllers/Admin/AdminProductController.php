<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\ParentCategory;
use App\Models\Product;
use App\Services\AdminProductService;
use Auth;
use Exception;
use Illuminate\Http\Request;

// use Request;

class AdminProductController extends Controller
{
    protected $adminProductService;
    public function __construct(AdminProductService $adminProductService)
    {
        $this->adminProductService = $adminProductService;
    }


    public function index(Request $request)
    {
        $products = Product::paginate(8);

        if ($request->ajax()) {

            $products = view("admin.products.render.query-products", compact("products"))->render();

            return [
                'html' => $products
            ];

        }

        return view("admin.products.index", compact("products"));

    }

    public function edit(Product $product)
    {

        $product->loadImage();

        return response([
            'product' => $product,
            'url_img' => verifyImage($product->file),
        ]);

    }


    public function update(Request $request, Product $product)
    {

        $storage = env('FILESYSTEM_DRIVER');
        try {
            $success = $this->adminProductService->update($request, $product, $storage);
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



    public function create()
    {

        $parentCategories = ParentCategory::all();
        return view("admin.products.create-products", compact("parentCategories"));

    }

    public function store(Request $request)
    {
        $storage = env('FILESYSTEM_DRIVER');

        try {
            $this->adminProductService->store($request, $storage);
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

    public function getChildCategories(Request $request)
    {

        $valueParentCategory = $request->all();
        $parentCategory_id = $valueParentCategory['valueParent'];
        $parentCategory = ParentCategory::find($parentCategory_id);
        $childCategories = $parentCategory->childCategories()->get();

        return response()->json([
            'childCategories' => $childCategories,
        ]);
    }


    public function destroy($id)
    {

        $product = Product::find($id);
        $storage = env('FILESYSTEM_DRIVER');

        try {
            $success = $this->adminProductService->deleteProductAndImage($product, $storage);
        } catch (Exception $e) {
            $success = false;
        }

        return response()->json([
            "success" => $success
        ]);

    }


}
