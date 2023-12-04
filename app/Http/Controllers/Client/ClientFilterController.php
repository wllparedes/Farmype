<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductList;
use App\Models\Shopping;
use Auth;
use Illuminate\Http\Request;

class ClientFilterController extends Controller
{
    public function getProductsNutrition()
    {

        $parentCategoryName = 'Nutrición';

        $productNutritions = Product::whereHas('childCategories.parentCategory', function ($query) use ($parentCategoryName) {
            $query->where('name', $parentCategoryName);
        })
            ->with([
                'file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products'),
                'childCategories',
            ])
            ->paginate(8);

        return view('client.filter.nutrition', compact('productNutritions'));


    }
    public function getProductsBeauty()
    {

        $parentCategoryName = 'Belleza';

        $productBeauties = Product::whereHas('childCategories.parentCategory', function ($query) use ($parentCategoryName) {
            $query->where('name', $parentCategoryName);
        })
            ->with([
                'file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products'),
                'childCategories',
            ])
            ->paginate(8);

        return view('client.filter.beauty', compact('productBeauties'));


    }
    public function getProductsPersonalCare()
    {

        $parentCategoryName = 'Cuidado Personal';

        $productPersonalCare = Product::whereHas('childCategories.parentCategory', function ($query) use ($parentCategoryName) {
            $query->where('name', $parentCategoryName);
        })
            ->with([
                'file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products'),
                'childCategories',
            ])
            ->paginate(8);

        return view('client.filter.personal-care', compact('productPersonalCare'));


    }
    public function getProductsMomBaby()
    {

        $parentCategoryName = 'Mamá y bebe';

        $productMonBabys = Product::whereHas('childCategories.parentCategory', function ($query) use ($parentCategoryName) {
            $query->where('name', $parentCategoryName);
        })
            ->with([
                'file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products'),
                'childCategories',
            ])
            ->paginate(8);

        return view('client.filter.mom-baby', compact('productMonBabys'));


    }
    public function getProductsMedicalDevices()
    {

        $parentCategoryName = 'Dispositivos Médicos';

        $productMedicalDevices = Product::whereHas('childCategories.parentCategory', function ($query) use ($parentCategoryName) {
            $query->where('name', $parentCategoryName);
        })
            ->with([
                'file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products'),
                'childCategories',
            ])
            ->paginate(8);

        return view('client.filter.medical-devices', compact('productMedicalDevices'));

    }


    public function getProductsOlderAdult()
    {

        $parentCategoryName = 'Dispositivos Médicos';

        $productOlderAdults = Product::whereHas('childCategories.parentCategory', function ($query) use ($parentCategoryName) {
            $query->where('name', $parentCategoryName);
        })
            ->with([
                'file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products'),
                'childCategories',
            ])
            ->paginate(8);

        return view('client.filter.older-adult', compact('productOlderAdults'));

    }


    public function getOnSale(Request $request)
    {
        $user = Auth::user();

        if ($user->shopping) {
            $shoppingId = $user->shopping()->value('id');
        } else {
            $shopping = new Shopping;
            $user->shopping()->save($shopping);
            $shoppingId = $shopping->id;
        }

        $productsOnSale = Inventory::where('on_sale', 1)
            ->withCount([
                'shoppings' => function ($query) use ($shoppingId) {
                    $query->where('shopping_id', $shoppingId);
                }
            ])
            ->with([
                'user:id,names_surnames',
                'product',
                'product.file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'products')
            ])
            ->paginate(8);

        if ($request->ajax()) {

            $products = view('client.filter.render-on-sale', compact('productsOnSale'))->render();

            return [
                'html' => $products,
            ];

        }


        return view('client.filter.on-sale', compact('productsOnSale'));

    }



}
