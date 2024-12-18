<?php

namespace App\Providers;

use Exception;
use App\Models\Setting;
use App\Utils\Helpers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            if (Schema::hasTable('settings')) {
                $web = Setting::all();
                $webConfig = [];

                foreach ($web as $setting) {
                    $key = Helpers::camel_case($setting->option_name); // Convert to camel case for consistency
                    $webConfig[$key] = Helpers::getSettings($web, $setting->option_name);
                }
                view()->share('webConfig', $webConfig);
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
