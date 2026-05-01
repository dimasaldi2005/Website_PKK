<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        // Password::defaults(function ()
        // {
        //     $rule = [
        //         'min' => 8,
        //     ];

        //     $message = [
        //         'min' => 'Password minimal :min karakter',
        //     ];

        //     return $this->app->isProduction()
        //     ? compact('rule')
        //     : compact('rule', 'message');
        // });
    }
}
