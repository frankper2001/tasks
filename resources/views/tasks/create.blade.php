@extends('layouts.master')

@section('titulo', 'Nueva tarea')

@section('contenido')
    <form method="POST" action="{{route('tasks.store')}}" class="my-2 border p-5" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="">Importancia:</label>

            <input type="radio" class="btn-check" name="importance" id="low" autocomplete="off" value="low" checked>
            <label class="btn btn-primary m-2" for="low">Low</label>
            
            <input type="radio" class="btn-check" name="importance" id="medium" autocomplete="off" value="medium">
            <label class="btn btn-success m-2" for="medium">Medium</label>

            <input type="radio" class="btn-check" name="importance" id="high" autocomplete="off" value="high">
            <label class="btn btn-danger m-2" for="high">High</label>
        </div>
        <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label">Título</label>
            <input type="text" name="title" class="up form-control col-sm-10" id="inputTitle" placeholder="Titulo" maxlength="50" required="required" value="{{old('title')}}">
        </div>
        <div class="form-group row">
            <label for="inputDescription" class="col-sm-2 col-form-label">Descripción</label>
            <input type="text" name="description" class="up form-control col-sm-10" id="inputDescription" placeholder="Description" maxlength="150" required="required" value="{{old('description')}}">
        </div>
        <div class="form-group row">
            <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
            <input type="text" name="category" class="up form-control col-sm-10" id="inputCategory" placeholder="Categoría" maxlength="50" required="required" value="{{old('category')}}">
        </div>
        <div class="form-group row">
            <label for="inputMatricula" class="col-sm-2 col-form-label">Matricula</label>
            <input type="text" name="matricula" class="up form-control col-sm-10" id="inputMatricula" placeholder="1234BCD" value="{{old('matricula')}}">
        </div>
        <!-- Inserta campo de confirmacion de matricula -->
        <div class="form-group row">
            <label for="inputMatricula" class="col-sm-2 col-form-label">Confirmar Matricula</label>
            <input type="text" name="matricula_confirmation" class="up form-control col-sm-10" id="inputMatricula">
        </div>
        <input type="checkbox" id="activaColor"> 
        <label for="activaColor">Activar selección de color</label>
        <div class="form-group row">
            <label for="inputColor" class="col-sm-2 col-form-label">Color</label>
            <input type="color" name="color" class="up form-control col-sm-10" id="inputColor"  value="{{old('color') ?? '#000000'}}">
        </div>
        <div class="form-group row">
            <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
            <input type="file" name="imagen" class="up form-control col-sm-10" id="inputImagen">
        </div>
        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2">Borrar</button>
        </div>
    </form>

    <script>
        activaColor.onchange = function(){
            inputColor.disabled = !activaColor.checked;
        }
   </script>

@endsection

@section('enlaces')
    @parent
        <a href="{{route('tasks.index')}}" class="btn btn-primary m-2">Listado</a>
@endsection


