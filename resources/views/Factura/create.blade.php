@extends('home')

@section('content')
    <form action ='{{ url('Factura') }}' class="form-horizontal"  method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>

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
                            <div class="form-row">
                                <div class="form-group col-md-5">

                                </div>
                            </div>
                            <div class="form-group col-md-auto float-right">
                                <label for="Fecha" class="control-label float-right"> {{'Fecha'}}</label>
                                <input type="text" class="form-control float-right " name="fecha" id="Fecha" value="{{old('Fecha', date('Y-m-d H:i:s'))}}">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="inputEmail4" class="">Cliente <a class="btn btn-success btn-sm   d-block mx-auto float-right"   data-toggle="modal" data-target="#Cliente">Agregar Cliente</a></label>
                                    <select name="cliente_id" id="usuarios_id" class="form-control">
                                        <option class="form-inline justify-content-center" > Seleccione Cliente </option>
                                        @foreach($Usuario as $Usuario )
                                            <option value="{{$Usuario['id']}}">{{$Usuario['nit']}} / {{$Usuario['nombre']}} {{$Usuario['apellido']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <br/>


                    </div>
                    <div class=" form-inline mb-2 mb-lg-0 justify-content-center">
                        <div class="input-group">
                            <input type="submit" class="btn btn-success  mr-sm-3 d-block mx-auto " value="{{'Agregar'}}">


                        </div>
                    </div>
                    <br/>

                </div>
            </div>
        </div>
    </div>

    </form>


@endsection
