@extends('layouts.master')

@section('titulo', "Confirmación de borrado de la task: $task->title")

@section('contenido')
    <form class="my-2 border p-5" method="POST" action="{{URL::temporarySignedRoute('tasks.destroy', now()->addMinutes(5), $task->id )}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="DELETE">
        <figure>
            <figcaption>Imagen actual:</figcaption>
            <img  alt="" class="rounded" style="max-width: 400px" 
                src="{{$task->imagen?
                    asset('storage/'.config('filesystems.tasksImageDir')).'/'.$task->imagen: 
                    asset('storage/'.config('filesystems.tasksImageDir')).'/'.'default.jpg' }}">
        </figure>
        <label for="confirmdelete">Confirmar el borrado de {{"$task->title"}}</label>
        <input type="submit" alt="Borrar" title="Borrar" class="btn btn-danger m-4" value="Borrar" id="confirmdelete">
    </form>
@endsection

@section('enlaces')
    @parent
    <a href="{{route('tasks.index')}}" class="btn btn-primary m-2">Listado</a>
    <a href="{{route('tasks.show', $task->id)}}" class="btn btn-primary m-2">Regresar a detalles de task</a>
@endsection