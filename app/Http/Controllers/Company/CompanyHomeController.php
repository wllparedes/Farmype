<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class CompanyHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index()
    {

        $user =  Auth::user();
        // $discountCoupions = $user->load('discountCoupions');



        return view('company.home');
    }
}
