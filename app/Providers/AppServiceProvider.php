<?php

namespace App\Providers;

use App\Services\StreamChatService;
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
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        
        Blade::if('auth', function () {
            return auth('sanctum')->check();
        });

        Blade::if('admin', function () {
            if (auth('sanctum')->check()) {
                return auth('sanctum')->user()->hasRole("Admin");
            }
        });

        Blade::if('guest', function () {
            return !auth('sanctum')->check();
        });

        View::composer('*', function ($view) {
            if (auth('sanctum')->check()) {
                $view->with('user', auth('sanctum')->user());
                $view->with('streamToken', app(StreamChatService::class)->createToken(auth('sanctum')->user()->id_user));
            }
        });

        view()->composer('partials.language_switcher', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
