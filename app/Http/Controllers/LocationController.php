<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;

class LocationController extends Controller
{
    //
    public function index()
    {
        //
    }

    // public function store(Request $request)
    // {

    //     $data =  $request->all();

    //     $user = Auth::user();

    //     if ($user->location == null) {

    //         $user->location()->create($data);
    //     } else {
    //         return response()->json(['message' => $user->location]);
    //     }
    // }

    public function update(Request $request)
    {

        try {
            $user = Auth::user();
            $conditions = ['user_id' => $user->id];
            $data =  $request->all();
            $success = $user->location()->updateOrCreate($conditions, $data);
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
