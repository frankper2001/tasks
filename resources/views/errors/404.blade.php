<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tasks Manager">
    
    <title>{{config('app.name')}} - Error 404</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
@extends('layouts.master')

@section('titulo', 'Error 404')

@section('contenido')
    <figure class="row my-2 col-5 offset-1">
        <img src="{{asset('images/tasks/portada.png')}}" alt="" class="d-block w-40">
    </figure>
@endsection

@section('enlaces')

@endsection



</body>
</html>