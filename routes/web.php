<?php

use App\Http\Controllers\{ProfileController, HomeController};
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function(){

    Route::group(['prefix' => 'perfil'], function(){

        Route::controller(ProfileController::class)->group(function(){

            Route::get('/', 'index')->name('profile.index');
            Route::post('/validar-password', 'validatePassword')->name('profile.validatePassword');
            Route::get('/editar', 'edit')->name('profile.edit');
            Route::post('/actualizar', 'update')->name('profile.update');

        });

    });

});


