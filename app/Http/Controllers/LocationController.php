<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LocationController extends Controller
{
    //
    public function index()
    {
        //
    }

    public function store(Request $request)
    {

        $data =  $request->all();

        $user = Auth::user();

        if ($user->location == null) {

            $user->location()->create($data);

        }

    }

}
