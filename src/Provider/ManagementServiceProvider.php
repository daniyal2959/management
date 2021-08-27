<?php

namespace IAMdaniyal\Management\Provider;

use IAMdaniyal\Management\Commands\ControllerCrudCommand;
use IAMdaniyal\Management\Commands\FactoryCrudCommand;
use IAMdaniyal\Management\Commands\ManagementCommand;
use IAMdaniyal\Management\Commands\MigrationCrudCommand;
use IAMdaniyal\Management\Commands\ModelCrudCommand;
use IAMdaniyal\Management\Commands\RouteCrudCommand;
use IAMdaniyal\Management\Commands\SeederCrudCommand;
use IAMdaniyal\Management\Facades\Alert\AlertFacade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ManagementServiceProvider extends ServiceProvider
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
        if (File::exists(__DIR__ . '\\..\\Helper\\helper.php')) {
            require __DIR__ . '\\..\\Helper\\helper.php';
        }

        $this->loadRoutesFrom(__DIR__ . '\\..\\routes.php');
        $this->commands(
            [
                ManagementCommand::class,
                ModelCrudCommand::class,
                MigrationCrudCommand::class,
                ControllerCrudCommand::class,
                RouteCrudCommand::class,
                FactoryCrudCommand::class,
                SeederCrudCommand::class,
            ]
        );

        $this->app->bind('alert', function (){
            return new AlertFacade();
        });
    }
}
