<?php

use App\Http\Controllers\{ProfileController};

use App\Http\Controllers\Admin\{AdminCategoryController, AdminHomeController, AdminProductController, DiscountCoupionController};
use App\Http\Controllers\Client\{ClientHomeController, ClientInventoryController, ClientListController, ClientFilterController, ClientShoppingController, ClientOrderController};
use App\Http\Controllers\Company\{CompanyHomeController, CompanyInventoryController, CompanySaleController, CompanyPromotionController};
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\{Auth, Route};


use App\Http\Controllers\WebhooksController;

Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    // * Clientes

    Route::group(['middleware' => 'check.role:clients', 'prefix' => 'Farmype'], function () {

        Route::get('/inicio', [ClientHomeController::class, 'index'])->name('clients.home');

        // * Inventories

        Route::controller(ClientInventoryController::class)->group(function () {
            Route::get('/productos', 'index')->name('client.products.index');
            Route::get('/ver-productos/{product}', 'view')->name('client.product.view');
            Route::post('/agregar-inventario/{inventory}', 'add')->name('client.inventory.add');
            Route::delete('/client/eliminar-inventario/{inventory}', 'delete')->name('client.inventory.delete');
        });

        // * Lista

        Route::controller(ClientListController::class)->group(function () {

            Route::get('/productos-seleccionados', 'index')->name('client.selected-products.index');
            Route::post('/sumarCantidad/{inventory}', 'addCuantity')->name('client.selected-products.addCuantity');
            Route::post('/restarCantidad/{inventory}', 'subtractCuantity')->name('client.selected-products.subtractCuantity');
            Route::post('/agregar-al-carrito/{inventory}', 'addShoppingCart')->name('client.selected-inventory.addShoppingCart');
            Route::post('/agregar-directo-al-carrito/{inventory}', 'addShoppingCartDirect')->name('client.selected-inventory.addShoppingCartDirect');
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
            Route::post('eliminar-cupon-de-descuento/', 'deleteDiscountCoupion')->name('client.shopping.deleteDiscountCoupion');


            Route::delete('eliminar-inventario-shopping/{inventory}', 'deleteInventoryOfShopping')->name('client.shopping.delete');
            Route::delete('/vaciar-carrito', 'emptyShoppingCart')->name('client.shopping.emptyShoppingCart');
        });

        Route::post('/webhooks', WebhooksController::class)->name('webhooks.invoke');


        // * Orden de compra
        Route::controller(ClientOrderController::class)->group(function () {

            Route::get('/ordenes-de-compra', 'index')->name('client.order.index');
            Route::get('/ordenes-de-compra-en-proceso', 'notDelivered')->name('client.order.notDelivered');
            Route::get('/orden-de-compra/{order}', 'view')->name('client.order.view');

            // * ruta para el pago de la orden en desarrollo
            Route::get('orden/shopping/pago', 'pay')->name('client.order.pay');
            // *

        });


    });

    // * Empresa / farmacia

    Route::group(['middleware' => 'check.role:company', 'prefix' => 'farmacia'], function () {

        // Route::get('/home', [CompanyHomeController::class, 'index'])->name('company.home');

        Route::controller(CompanyHomeController::class)->group(function () {
            Route::get('/home', 'index')->name('company.home');
            Route::get('/getSalesCount', 'getSalesCount')->name('company.home.getSalesCount');
            Route::get('/getSalesMoney', 'getSalesMoney')->name('company.home.getSalesMoney');
        });

        Route::controller(LocationController::class)->group(function () {
            Route::get('/ubicacion', 'index')->name('company.location.index');
            Route::post('/guardar-ubicacion', 'store')->name('company.location.store');
            Route::post('/actualizar-ubicacion', 'update')->name('company.location.update');
        });

        Route::controller(CompanyInventoryController::class)->group(function () {

            Route::get('/inventario-registrados', 'index')->name('company.inventory.index');
            Route::get('/registrar-en-inventario', 'create')->name('company.inventory.create');
            Route::get('/editar/{inventory}', 'edit')->name('company.inventory.edit');
            Route::get('/obtener-inventarios-en-select', 'getProductsForSelect')->name('admin.inventory.getProductsForSelect');
            Route::post('/registrar', 'store')->name('company.inventory.store');
            Route::post('/actualizar-inventario/{inventory}', 'update')->name('company.inventory.update');
            Route::delete('/eliminar-inventario/{inventory}', 'destroy')->name('company.inventory.delete');

        });

        // * Descuentos
        Route::controller(DiscountCoupionController::class)->group(function () {
            Route::post('/descuentos', 'store')->name('admin.discount.store');
        });

        // * Ventas
        Route::controller(CompanySaleController::class)->group(function () {
            Route::get('/ventas', 'index')->name('company.sales.index');
            Route::get('/ventas/{sale}', 'view')->name('company.sales.view');

        });

        // * Promociones

        Route::controller(CompanyPromotionController::class)->group(function () {
            Route::get('/lista-de-promociones', 'index')->name('company.promotions.list');
            Route::post('/registrar-promocion', 'store')->name('company.promotions.store');
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
