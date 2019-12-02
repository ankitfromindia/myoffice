<?php

namespace App\Providers;

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
        $this->overrideConfigValues();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         \DB::listen(function ($query) {
             info('Query :: ' . $query->sql);
             info('Bindings :: ' . json_encode($query->bindings));
             info('Execution Time :: ' . $query->time);
         });
    }

    protected function overrideConfigValues()
    {
       $config = [];
       if (config('settings.skin'))
           $config['backpack.base.skin'] = config('settings.skin');
       if (config('settings.show_powered_by'))
           $config['backpack.base.show_powered_by'] = config('settings.show_powered_by') == '1';
       config($config);
       
    }
}
