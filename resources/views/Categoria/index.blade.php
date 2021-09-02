@extends('home')

@section('content')


    <div class="container">
        <div class="row justify-content-center">


            <div class="col-md-auto" >
                <div class="card">
                    <div class="card-header">
                        <span class="badge badge-pill badge-primary float-right"> {{ $Categoria->count()}}  </span>
                        <div class="form-inline justify-content-center">Categoria</div>
                    </div>
                    <div class="card-body">

                            <a href="{{ url('Categoria/create') }}" class="btn btn-success btn-smn  float-left mr-sm-2 my-1 fa-1x" title="Crear Categoria"> <i class="fa fa-plus"></i>
                            </a>




                        <form method="GET" action="{{ url('/Categoria') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <table class="table table-condensed table-hover  table-sm">
                                <thead class="thead-light">
                                <tr>
                                    <th class="centrado">No</th>
                                    <th  class="centrado">Categoria</th>
                                    <th  class="centrado">Actiones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Categoria as $item)
                                    <tr >
                                        <td class="centrado">{{ $loop->iteration }}</td>
                                        <td class="centrado">{{ $item->categoria }}</td>
                                        <td class="centrado">
                                            <div class="form-inline my-2 my-lg-0 justify-content-center">
                                                <div class="input-group">


                                                        <a href="{{ url('/Categoria/' . $item->id . '/edit') }}" title="Editar Categoria"> <button class="btn btn-warning btn-smn mr-sm-2 mt-1 fa fa-edit">  </button></a>


                                                        <form method="POST" action="{{ url('/Categoria' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <a> <button type="submit" class="btn btn-danger btm-smn mt-1 fa fa-trash-alt " title="Eliminar Categoria" onclick="return confirm('¿Desea borrar la categoria?');"></button> </a>
                                                        </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $Categoria->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

