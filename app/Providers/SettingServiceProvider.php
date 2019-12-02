<?php

namespace App\Providers;

use Backpack\Settings\SettingsServiceProvider;

class SettingServiceProvider extends SettingsServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind('settings', function ($app) {
            return new Settings($app);
        });

        // register their aliases
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', \App\Models\Setting::class);
    }
}
