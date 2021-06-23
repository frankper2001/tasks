<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //recupera las tareas del usuario
        $tasks = $request->user()->tasks()->paginate(10);
        //carga la vista home pasandole las tareas
        return view('home', ['tasks'=>$tasks]);
    }
}
