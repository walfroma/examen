
@extends('home')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header"><a class="btn btn-primary   " style="width:auto; margin: 0 auto;" id="regresar"><i class="fas fa-arrow-left"></i></a>
                        {{ $Modo == 'crear' ? '  Agregar  Categoria' : '  Modificar Categoria' }}</div>
                    <div class="card-body">



                        @if(count($errors)>0)
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{$error}}</li>
                                </ul>
                                @endforeach
                            </div>
                        @endif



                        <div class="form-group">
                            <label for="Bateria" class="control-label"> {{'Categoria'}}</label>
                            <input type="text" class="form-control {{$errors->has('Categoria') ? 'is-invalid' :'' }}" name="categoria" id="categoria" value="{{ isset($Categoria->categoria)? $Categoria->categoria:''}}">

                            {!! $errors->first('Categoria','<div class="invalid-feedback"> :message</div>') !!}

                        </div>


                        <div class=" form-inline mb-2 mb-lg-0 justify-content-center">
                            <div class="input-group">
                                <input type="submit" class="btn btn-success  mr-sm-3 d-block mx-auto " value="{{ $Modo == 'crear' ? 'Agregar' : 'Editar' }}">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
