<?php

use App\Http\Controllers\{ProfileController};
use App\Http\Controllers\Client\{ClientHomeController};
use App\Http\Controllers\Company\{CompanyHomeController};
use App\Http\Controllers\Company\Product\ProductController;
use Illuminate\Support\Facades\{Auth, Route};


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function(){


        Route::group(['middleware' => 'check.role:clients'], function(){

            Route::get('/home', [ClientHomeController::class, 'index'])->name('home');

        });

        Route::group(['middleware' => 'check.role:company'], function(){

            Route::get('/home', [CompanyHomeController::class, 'index'])->name('home');
            Route::get('/registrar-producto', [ProductController::class, 'index'])->name('products.index');
            Route::post('/registrar', [ProductController::class, 'store'])->name('products.store');

        });



        Route::group(['prefix' => 'perfil'], function(){

            Route::controller(ProfileController::class)->group(function(){

                Route::get('/', 'index')->name('profile.index');
                Route::post('/validar-password', 'validatePassword')->name('profile.validatePassword');
                Route::get('/editar', 'edit')->name('profile.edit');
                Route::post('/actualizar', 'update')->name('profile.update');

            });

        });

});



// *


