<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ejemplo CRUD con Laravel - Tasks">
    <title>{{config('app.name')}} - @yield('titulo')</title>
    <!-- CSS para Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body class="container p-3">
    <!-- PARTE SUPERIOR -->
    @section('navegacion')
    @php($pagina=Route::currentRouteName())
    <nav>
        <ul class="nav nav-pills my-3">
            <li class="nav-item mr-2">
                <a class="nav-link {{$pagina=='portada'? 'active':''}}" href="{{url('/')}}">Inicio</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link {{$pagina=='tasks.index' || $pagina=='tasks.search'? 'active':''}}" href="{{route('tasks.index')}}">Tasks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$pagina=='tasks.create'? 'active':''}}" href="{{route('tasks.create')}}">New task</a>
            </li>
        </ul>
    </nav>
    @show
    <!-- PARTE CENTRAL -->
    <!-- <h1 class="my-2">Task List desde master</h1> -->
    <main>
        <h2>@yield('titulo')</h2>
        
        @includeWhen(Session::has('success'), 'layouts.success')
        @includeWhen($errors->any(), 'layouts.error')

        <p>Actualmente tienes {{$total}} tareas guardadas.</p>

        @yield('contenido')

        <div class="btn-group" role="group" aria-label="Links">
            @section('enlaces')
                <a href="{{ url()->previous()}}" class="btn btn-primary m-2">Atras</a>
                <a href="{{ route('portada') }}" class="btn btn-primary m-2">Inicio</a>         
            @show       
        </div>
    </main>
    <!-- PARTE INFERIOR -->
    @section('pie')
    <footer class="page-footer font-small p-4 bg-light">
        <p>Aplicación creada por Desarrollo-Web {{$autor}} haciendo uso de <b>Laravel</b> y <b>Bootstrap</b> desde master. </p>
    </footer>
    @show
</body>
</html>