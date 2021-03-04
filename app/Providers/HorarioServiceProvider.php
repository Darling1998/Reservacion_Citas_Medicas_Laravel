<?php

namespace App\Providers;

use App\Interfaces\HorarioServicioInterface;
use Illuminate\Support\ServiceProvider;
use App\Servicios\HorarioServicio;

class HorarioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HorarioServicioInterface::class,HorarioServicio::class);
    }

    /**
     * Bootstrap services.dateCarbon
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
