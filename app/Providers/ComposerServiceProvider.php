<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\TaskComposer;

class ComposerServiceProvider extends ServiceProvider
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
        //Vincula el ViewComposer a la vista listado
        //View::composer('tasks.list', TaskComposer::class); 
        // Tambien se puede desde AppServiceProvider.php
         //Esto solo carga en la vista listado
        //Para que cargue en todas las vistas
        View::composer('*', TaskComposer::class);
    }
}
