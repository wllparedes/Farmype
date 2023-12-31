<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    public function showRegistrationForm()
    {

        $documentTypes = config('parameters.document_type');
        $departaments = config('parameters.departaments');
        $provinces = config('parameters.provinces');
        $districts = config('parameters.districts');
        $roles = config('parameters.roles');

        return view('auth.register', compact('documentTypes', 'departaments', 'provinces', 'districts', 'roles'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'names_surnames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'document_type' => $data['document_type'],
            'document_number' => $data['document_number'],
            'departament' => $data['departament'],
            'province' => $data['province'],
            'district' => $data['district'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'names_surnames' => $data['names_surnames'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
