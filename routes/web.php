<?php

use App\Http\Controllers\{ProfileController};

use App\Http\Controllers\Admin\{AdminCategoryController, AdminHomeController, AdminProductController};
use App\Http\Controllers\Client\{ClientHomeController, ClientInventoryController, ClientListController, ClientFilterController, ClientShoppingController};
use App\Http\Controllers\Company\{CompanyHomeController, CompanyInventoryController};
use Illuminate\Support\Facades\{Auth, Route};


Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    // * Clientes

    Route::group(['middleware' => 'check.role:clients'], function () {

        Route::get('/inicio', [ClientHomeController::class, 'index'])->name('clients.home');

        // * Inventories

        Route::controller(ClientInventoryController::class)->group(function () {
            Route::get('/productos', 'index')->name('client.products.index');
            Route::get('/ver-producto/{product}', 'view')->name('client.product.view');
            Route::post('/agregar-inventario/{inventory}', 'add')->name('client.inventory.add');
            Route::delete('/client/eliminar-inventario/{inventory}', 'delete')->name('client.inventory.delete');
        });

        // * Lista

        Route::controller(ClientListController::class)->group(function () {

            Route::get('/productos-seleccionados', 'index')->name('client.selected-products.index');
            Route::post('/sumarCantidad/{inventory}', 'addCuantity')->name('client.selected-products.addCuantity');
            Route::post('/restarCantidad/{inventory}', 'subtractCuantity')->name('client.selected-products.subtractCuantity');
            Route::post('/agregar-al-carrito/{inventory}', 'addShoppingCart')->name('client.selected-inventory.addShoppingCart');
            Route::delete('eliminar-inventario-lista/{inventory}', 'deleteInventoryOfList')->name('client.selected-inventory.delete');
        });

        // * Filter

        Route::controller(ClientFilterController::class)->group(function () {
            Route::get('productos/nutricion', 'getProductsNutrition')->name('client.getProductsNutrition');
            Route::get('productos/belleza', 'getProductsBeauty')->name('client.getProductsBeauty');
            Route::get('productos/cuidado-personal', 'getProductsPersonalCare')->name('client.getProductsPersonalCare');
            Route::get('productos/dispositivos-medicos', 'getProductsMedicalDevices')->name('client.getProductsMedicalDevices');
            Route::get('productos/mama-bebe', 'getProductsMomBaby')->name('client.getProductsMomBaby');
            Route::get('productos/adulto-mayor', 'getProductsOlderAdult')->name('client.getProductsOlderAdult');
            Route::get('productos/ofertas', 'getOnSale')->name('client.getProductsOnSale');
        });

        // * carrito de compras
        Route::controller(ClientShoppingController::class)->group(function () {
            Route::get('/carrito-de-compras', 'index')->name('client.shopping.index');
            Route::post('/sumar-cantidad-en-carrito/{inventory}', 'addCuantity')->name('client.shopping.addCuantity');
            Route::post('/restar-cantidad-en-carrito/{inventory}', 'subtractCuantity')->name('client.shopping.subtractCuantity');
            Route::post('/verificar-cupon-descuento', 'verifycoupions')->name('client.shopping.verifycoupions');

            Route::delete('eliminar-inventario-shopping/{inventory}', 'deleteInventoryOfShopping')->name('client.shopping.delete');
            Route::delete('/vaciar-carrito', 'emptyShoppingCart')->name('client.shopping.emptyShoppingCart');
        });


    });

    // * Empresa / farmacia

    Route::group(['middleware' => 'check.role:company'], function () {

        Route::get('/home', [CompanyHomeController::class, 'index'])->name('company.home');

        Route::controller(CompanyInventoryController::class)->group(function () {

            Route::get('/inventario-registrados', 'index')->name('company.inventory.index');
            Route::get('/registrar-en-inventario', 'create')->name('company.inventory.create');
            Route::get('/editar/{inventory}', 'edit')->name('company.inventory.edit');
            Route::get('/obtener-inventarios-en-select', 'getProductsForSelect')->name('admin.inventory.getProductsForSelect');
            Route::post('/registrar', 'store')->name('company.inventory.store');
            Route::post('/actualizar-inventario/{inventory}', 'update')->name('company.inventory.update');
            Route::delete('/eliminar-inventario/{inventory}', 'destroy')->name('company.inventory.delete');

        });

    });


    // * Super admin

    Route::group(['middleware' => 'check.role:super_admin', 'prefix' => 'admin'], function () {

        Route::get('/inicio', [AdminHomeController::class, 'index'])->name('admin.home');

        Route::controller(AdminProductController::class)->group(function () {

            Route::get('/productos-registrados', 'index')->name('admin.products.index');
            Route::get('/registrar-producto-categoria', 'create')->name('admin.products.create');
            Route::get('/obtener-categorias-hijos', 'getChildCategories')->name('admin.products.getChildCategories');
            Route::get('/obtener-categorias-padres', 'getParentCategories')->name('admin.products.getParentCategories');
            Route::post('/registrar-producto', 'store')->name('admin.product.store');
            Route::get('/editar-producto/{product}', 'edit')->name('admin.product.edit');
            Route::post('/actualizar-producto/{product}', 'update')->name('admin.product.update');
            Route::delete('/eliminar-producto/{product}', 'destroy')->name('admin.product.delete');

        });

        Route::controller(AdminCategoryController::class)->group(function () {
            Route::get('/obtener-categorias-principales', 'getParentCategory')->name('admin.category.getParentCategory');
            Route::post('/registrar-categoria', 'store')->name('admin.category.store');
        });


    });



    // * Perfil del usuario

    Route::group(['prefix' => 'perfil'], function () {

        Route::controller(ProfileController::class)->group(function () {

            Route::get('/', 'index')->name('profile.index');
            Route::get('/editar', 'edit')->name('profile.edit');
            Route::post('/validar-password', 'validatePassword')->name('profile.validatePassword');
            Route::post('/actualizar-campos', 'updateFields')->name('profile.update-fields');
            Route::post('/actualizar-password', 'updatePassword')->name('profile.update-password');

        });

    });

});
