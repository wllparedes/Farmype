<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductList;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientInventoryService
{

    public function getProducts(Request $request)
    {
        $products = Product::with([
            'file' => fn ($sq3) =>
            $sq3->where('file_type', 'imagenes')
                ->where('category', 'products')
        ])->paginate(8);

        if ($request->ajax()) {
            $products = view('client.products.render.query-products', compact('products'))->render();
            return [
                'html' => $products,
            ];
        }

        return view('client.products.index', compact('products'));
    }

    public function getView(Product $product, Request $request)
    {

        $user = Auth::user();

        if ($user->productList) {
            $inventoryListId = $user->productList()->value('id');
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
            ]);

        if ($request->has('companyId')) {

            $companyId = $request->companyId;

            if ($companyId) {
                $inventories->whereHas('user', function ($query) use ($request) {
                    $query->where('id', $request->companyId);
                });
            }
        }

        $inventories = $inventories->with([
            'user',
            'product',
            'product.childCategories',
            'product.childCategories.parentCategory',
            'product.file' => fn ($sq3) =>
            $sq3->where('file_type', 'imagenes')
                ->where('category', 'products')
        ])
            ->paginate(8);

        if ($request->has('companyId')) {

            $companyId = $request->companyId;
            $view = view('client.products.render.products-nearby', compact('inventories'))->render();

            return [
                'html' => $view,
            ];
        }

        if ($request->ajax()) {
            $inventories = view('client.products.render.render-products', compact('inventories', 'product'))->render();
            return [
                'html' => $inventories,
            ];
        }
        return view('client.products.view-product', compact('inventories', 'product'));
    }


    public function addInventoryOnList(Inventory $inventory)
    {

        $user = Auth::user();
        $productList = $user->productList()->first();

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
        $productList = $user->productList()->first();
        $productList->inventories()->detach($inventory);

        return response()->json([
            'message' => 'Producto eliminado de tu lista',
        ]);
    }

    public function getCompaniesNearby(Request $request)
    {

        $client = Auth::user();

        $client->load('location');

        if (!$client->location) {
            return collect([]);
        }

        $latitude = floatval($client->location->latitude);
        $longitude = floatval($client->location->longitude);

        $companies = User::where('role', 'company')
            ->has('location')
            ->with('location')
            ->get();

        $radio = 2.5;

        $companiesNearby = $companies->filter(function ($company) use ($radio, $latitude, $longitude) {

            $distance = $this->calculateDistance(
                $latitude,
                $longitude,
                $company->location->latitude,
                $company->location->longitude
            );

            return $distance <= $radio;
        });

        return $companiesNearby->map(function ($company) {
            return [
                'value' => $company->id,
                'label' => $company->names_surnames,
            ];
        });
    }

    function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $dlon = $lon2 - $lon1;
        $dlat = $lat2 - $lat1;

        $a = sin($dlat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($dlon / 2) ** 2;
        $c = 2 * asin(sqrt($a));
        $r = 6371;

        return $c * $r;
    }
}
