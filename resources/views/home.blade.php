@extends('adminlte::page')


@section('title', 'Dashboard')


@section('content_header')
    <h1>Proyecto de Desarrollo Web</h1>
@stop


@section('content')
    <h1>Proyecto de Desarrollo Web</h1>
    <h1>Seminario de Privados</h1>
    <p>Walter José Rodas Vargas    0909-16-9349</p>
@stop



@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <style>
       .centrado{text-align:center; }
   </style>

@stop



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
