<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DiscountCoupionController extends Controller
{
    public function store(Request $request)
    {

        $user = auth()->user();
        $data = $request->all();

        $coupion = [
            'code' => $data['code'],
            'discount' => $data['discount'],
            'start_date' => Carbon::now(),
            'expiration_date' => Carbon::now()->addDays(30),
            'is_active' => 1,
            'max_uses' => $data['max_uses'],
        ];

        $coupion = $user->discountCoupions()->create($coupion);

        if (!$coupion) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el cupón'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cupón creado correctamente',
        ]);

    }
}
