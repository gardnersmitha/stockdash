<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ReminderRunner;
use App\Instance;
use Log;

class ReminderRunnerServiceProvider extends ServiceProvider
{
    
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
        //
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Contracts\ReminderRunnerContract', function(){

            return new ReminderRunner();

        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return void
     */
    public function provides()
    {
        return ['App\Helpers\Contracts\ReminderRunnerContract'];
    }
}
