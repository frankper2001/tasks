@extends('layouts.master')

@section('titulo', 'Task List')

@section('contenido')

    <form method="POST" action="{{route('tasks.searchCategory')}}" class="col-4 d-flex flex-row mb-2">
        {{csrf_field()}}
        <input name="category" type="text" class="form-control form-control-sm" placeholder="Categoria" maxlength="16"  value="{{empty($category)? '': $category}}">
        <button type="submit" class="col btn btn-primary m-2">Buscar</button>
    </form>

    <form method="POST" action="{{route('tasks.searchImportance')}}" class="col-4 d-flex flex-row pb-2">
        {{csrf_field()}}
        <select name="importance" class="form-select form-select-sm" aria-label="Default select example">
            <option selected>Importancia</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select> 
        <button type="submit" class="btn btn-primary m-2">Buscar</button>
    </form>

    <div class="row">
        <div class="col-6 text-star">{{ $tasks->links() }}</div>
        @auth
        <div class="col-6 text-end">
            <p>Nuevo task <a href="{{route('tasks.create')}}" class="btn btn-success ml-2">+</a></p>
        </div>
        @endauth
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
                <a href="{{route('tasks.edit', $task->id)}}">
                <img height="20" width="20" src="{{asset('images/buttons/update.png')}}" alt="Modificar" title="Modificar"></a>
                <a href="{{route('tasks.delete', $task->id)}}">
                <img height="20" width="20" src="{{asset('images/buttons/delete.png')}}" alt="Borrar" title="Borrar"></a>
                @endauth
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">Mostrando {{sizeof($tasks)}} de {{$total}}.</td>
        </tr>
    </table>
    
@endsection

@section('enlaces')
   @parent
@endsection    
