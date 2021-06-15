<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskApiController extends Controller
{
    

    // metodo que busca tarea y retorna json
    public function buscar($title='', $importance=''){
        //realiza la consulta
        $tasks =Task::where('title', 'like', "%$title%")
                    ->where('importance', 'like', "%$importance%")
                    ->get();
        //pasa los resultados a JSON
        $json = json_encode($tasks);

        //retorna la respuesta en JSON
        return response($json)->header('Content-Type','application/json');
    }

    // metodo que busca tarea por importancia y retorna json
    public function buscarImportance($importance='low'){
        //realiza la consulta
        $tasks =Task::where('importance', 'like', "%$importance%")->get();
        //pasa los resultados a JSON
        $json = json_encode($tasks);

        //retorna la respuesta en JSON
        return response($json)->header('Content-Type','application/json');
    }
}
