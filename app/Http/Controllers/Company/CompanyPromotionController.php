<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\FileService;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class CompanyPromotionController extends Controller
{
    public function list()
    {
        return view('company.promotions.index');
    }

    public function store(Request $request)
    {

        $user = Auth::user();

        $storage = env('FILESYSTEM_DRIVER');

        $data = $request->all();

        $products = array_map('intval', explode(',', $data['selectProduct']));

        $arrayDates = explode(',', $data['datepicker']);

        $dateStart = Carbon::createFromFormat('d/m/Y', $arrayDates[0])->format('Y-m-d');
        $dateEnd = Carbon::createFromFormat('d/m/Y', $arrayDates[1])->format('Y-m-d');

        try {
            // * crear promoción
            $promotion = [
                "number_promotion" => $data["numberPromotion"],
                "price" => $data["price"],
                "stock" => $data["stock"],
                "date_start" => $dateStart,
                "date_end" => $dateEnd,
            ];

            $promotion = $user->promotions()->create($promotion);

            // * asignarle a la tabla pivot los productos seleccionados

            $promotion->products()->attach($products);

            // * asignarle la imagen
            if ($promotion) {

                if ($request->hasFile('image')) {

                    $file_type = 'imagenes';
                    $category = 'promotions';
                    $belongsTo = 'products';
                    $relation = 'one_one';

                    $file = $request->file('image');

                    app(FileService::class)->store(
                        $promotion,
                        $file_type,
                        $category,
                        $file,
                        $storage,
                        $belongsTo,
                        $relation
                    );
                }
            }

            $success = true;
            $message = 'Promoción registrada correctamente';

        } catch (Exception $th) {
            $success = false;
            $message = 'Ocurrió un error al registrar la promoción';
        }


        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);

    }

}
