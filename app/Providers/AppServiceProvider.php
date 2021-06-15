<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\TaskComposer;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        //View::composer('tasks.list', TaskComposer::class);
        //Esto solo carga en la vista listado
        //Para que cargue en todas las vistas
        //View::composer('*', TaskComposer::class);
        //View::share('autor', '- Francisco Perez');
        View::share('autor', config('app.author'));
        //Definicion de una macro para las respuestas
        Response::macro('mayusculas', function($datos){
            return Response::make(strtoupper($datos));
        });
    }
}
