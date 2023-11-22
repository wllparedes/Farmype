<?php


namespace App\Services;

use App\Models\Inventory;
use Auth;
use Exception;
use Illuminate\Http\Request;


class CompanyInventoryService
{

    public function getInventories()
    {

        $user = Auth::user();
        return $user->inventories()->with([
            'product',
            'product.file' => fn($sq3) =>
                $sq3->where('file_type', 'imagenes')
                    ->where('category', 'products')
        ])->paginate(8);

    }



    public function createInventory(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $data['on_sale'] = $request->on_sale == true ? 1 : 0;
        $data['discount'] = $data['on_sale'] == 1 ? $request->discount : null;
        $data['discounted_price'] = $data['on_sale'] == true ? $data['price'] - ($data['price'] * ($data['discount'] / 100)) : null;

        $inventory = $user->inventories()->create($data);

        if ($inventory) {

            $success = true;
            $message = "Producto registrado exitosamente";

        } else {

            $success = false;
            $message = "El producto no se pudo crear";
        }

        return response()->json([
            "success" => $success,
            "message" => $message
        ]);


    }

    public function editInventory($inventory)
    {

        $inventory = $inventory->with(['product', 'product.file', 'product.childCategories'])->get();

        foreach ($inventory as $item) {
            $product = $item->product;
            $urlImage = verifyImage($product->file);
            foreach ($product->childCategories as $childCategory) {
                $parentCategory = $childCategory->parentCategory;
                break;
            }
        }

        return response()->json([
            "inventory" => $inventory,
            "parentCategory" => $parentCategory,
            "url_image" => $urlImage,
        ]);

    }

    public function updateInventory(Request $request, Inventory $inventory)
    {

        $data = $request->all();

        $data['on_sale'] = $request->on_sale == true ? 1 : 0;
        $data['discount'] = $data['on_sale'] == 1 ? $request->discount : null;
        $data['discounted_price'] = $data['on_sale'] == true ? $data['price'] - ($data['price'] * ($data['discount'] / 100)) : null;

        $updatedInventory = $inventory->update($data);

        if ($updatedInventory) {
            $success = true;
            $message = "Producto actualizado exitosamente";
        } else {
            $success = false;
            $message = "Ha ocurrido un error";
        }

        return response()->json([
            'message' => $message,
            'success' => $success
        ]);

    }

    // public function destroyInventory(Inventory $inventory)
    // {

    //     try {
    //         $inventory->delete();
    //         $message = "Producto eliminado correctamente";
    //         $success = true;
    //     } catch (Exception $e) {
    //         $success = false;
    //         $message = $e->getMessage();
    //     }


    //     return response()->json([
    //         'message' => $message,
    //         'success' => $success
    //     ]);

    // }


}



