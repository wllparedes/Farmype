<?php

use App\Http\Controllers\{ProfileController};
use App\Http\Controllers\Client\{ClientHomeController};
use App\Http\Controllers\Client\Product\ClientProductController;
use App\Http\Controllers\Client\Shopping\ProductListController;
use App\Http\Controllers\Company\{CompanyHomeController};
use App\Http\Controllers\Company\Product\CompanyProductController;
use App\Http\Controllers\Company\Product\ProductController;
use App\Models\ProductList;
use Illuminate\Support\Facades\{Auth, Route};


Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();

Route::group(['middleware' => ['auth']], function(){


        Route::group(['middleware' => 'check.role:clients'], function(){

            Route::get('/inicio', [ClientHomeController::class, 'index'])->name('clients.home');

            // * Productos

            Route::controller(ClientProductController::class)->group(function(){

                Route::get('/productos', 'index')->name('client.products.index');
                Route::get('/obtener-productos-de-clientes', 'getMoreProducts')->name('client.products.get-more-products');
                Route::post('/agregar-productos/{product}', 'add')->name('client.products.add');
                Route::delete('/eliminar-productos/{product}', 'delete')->name('client.products.delete');

            });

            // * Lista de productos

            Route::controller(ProductListController::class)->group(function(){
                Route::get('productos-seleccionados', 'index')->name('client.selected-products.index');
            });

        });

        Route::group(['middleware' => 'check.role:company'], function(){

            Route::get('/home', [CompanyHomeController::class, 'index'])->name('company.home');

            Route::controller(CompanyProductController::class)->group(function(){

                Route::get('/productos-registrados', 'index')->name('company.products.index');
                Route::get('/registrar-producto', 'create')->name('company.product.create');
                Route::get('/editar/{product}', 'edit')->name('company.product.edit');
                Route::post('/registrar', 'store')->name('company.product.store');
                Route::post('/actualizar/{product}', 'update')->name('company.product.update');
                Route::delete('/eliminar/{product}', 'destroy')->name('company.product.delete');

            });

        });



        Route::group(['prefix' => 'perfil'], function(){

            Route::controller(ProfileController::class)->group(function(){

                Route::get('/', 'index')->name('profile.index');
                Route::get('/editar', 'edit')->name('profile.edit');
                Route::post('/validar-password', 'validatePassword')->name('profile.validatePassword');
                Route::post('/actualizar', 'update')->name('profile.update');

            });

        });

});



// *


