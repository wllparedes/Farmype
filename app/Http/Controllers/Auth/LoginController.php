<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function redirectTo()
    {

        switch(Auth::user()->role)
        {
            case 'clients':
                $this->redirectTo = route('clients.home');
                return $this->redirectTo;
                break;
            case 'company':
                $this->redirectTo = route('company.home');
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }
    }


    // public function redirectPath(Request $request)
    // {
    //     if (method_exists($this, 'redirectTo')) {
    //         return $this->redirectTo($request);
    //     }

    //     return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    // }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
