<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }


    public function index(){

        return view('company.profile.index',[
            'departaments' => config('parameters.departaments'),
            'provinces' => config('parameters.provinces'),
            'districts' => config('parameters.districts'),
            'documentTypes' => config('parameters.document_type'),
            ]);
    }

    public function edit(){

        $user = Auth::User();

        $departament = config('parameters.departaments')[$user->departament] ?? '-';
        $province = config('parameters.provinces')[$user->province] ?? '-';
        $district = config('parameters.districts')[$user->district] ?? '-';

        return response([
            'user' => $user,
            'departament' => $departament,
            'province' => $province,
            'district' => $district,
        ]);

    }

    public function validatePassword(Request $request){

        if (Hash::check($request->password, Auth::User()->password)) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function update(Request $request){

        $user = Auth::user();

        try {
            $success = $this->userService->update($request, $user);
            $message = config('parameters.updated_message');
        } catch (Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);

    }



}
