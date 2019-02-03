<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
            'store' => 'almacenar',
            'show' => 'mostrar',
            'edit' => 'editar',
            'update' => 'actualizar',
            'destroy' => 'destruir'
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
