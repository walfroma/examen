@extends('adminlte::page')
//implementa la vista de adminlte

@section('title', 'Dashboard')
//agregamos un titulo

@section('content_header')
    <h1>Dashboard</h1>
@stop
//Agregamos un header a nuestra pagina

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

//Contenido de nuestra pagina

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <style>
       .centrado{text-align:center; }
   </style>

@stop

//agregamos css

@section('js')
    <script type="text/javascript">
        //Regresar a la pagina anterior
        var boton = document.getElementById('regresar')
        boton.addEventListener("click",function() {
                window.history.back();
            }
            ,false);






    </script>
@stop
