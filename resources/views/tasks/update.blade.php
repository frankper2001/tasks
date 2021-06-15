@extends('layouts.master')

@section('titulo', 'Actualización de tarea')

@section('contenido')
    <form class="my-2 border p-5" method="POST" action="{{route('tasks.update', $task->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="">Importancia:</label>

            <input type="radio" class="btn-check" name="importance" id="low" autocomplete="off" value="low" {{$task->importance=='low'? "checked":''}}>
            <label class="btn btn-primary m-2" for="low">Low</label>
            
            <input type="radio" class="btn-check" name="importance" id="medium" autocomplete="off" value="medium" {{$task->importance=='medium'? "checked":''}}>
            <label class="btn btn-success m-2" for="medium">Medium</label>

            <input type="radio" class="btn-check" name="importance" id="high" autocomplete="off" value="high" {{$task->importance=='high'? "active":''}}>
            <label class="btn btn-danger m-2" for="high">High</label>
        </div>
        <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label">Título</label>
            <input type="text" name="title" class="up form-control col-sm-10" id="inputTitle" placeholder="Titulo" maxlength="50" required="required" value="{{$task->title}}">
        </div>
        <div class="form-group row">
            <label for="inputDescription" class="col-sm-2 col-form-label">Descripción</label>
            <input type="text" name="description" class="up form-control col-sm-10" id="inputDescription" placeholder="Description" maxlength="150" required="required" value="{{$task->description}}">
        </div>
        <div class="form-group row">
            <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
            <input type="text" name="category" class="up form-control col-sm-10" id="inputCategory" placeholder="Categoría" maxlength="50" required="required" value="{{$task->category}}">
        </div>
        
        <div class="form-group row my-3">
            <div class="col-sm-9">
                <label for="inputImagen" class="col-sm-2 col-form-label">{{$task->imagen? 'Sustituir':'Añadir'}} imagen
                </label>
                <input type="file" name="imagen" class="up form-control-file" id="inputImagen">
                @if($task->imagen)
                <div class="form-check my-3">
                    <input type="checkbox" name="eliminarimagen" class="form-check-input" id="inputEliminar">
                    <label for="inputEliminar" class="form-check-label">Eliminar Imagen</label>
                </div>
                <script>
                    inputEliminar.onchange = function(){
                        inputImagen.disabled = this.checked;
                    }
                </script>
                @endif
            </div>
            <div class="col-sm-3">
                <label>Imagen actual:</label>
                <img class="rounded img-thumbnail my-3"
                    alt="Imagen de {{$task->title}}"
                    title="Imagen de {{$task->title}}"
                    src="{{
                        $task->imagen?
                        asset('storage/'.config('filesystems.tasksImageDir')).'/'.$task->imagen: 
                        asset('storage/'.config('filesystems.tasksImageDir')).'/'.'default.jpg' 
                    }}">
            </div>
        </div>


        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2">Reestablecer</button>
        </div>     
    </form>
    <div class="text-end my-3">
        <div class="btn-group mx-2">
            <a class="mx-2" href="{{route('tasks.edit', $task->id)}}">
            <img height="40" width="40" src="{{asset('images/buttons/update.png')}}" alt="Modificar" title="Modificar"></a>
            <a class="mx-2" href="{{route('tasks.delete', $task->id)}}">
            <img height="40" width="40" src="{{asset('images/buttons/delete.png')}}" alt="Borrar" title="Borrar"></a>
        </div>
   </div>
@endsection

@section('enlaces')
    @parent
        <a href="{{route('tasks.index')}}" class="btn btn-primary m-2">Listado</a>
@endsection
