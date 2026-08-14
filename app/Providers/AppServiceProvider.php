<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Tambahan use statement di sini

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
        // <-- Tambahan logika Ngrok di dalam method boot
        if (str_contains(env('APP_URL'), 'ngrok')) {
            URL::forceScheme('https');
        }
    }
}