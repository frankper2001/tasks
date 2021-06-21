@extends('layouts.master')

@section('titulo', 'Detalle de tarea')

@section('contenido')
<table class="table table striped table-bordered">
    <tr>
        <td>Imagen</td>
        <td class="text-start">
            <img  alt="" class="rounded" style="max-width: 200px" 
                src="{{$task->imagen?
                    asset('storage/'.config('filesystems.tasksImageDir')).'/'.$task->imagen: 
                    asset('storage/'.config('filesystems.tasksImageDir')).'/'.'default.jpg' }}">
        </td>
    </tr>
    <tr>
        <td>Titulo</td>
        <td>{{$task->title}}</td>
    </tr>
    <tr>
        <td>Descripcion</td>
        <td>{{$task->description}}</td>
    </tr>
    <tr>
        <td>Categoria</td>
        <td>{{$task->category}}</td>
    </tr>
    <tr>
        <td>Importancia</td>
        <td>{{$task->importance}}</td>
    </tr>
</table>
@auth
<div class="text-end my-3">
    <div class="btn-group mx-2">
        @if(Auth::user()->can('update',$task))
        <a class="mx-2" href="{{route('tasks.edit', $task->id)}}">
        <img height="40" width="40" src="{{asset('images/buttons/update.png')}}" alt="Modificar" title="Modificar"></a>
        @endif
        @if(Auth::user()->can('delete',$task))
        <a class="mx-2" href="{{route('tasks.delete', $task->id)}}">
        <img height="40" width="40" src="{{asset('images/buttons/delete.png')}}" alt="Borrar" title="Borrar"></a>
        @endif
    </div>
</div>
@endauth
@endsection

@section('enlaces')
    @parent
        <a href="{{route('tasks.index')}}" class="btn btn-primary m-2">Listado</a>
@endsection