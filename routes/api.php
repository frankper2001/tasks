<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskApiController;
use App\Models\Task;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('saludar', function() {
    $objeto = new stdClass();
    $objeto->mensaje = "Hola desde api";
    $json = json_encode($objeto);
    return response($json)->header('Content-Type', 'application/json');
});

// Busqueda de task por importancia
/* Route::get('/tasks/importance/{importance?}',[TaskApiController::class, 'buscarImportance']); */

// Busqueda de task de la API
/* Route::get('/tasks/{title?}/{importance?}',[TaskApiController::class, 'buscar']); */

//ZONA DE PRUEBAS



// Lista de tareas
/* Route::get('/tasks', function(){
    //retorna la lista de tareas
    //convertida a JSON
    return response(Task::orderBy('id', 'DESC')->get())->header('Content-Type', 'application/json');
}); */

Route::get('/tasks', function(){
    //retorna la lista de tareas
    //convertida a JSON
    return response()->json(Task::all());
});

Route::get('/tasks/{task}', function(Task $task){
    //retorna la tarea
    //convertida a JSON
    return response()->json($task);
});