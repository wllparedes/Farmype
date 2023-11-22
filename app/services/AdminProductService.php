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


    public function update(Request $request, Product $product, $storage)
    {
        $user = Auth::user();
        $data = $request->all();

        $product_new = [
            'name' => $data['name'],
            'detail' => $data['detail'],
        ];

        if ($product->update($product_new)) {
            return $this->updateProductImage($request, $product, $storage);
        }

        throw new Exception(config('parameters.exception_message'));
    }




    // SQLSTATE[42S22]: Column not found: 1054 Unknown column '_token' in 'field list' (SQL: update `products` set `_token` = zX3ZgWacQ0TlLMp2aT48csmjDa9yHtuwtzxLjFIe, `name` = Omega 2, `detail` = ?, `products`.`updated_at` = 2023-11-22 22:51:01 where `products`.`user_id` = 3 and `products`.`user_id` is not null)

    public function updateProductImage(Request $request, Product $product, $storage)
    {
        if ($request->hasFile('image')) {

            app(FileService::class)->destroy($product->file, $storage);

            $file_type = 'imagenes';
            $category = 'products';
            $file = $request->file('image');
            $belongsTo = 'products';
            $relation = 'one_one';

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

        return true;
    }

}



