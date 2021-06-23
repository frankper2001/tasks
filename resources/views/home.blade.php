@extends('layouts.master')
@section('titulo', 'Perfil de usuario')
@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Listado de tareas -->
<div class="row">
        <div class="col-6 text-star">{{ $tasks->links() }}</div>
        
        <div class="col-6 text-end">
            <p>Nuevo task <a href="{{route('tasks.create')}}" class="btn btn-success ml-2">+</a></p>
        </div>
        
    </div>

    <table class="table table-striped table-bordered">
        <tr>
            <th>Imagen</th>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Matricula</th>
            <th>Color</th>
            <th>Importance</th>
            <th>Operaciones</th>
        </tr>
        @foreach($tasks as $task)
        <tr>
            <td class="text-center" style="max-width: 80px">
                <img style="max-width: 90%" alt="" class="rounded"
                    src="{{$task->imagen? 
                        asset('storage/'.config('filesystems.tasksImageDir')).'/'.$task->imagen: 
                        asset('storage/'.config('filesystems.tasksImageDir')).'/'.'default.jpg' }}">
            </td>
            <td>{{$task->title}}</td>
            <td>{{$task->description}}</td>
            <td>{{$task->category}}</td>
            <td>{{$task->matricula}}</td>
            <td style="background-color:{{$task->color}};">{{$task->color}}</td>
            <td>{{$task->importance}}</td>
            <td class="text-center">
                <a href="{{route('tasks.show', $task->id)}}">
                <img height="20" width="20" src="{{asset('images/buttons/show.png')}}" alt="Ver detalles" title="Ver detalles"></a>
                @auth
                @if(Auth::user()->can('update',$task))
                <a href="{{route('tasks.edit', $task->id)}}">
                <img height="20" width="20" src="{{asset('images/buttons/update.png')}}" alt="Modificar" title="Modificar"></a>
                @endif
                @if(Auth::user()->can('delete',$task))
                <a href="{{route('tasks.delete', $task->id)}}">
                <img height="20" width="20" src="{{asset('images/buttons/delete.png')}}" alt="Borrar" title="Borrar"></a>
                @endif
                @endauth
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">Mostrando {{sizeof($tasks)}} de {{$total}}.</td>
        </tr>
    </table>
@endsection
