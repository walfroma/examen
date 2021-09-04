@extends('home')

@section('content')
        <!--   { csrf_field() }}
    { method_field('PATCH') }} -->

        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ url('/Factura/'.$Factura->id.'/Detalle') }}" method="post" enctype="multipart/form-data">
                            {{csrf_field() }}

                            <div class="card-header">
                            <input type="text" class="form-control float-right"  style="width:25%;"  name="fecha" id="Fecha" readonly value="Fecha: {{ isset($Factura->fecha)? $Factura->fecha:''}}">
                        </div>
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
                            <div class="row ">
                                @foreach($Cliente as $Cliente )
                                <div class="col-md-2">
                                    <label for="inputEmail4" class="">Nit </label>
                                        <input type="hidden"  value="{{$Cliente->id}}"{{$Cliente->id == $Factura->cliente_id ? 'selected' : ''}}">
                                        <input type="text" class="form-control" readonly value="{{$Cliente->nit}}" >
                                </div>
                                    <div class="col-md-4">
                                        <label for="inputEmail4" class="">Nombre </label>
                                        <input type="text" class="form-control" readonly value="{{$Cliente->nombre}},   {{$Cliente->apellido}} ">
                                    </div>
                                    <div class="col">
                                        <label for="inputEmail4" class="">Direccion </label>
                                        <input type="text" class="form-control" readonly value="{{$Cliente->direccion}} ">
                                    </div>
                                @endforeach
                            </div>
                        <br/>
                                <div class="row">
                                    <div class="col">
                                        <label for="inputEmail4" class="">Producto </label>
                                        <select name="productos_id" id="productos_id" class="form-control" >
                                            <option class="form-inline justify-content-center" > Seleccione Producto </option>
                                            @foreach($Producto as $Producto )
                                                <option value="{{$Producto->id}}">

                                                    {{$Producto->nombre}} /
                                                    @if($Producto->stock == '0')
                                                        Estado: {{   $Producto->estado}}
                                                        @else
                                                        Stock: {{$Producto->stock}}
                                                        @endif
                                                     /  Precio: {{$Producto->precio}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-auto float-right">
                                        <div class="col">
                                            <label for="inputEmail4" class="">Cantidad </label>
                                            <input type="text" class="form-control" name="cantidad" id="cantidad">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class=" form-inline mb-2 mb-lg-0 justify-content-center">
                            <div class="input-group">
                                <input type="submit" class="btn btn-success  mr-sm-3 d-block mx-auto " value="{{'Agregar'}}">


                                <br/>
                            </div>
                        </div>

    </form>

    <div class="col-md-auto" >
                            <div class="card">
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover  table-sm" >
                                <thead class="thead-light">
                                <tr >
                                    <th> No</th>
                                    <th> Cantidad</th>
                                    <th> Producto</th>
                                    <th> Precio</th>
                                    <th> Subtotal</th>
                                    <th  class=" form-inline justify-content-center">Actiones</th>
                                </tr>
                                </thead>
                                @foreach($Detalle as $item)
                                    <tr >
                                        <td >{{ $loop->iteration }}</td>
                                        <td >{{ $item->cantidad }}</td>
                                        <td >{{$item->nombre}}</td>
                                        <td >{{$item->precio}}</td>
                                        <td >{{$item->subtotal}} </td>
                                        <td >
                                            <div class="form-inline my-2 my-lg-0 justify-content-center">
                                                <div class="input-group">
                                                    <form method="POST" action="{{ url('/Factura/'.$item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}

                                                        {{ csrf_field() }}
                                                        <a> <button type="submit" class="btn btn-danger btm-smn mt-1 fa fa-trash-alt " title="Eliminar Cliente" onclick="return confirm('¿Desea Borrar el Dato?');"> </button> </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>

                        </div>
                    </div>
                    </div>

                        <form action="{{ url('/Factura/'.$Factura->id.'/Detalle') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}{{ method_field('PATCH') }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control text-sm-center" name="total" value="{{$Suma}}" readonly>
                                </div>
                            </div>
                            <div class=" form-inline mb-2 mb-lg-0 justify-content-center">
                                <div class="input-group">
                                    <input type="submit" class="btn btn-success  mr-sm-3 d-block mx-auto " value="{{'Finalizar' }}">


                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>






    <script type="text/javascript">
        $('#productos_id').select2();
    </script>
@endsection
