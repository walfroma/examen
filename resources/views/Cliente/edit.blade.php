@extends('home')

@section('content')
<form action="{{ url('/Cliente/' . $Cliente->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header"><a class="btn btn-primary   " style="width:20%; margin: 0 auto;" id="regresar"><i class="fas fa-arrow-left"></i></a>
                        Modificar Cliente</div>
                    <div class="card-body">


                        <div class="form-group">
                            <label for="nombre" class="control-label"> {{'Nombre'}}</label>
                            <input type="text" class="form-control {{$errors->has('Nombre') ? 'is-invalid' :'' }}" name="nombre" id="nombre" value="{{ isset($Cliente->nombre)? $Cliente->nombre:''}}" >
                            {!! $errors->first('Nombre','<div class="invalid-feedback"> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="control-label"> {{'Apellido'}}</label>
                            <input type="text" class="form-control {{$errors->has('Apellido') ? 'is-invalid' :'' }}" name="apellido" id="apellido" value="{{ isset($Cliente->apellido)? $Cliente->apellido:''}}" >
                            {!! $errors->first('Apellido','<div class="invalid-feedback"> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="edad" class="control-label"> {{'Edad'}}</label>
                            <input type="text" class="form-control {{$errors->has('Edad') ? 'is-invalid' :'' }}" name="edad" id="edad" value="{{ isset($Cliente->edad)? $Cliente->edad:''}}" >
                            {!! $errors->first('Edad','<div class="invalid-feedback"> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="control-label"> {{'Telefono'}}</label>
                            <input type="text" class="form-control {{$errors->has('Telefono') ? 'is-invalid' :'' }}" name="telefono" id="telefono" value="{{ isset($Cliente->telefono)? $Cliente->telefono:''}}" >
                            {!! $errors->first('Telefono','<div class="invalid-feedback"> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="direccion" class="control-label"> {{'Direccion'}}</label>
                            <input type="text" class="form-control {{$errors->has('Direccion') ? 'is-invalid' :'' }}" name="direccion" id="direccion" value="{{ isset($Cliente->direccion)? $Cliente->direccion:''}}" >
                            {!! $errors->first('Direccion','<div class="invalid-feedback"> :message</div>') !!}
                        </div>




                        <div class=" form-inline mb-2 mb-lg-0 justify-content-center">
                            <div class="input-group">
                                <input type="submit" class="btn btn-success  mr-sm-3 d-block mx-auto " value="Editar">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>

@endsection
