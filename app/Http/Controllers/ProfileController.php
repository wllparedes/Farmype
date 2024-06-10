<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Decimal;

class ProfileController extends Controller
{
    private $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function index()
    {

        $user = Auth::User();
        $user_role = $user->role;

        $user->load('location');

        $latitude =  null;
        $longitude =  null;

        if ($user->location) {
            $latitude = floatval($user->location->latitude);
            $longitude = floatval($user->location->longitude);
        }

        $departaments = config('parameters.departaments');
        $provinces = config('parameters.provinces');
        $districts = config('parameters.districts');
        $documentTypes = config('parameters.document_type');

        if ($user_role === 'company') {
            return view('company.profile.index', compact('departaments', 'provinces', 'districts', 'documentTypes', 'latitude', 'longitude'));
        } elseif ($user_role === 'clients') {
            return view('client.profile.index', compact('departaments', 'provinces', 'districts', 'documentTypes'));
        } elseif ($user_role === 'super_admin') {
            return view('admin.profile.index', compact('departaments', 'provinces', 'districts', 'documentTypes'));
        }
    }

    public function edit()
    {

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

    public function validatePassword(Request $request)
    {

        if (Hash::check($request->password, Auth::User()->password)) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function updateFields(Request $request)
    {

        $user = Auth::user();

        try {
            $success = $this->userService->updateFields($request, $user);
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

    public function updatePassword(Request $request)
    {

        $user = Auth::user();

        try {
            $success = $this->userService->updatePassword($request, $user);
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
