<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\{Auth, Route};



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function(){
    return view('auth.login');
})->name('login.index');





