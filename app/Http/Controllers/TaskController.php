<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{
    // constructor
    public function __construct(){
        //pone un middleware solo a destroy
        //$this->middleware('throttle:3,1')->only('destroy');
        $this->middleware('verified')->except('index', 'show', 'searchCategory', 'searchImportance');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'DESC')->paginate(10);

        // $total = Task::count(); //Trasladado a un ViewComposer

        return view('tasks.list', ['tasks'=>$tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // mostrar formulario
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        //validar datos de entrada con validator
        $request->validate([
            // la validacion ahora esta en app/Html/Request/TaskStoreRequest LAR17->72
        ]);

        //recuperar datos del formulario excepto la imagen
        $datos = $request->only(['title','description','category','matricula','color','importance']);
        //el valor por defecto para la imagen sera null
        $datos += ['imagen' =>NULL];
        //recuperacion de la imagen
        if($request->hasFile('imagen')){
            //sube la imagen al directorio indicado en el fichero de config
            $ruta = $request->file('imagen')->store(config('filesystems.tasksImageDir'));

            //nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }
        //creacion y guardado de la nueva task con los datos
        $task = Task::create($datos);

        //crear y guardar nuevo task con datos POST
        //$task = Task::create($request->all());

        //redirección a lista de tasks
        /* return redirect()->route('tasks.index')->with('success', "Task $task->title añadido correctamente"); */
        return redirect()->route('tasks.show', $task->id)
                        ->with('success', "Task $task->title añadido correctamente")
                        ->cookie('lastInsertID', $task->id, 0); // adjuntamos una cookie
    }

    /**
     * Display the specified resource.
     *
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task) //implicit binding LAR09 69
    {
        //recupera task con id deseado
        //si no lo encuentra genera error 404
        //$task = Task::findOrFail($id);

        //carga vista y pasa el task
        return view('tasks.show', ['task'=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)    //implicit binding LAR09 70
    {
        // recupera task con id deseado
        //si no lo encuentra genera error 404
        //$task = Task::findOrFail($id);  

        //carga vista y con formulario para modificar  el task
        return view('tasks.update')->with('task',$task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //validar datos con validator
        $request->validate([
             // la validacion ahora esta en app/Html/Request/TaskUpdateRequest LAR17->72
        ]);

        //toma datos del formulario 
        $datos = $request->only(['title','description','category','matricula', 'color', 'importance']);

        if($request->hasFile('imagen')){
            //marcamos la imagen antigua para ser borrada si el update va bien
            if($task->imagen)
                $aBorrar = config('filesystems.tasksImageDir').'/'.$task->imagen;
                
                //sube la imagen al directorio indicado en el fichero de config
                $ruta = $request->file('imagen')->store(config('filesystems.tasksImageDir'));

                //nos quedamos solo con el nombre del fichero para añadirlo a la BDD
                $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }

        //en caso de que nos pidan eliminar la imagen
        if($request->filled('eliminarimagen') && $task->imagen){
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.tasksImageDir').'/'.$task->imagen;
        }

        //al actualizar debemos tener en cuenta varias cosas:
        if($task->update($datos)){ //si todo va bien
            if(isset($aBorrar))
                Storage::delete($aBorrar); //borramos foto antigua
        }else{ // si algo falla
            if(isset($imagenNueva))
                Storage::delete($imagenNueva); //borramos la foto nueva
        }

        //$task = Task::findOrFail($id); //recupera task de BDD
        //$task->update($request->all()); //actualiza

        //carga la misma vista y muestra mensaje de exito
        
        // encola las cookies
        Cookie::queue('lastUpdateID', $task->id, 0);
        Cookie::queue('lastUpdateDate', now(), 0);

        //sin cookie
        return back()->with('success', "Task $task->title actualizada");
        
        //con cookies
        /* return back()->with('success', "Task $task->title actualizada")->cookie('lastUpdateID',$task->id,0); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Task $task)
    {
        //recupera task a eliminar
        //$task = Task::findOrFail($id);
        // muestra vista de confirmacion de eliminacion
        return view('tasks.delete',['task'=>$task]);
    }

    public function destroy(Request $request, Task $task)
    {
       /*  if(!$request->hasValidSignature())
            abort (401, 'La firma de la URL no se ha podido validar');
        //busca el task seleccionado
        //$task = Task::findOrFail($id);
        //lo borra de la BDD
        $task->delete(); */

        //si se consigue eliminar la task y tiene foto...
        if($task->delete() && $task->imagen)
            //elimina el fichero
            Storage::delete(config('filesystems.tasksImageDir').'/'.$task->imagen);

        //redirige a la lista de tasks
        return redirect('tasks')->with('success', "Task $task->title eliminada");
    }


    public function searchCategory(Request $request){
        $request->validate([
            'category' => 'max:16'
        ]);
        
        $category = $request->input('category','');

        //realiza la consulta
        $tasks = Task::where('category','like',"%$category%")
                        ->paginate(10)
                        ->appends(['category'=>$category]);
        return view('tasks.list', ['tasks'=>$tasks, 'category'=>$category]);
    }

    public function searchImportance(Request $request){
        $request->validate([
            'importance' => 'max:16'
        ]);
        
        $importance = $request->input('importance','high');

        //realiza la consulta
        $tasks = Task::where('importance','like',"%$importance%")
                        ->paginate(10)
                        ->appends(['importance'=>$importance]);
        return view('tasks.list', ['tasks'=>$tasks, 'importance'=>$importance]);
    }
    
    // editar la ultima moto creada (prueba de cookies)
    public function editLast(){
        //comprobar si llega la cookie 'lastInsertID'
        if(!Cookie::has('lastInsertID'))
            return redirect()->route('tasks.create');
        $id = Cookie::get('lastInsertID');
            return redirect()->route('tasks.edit', $id);
    }


}



