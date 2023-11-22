<?php

use App\Http\Controllers\{ProfileController};
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Client\{ClientHomeController};
use App\Http\Controllers\Client\Product\ClientProductController;
use App\Http\Controllers\Client\Shopping\ProductListController;
use App\Http\Controllers\Company\{CompanyHomeController, CompanyInventoryController};
use App\Http\Controllers\Company\Product\CompanyProductController;
use Illuminate\Support\Facades\{Auth, Route};


Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    // * Clientes

    Route::group(['middleware' => 'check.role:clients'], function () {

        Route::get('/inicio', [ClientHomeController::class, 'index'])->name('clients.home');

        // * Productos

        Route::controller(ClientProductController::class)->group(function () {

            Route::get('/productos', 'index')->name('client.products.index');
            Route::get('/ver-producto/{product}', 'view')->name('client.product.view');
            Route::post('/agregar-inventario/{inventory}', 'add')->name('client.inventory.add');
            Route::delete('/client/eliminar-inventario/{inventory}', 'delete')->name('client.inventory.delete');

        });

        // * Lista de productos

        Route::controller(ProductListController::class)->group(function () {

            Route::get('/productos-seleccionados', 'index')->name('client.selected-products.index');
            Route::post('/sumarCantidad/{productOnList}', 'addCuantity')->name('client.selected-products.addCuantity');
            Route::post('/restarCantidad/{productOnList}', 'subtractCuantity')->name('client.selected-products.subtractCuantity');
            Route::post('/agregar-al-carrito/{productOnList}', 'addShoppingCart')->name('client.selected-products.addShoppingCart');

        });

    });

    // * Empresa / farmacia

    Route::group(['middleware' => 'check.role:company'], function () {

        Route::get('/home', [CompanyHomeController::class, 'index'])->name('company.home');

        Route::controller(CompanyInventoryController::class)->group(function () {

            Route::get('/inventario-registrados', 'index')->name('company.inventory.index');
            Route::get('/registrar-en-inventario', 'create')->name('company.inventory.create');
            Route::get('/editar/{inventory}', 'edit')->name('company.inventory.edit');
            Route::post('/registrar', 'store')->name('company.inventory.store');
            Route::post('/actualizar-inventario/{inventory}', 'update')->name('company.inventory.update');
            Route::delete('/eliminar-inventario/{inventory}', 'destroy')->name('company.inventory.delete');

        });

    });


    // * Super admin

    Route::group(['middleware' => 'check.role:super_admin'], function () {

        Route::get('/admin/inicio', [AdminHomeController::class, 'index'])->name('admin.home');

        Route::controller(AdminProductController::class)->group(function () {

            Route::get('/admin/productos-registrados', 'index')->name('admin.products.index');
            Route::get('/admin/registrar-producto-categoria', 'create')->name('admin.products.create');
            Route::get('/admin/obtener-categorias-hijos', 'getChildCategories')->name('admin.products.getChildCategories');
            Route::post('/admin/registrar-producto', 'store')->name('admin.product.store');

        });

        Route::controller(AdminCategoryController::class)->group(function () {
            Route::post('/admin/registrar-categoria', 'store')->name('admin.category.store');
        });


    });



    // * Perfil del usuario

    Route::group(['prefix' => 'perfil'], function () {

        Route::controller(ProfileController::class)->group(function () {

            Route::get('/', 'index')->name('profile.index');
            Route::get('/editar', 'edit')->name('profile.edit');
            Route::post('/validar-password', 'validatePassword')->name('profile.validatePassword');
            Route::post('/actualizar', 'update')->name('profile.update');

        });

    });

});
