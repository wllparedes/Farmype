<?php

namespace App\Services;

use App\Models\{Product, User};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductService
{

    public function getProducts($id){

        return Product::where('user_id', $id)
        ->with([
            'file' => fn($sq3) =>
            $sq3->where('file_type', 'imagenes')
                ->where('category', 'products')
        ])
        ->paginate(8);

    }


    public function store(Request $request, $storage)
    {
        $user_id = auth()->id();
        $data = $request->all();
        $data['user_id'] = $user_id;
        $product = Product::create($data);

        // dd($data);

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
        // $data = normalizeInputStatus($request->all());
        $user_id = auth()->id();
        $data = $request->all();
        $data['user_id'] = $user_id;

        // $data['password'] = $data['password'] == NULL ? $user->password : Hash::make($data['password']);

        if ($product->update($data)) {
            // $product->miningUnits()->sync($request['id_mining_units']);

            return $this->updateProductImage($request, $product, $storage);
        }

        throw new Exception(config('parameters.exception_message'));
    }

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

    public function deleteProductAndImage($product, $storage){

        if ($product->delete()) {
            return app(FileService::class)->destroy($product->file, $storage);
        }
        throw new Exception(config('parameters.exception_message'));

    }


}
