@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-md-auto" >
                <div class="card">
                    <div class="card-header">

                            <span class="badge badge-pill badge-primary float-right"> {{ $Producto->count()}}  </span>


                        <div class="form-inline justify-content-center">Producto</div>
                    </div>
                    <div class="card-body">

                            <a href="{{ url('Producto/create') }}" class="btn btn-success btn-smn  float-left mr-sm-2 my-1   fa-1x" title="Crear Producto"><i class="fa fa-plus"></i>
                            </a>



                        <form method="GET" action="{{ url('/Producto') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control mr-sm-2" name="search" placeholder="Search..." value="{{ request('search') }}" aria-label="Search">
                                <span class="input-group-append">
                                    <button class="btn btn-outline-success mr-sm-2" type="submit">
                                       Buscar
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>

                        @if(Session::has('Mensaje'))
                            <div class="alert alert-success close d-block mx-auto" style="font-size: 100% " data-dismiss="alert">

                                {{Session::get('Mensaje')}} &times

                            </div>
                        @endif


                        <div class="table-responsive">
                            <table class="table table-condensed table-hover  table-sm" >
                                <thead class="thead-light">
                                <tr >
                                    <th> No</th>
                                    <th class="centrado"> Stock</th>
                                    <th class="centrado"> Categoria</th>
                                    <th class="centrado"> Nombre</th>
                                    <th class="centrado"> Precio</th>
                                    <th class="centrado"> Estado</th>

                                    <th  class="centrado">Actiones</th>
                                </tr>
                                </thead>

                                @foreach($Producto as $item)
                                    <tr >
                                        <td class="centrado">{{ $loop->iteration }}</td>
                                        <td class="centrado">{{ $item->stock }}</td>
                                        <td class="centrado">{{ $item->categoria }}</td>
                                        <td class="centrado">{{ $item->nombre }}</td>
                                        <td class="centrado">Q {{$item->precio}}</td>

                                        <td class="centrado">@if($item->estado == "Disponible")
                                                <h5><span class="badge badge-pill badge-success text-dark">{{$item->estado}}</span></h5>
                                            @else
                                                <h5><span class="badge badge-pill badge-danger text-dark">{{$item->estado}}</span></h5>
                                            @endif</td>
                                        <td class="centrado">
                                            <div class="form-inline my-2 my-lg-0 justify-content-center">
                                                <div class="input-group">



                                                        <a href="{{ url('/Producto/' . $item->id . '/edit') }}" title="Editar Producto"> <button class="btn btn-warning btn-smn mr-sm-2 mt-1 fa fa-edit"> </button></a>

                                                        <form method="POST" action="{{ url('/Producto' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <a> <button type="submit" class="btn btn-danger btm-smn mt-1 fa fa-trash-alt " title="Eliminar Producto" onclick="return confirm('¿Desar dar de baja el producto?');"> </button> </a>

                                                        </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                            </table>




                            <div class="pagination-wrapper"> {!! $Producto->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
