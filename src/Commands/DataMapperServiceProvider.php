<?php

namespace Lewy\DataMapper\Commands;

use Illuminate\Support\ServiceProvider;

class DataMapperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('command.lewy.datamapper', function($app){
            return $app['Lewy\DataMapper\Commands\MakeResourceCommand'];
        });

        $this->commands('command.lewy.datamapper');
    }
}
