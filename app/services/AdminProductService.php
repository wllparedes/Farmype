<?php

namespace App\Services;

use App\Models\Product;
use Auth;
use Exception;
use Illuminate\Http\Request;



class AdminProductService
{

    public function store(Request $request, $storage)
    {
        $data = $request->all();

        $product = [
            "name" => $data["name"],
            "detail" => $data["detail"],
        ];

        $childCategories = $data['child_category_id'];

        $user = Auth::user();
        $product = $user->products()->create($product);
        $product->childCategories()->attach($childCategories);


        if ($product) {

            if ($request->hasFile('image')) {

                $file_type = 'imagenes';
                $category = 'products';
                $belongsTo = 'products';
                $relation = 'one_one';

                $file = $request->file('image');

                return app(FileService::class)->store(
                    $product,
                    $file_type,
                    $category,
                    $file,
                    $storage,
                    $belongsTo,
                    $relation
                );
            }

            return $product;
        }

        throw new Exception(config('parameters.exception_message'));
    }



}



