<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share global settings with all views (cached for 1 hour)
        View::composer('*', function ($view) {
            $settings = Cache::remember('global_settings', 3600, function () {
                return Setting::pluck('value', 'key')->toArray();
            });
            $view->with('global_settings', $settings);
        });
    }
}