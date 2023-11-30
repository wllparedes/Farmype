<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\ParentCategory;
use Exception;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function store(Request $request)
    {

        try {
            $data = $request->all();

            if (isset($data['create_parent_category'])) {

                ParentCategory::create(['name' => $data['name_parent']]);

                $message = "La categoria ha sido creada";

            } elseif (isset($data["create_child_category"])) {

                $parentCategory = ParentCategory::find($data["parent_category_id_c"]);
                $parentCategory->childCategories()->create(["name" => $data["name_child"]]);

                $message = "La sub-categoria ha sido creada";

            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return response([
            'message' => $message,
            'data' => $data
        ]);
    }


    public function getParentCategory()
    {
        $parentCategory = ParentCategory::all();

        return response()->json($parentCategory);

    }



}
