<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, config('app.locale'));

        if (env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }

        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }
}
