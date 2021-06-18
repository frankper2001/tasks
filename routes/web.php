<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//PORTADA
Route::get('/', [WelcomeController::class, 'index'])->name('portada');

//OPERACIONES CON LOS TASKS
// editar la ultima moto guardada
Route::get('tasks/editLast', [TaskController::class, 'editLast'])->name('tasks.editLast')->middleware('auth');

//PARA BUSCAR POR CRITERIOS
//por title y/o description
//Route::match(['get','post'],'tasks/search/{consulta?}',[TaskController::class, 'search'])->name('tasks.search');

//por category
Route::match(['get','post'],'tasks/searchCategory/{category?}',[TaskController::class, 'searchCategory'])->name('tasks.searchCategory');

//por importance
Route::match(['get','post'],'tasks/searchImportance/{importance?}',[TaskController::class, 'searchImportance'])->name('tasks.searchImportance');

//CRUD DE TASKS
Route::resource('tasks',TaskController::class);

//formulario de confirmacion de eliminacion
Route::get('tasks/delete/{task}',[TaskController::class, 'delete'])->name('tasks.delete');

// ZONA PARA TESTEAR

Route::get('saludar', function(){
    return "Hola mundo"; // retorna string
});

Route::get('/saludar/gritando', function(){
    return response()->mayusculas('Hola mundo'); // retorna string en mayusculas
});

// descarga de ficheros
Route::get('image', function (Request $request){
    return response()->download('images/tasks/portada.png', 'miportada.png');
});
// descarga de fichero no en public
Route::get('readme/download', function (){
    return response()->download(base_path('readme.md'), 'ficherito');
});
// apertura del fichero em el navegador
Route::get('download/image', function (Request $request){
    return response()->file(base_path('public\images\tasks\portada.png'), ['content-type'=>'image/png']);
});

// FIN ZONA DE TESTEAR
Route::fallback(function(){
    return redirect()->route('portada');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
