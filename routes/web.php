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

            Route::controller(ProductController::class)->group(function(){

                Route::get('/productos-registrados', 'index')->name('company.products.index');
                Route::get('/registrar-producto', 'create')->name('company.product.create');
                Route::post('/registrar', 'store')->name('company.product.store');
                Route::get('/obtener-productos', 'getMoreProducts')->name('company.products.get-more-products');
                Route::get('/editar/{product}', 'edit')->name('company.product.edit');
                Route::post('/actualizar/{product}', 'update')->name('company.product.update');
                Route::delete('/eliminar/{product}', 'destroy')->name('company.product.delete');

            });

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


