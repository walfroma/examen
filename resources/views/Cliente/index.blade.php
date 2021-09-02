@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-md-auto" >
                <div class="card">
                    <div class="card-header">
                        <span class="badge badge-pill badge-primary float-right"> {{ $Cliente->count()}}  </span>
                        <div class="form-inline justify-content-center">Cliente</div>
                    </div>
                    <div class="card-body">

                            <a href="{{ url('Cliente/create') }}" class="btn btn-success btn-smn  float-left mr-sm-2 my-1   fa-1x" title="Crear Cliente"><i class="fa fa-plus"></i>
                            </a>






                        <form method="GET" action="{{ url('/Cliente') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th> Nombre</th>
                                    <th> Apellido</th>
                                    <th> Edad</th>
                                    <th> Telefono</th>
                                    <th> Direccion</th>

                                    <th  class=" form-inline justify-content-center">Actiones</th>
                                </tr>
                                </thead>

                                @foreach($Cliente as $item)
                                    <tr >
                                        <td >{{ $loop->iteration }}</td>
                                        <td >{{ $item->nombre }}</td>
                                        <td >{{$item->apellido}}</td>
                                        <td >{{$item->edad}}</td>
                                        <td >{{$item->telefono}}</td>
                                        <td >{{$item->direccion}}</td>
                                        <td >
                                            <div class="form-inline my-2 my-lg-0 justify-content-center">
                                                <div class="input-group">


                                                        <a href="{{ url('/Cliente/' . $item->id . '/edit') }}" title="Editar Cliente"> <button class="btn btn-warning btn-smn mr-sm-2 mt-1 fa fa-edit"> </button></a>


                                                        <form method="POST" action="{{ url('/Cliente' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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




                            <div class="pagination-wrapper"> {!! $Cliente->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
