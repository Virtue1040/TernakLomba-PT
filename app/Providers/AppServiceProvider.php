<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('auth', function () {
            return auth('sanctum')->check();
        });

        Blade::if('guest', function () {
            return !auth('sanctum')->check();
        });

        View::composer('*', function ($view) {
            $view->with('user', auth('sanctum')->user());
        });

        view()->composer('partials.language_switcher', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
