
@extends('home')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header"><a class="btn btn-primary  " style="width:auto; margin: 0 auto;" id="regresar"><i class="fas fa-arrow-left "></i></a>
                        {{ $Modo == 'crear' ? '  Agregar  Producto' : '  Modificar Producto' }}</div>
                    <div class="card-body">


                        <div class="form-group">
                            <select name="categoria_id" id="categoria_id" class="form-control"  required>
                                <option value="">Seleccione Categoria </option>
                                @foreach($Categoria as $Categoria )
                                    <option value="{{$Categoria['id']}}" > {{$Categoria['categoria']}} </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="nombre" class="control-label"> {{'Nombre'}}</label>
                            <input type="text" class="form-control {{$errors->has('Nombre') ? 'is-invalid' :'' }}" name="nombre" id="nombre" value="{{ isset($Producto->nombre)? $Producto->nombre:''}}"  required>
                            {!! $errors->first('Nombre','<div class="invalid-feedback"> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="precio" class="control-label"> {{'Precio'}}</label>
                            <input type="number" step="0.01" class="form-control {{$errors->has('Precio') ? 'is-invalid' :'' }}" name="precio" id="precio" required  >
                            {!! $errors->first('Precio','<div class="invalid-feedback"> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="precio" class="control-label"> {{'Cantidad'}}</label>
                            <input type="number" step="0.01" class="form-control {{$errors->has('Precio') ? 'is-invalid' :'' }}" name="stock" id="stock" required  >
                            {!! $errors->first('Precio','<div class="invalid-feedback"> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="control-label"> {{'Descripcion'}}</label>
                            <textarea type="text" class="form-control {{$errors->has('Descripcion') ? 'is-invalid' :'' }}" name="descipcion" id="descripcion" required rows="4" cols="50" maxlength="190"> </textarea>
                            <span class="contador" id="contador">190 caracteres          restantes </span>
                            {!! $errors->first('Descripcion','<div class="invalid-feedback"> :message</div>') !!}
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

    <script type="text/javascript">

        $("#categoria_id").select2();


        //CONTADOR DE CARACTERES PARA EL TEXTAREA
        var limit = 190;
        $(function() {
            $("#descripcion").on("input", function () {
                //al cambiar el texto del txt_detalle
                var init = $(this).val().length;
                total_characters = (limit - init);

                $('#contador').html(total_characters + " caracteres restantes");
            });
        });


    </script>
@endsection
