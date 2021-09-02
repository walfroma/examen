@extends('home')

@section('content')

<form action ='{{ url('Factura') }}' class="form-horizontal" method="post" enctype="multipart/form-data">
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
                            <label for="fecha" class="control-label float-right"> {{'Fecha'}}</label>
                            <input type="text" class="form-control float-right " name="fecha" id="fecha" value="{{old('Fecha', date('Y-m-d H:i:s'))}}">
                        </div>


                        <div class="row">
                            <div class="col">
                                <label for="inputEmail4" class="">Cliente <a class="btn btn-success btn-sm   d-block mx-auto float-right"   data-toggle="modal" data-target="#Cliente">Agregar Cliente</a></label>
                                <select name="cliente_id" id="cliente_id" class="form-control">
                                    <option class="form-inline justify-content-center" > Seleccione Cliente </option>
                                    @foreach($Cliente as $Cliente )
                                        <option value="{{$Cliente['id']}}"{{$Cliente->direccion}} >{{$Cliente['id']}} / {{$Cliente['nombre']}} {{$Cliente['apellido']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mt-1">
                                <label for="Direccion" class="control-label"> {{'Direccion'}}</label>
                                <input type="text" class="form-control "  id="direccion" value="" readonly>
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col mt-1 col-md-auto">
                                <label for="productos_id" class="">Producto </label>
                                <br/>
                                <select name="productos_id" id="productos_id" class="form-control col-md-auto" data-Live-search="true" >
                                    <option class="form-inline justify-content-center "  > Seleccione Producto  </option>
                                    @foreach($Producto as $Producto )
                                        <option value="{{$Producto ->id}}_{{$Producto->stock}}_{{$Producto->precio}}_{{$Producto->nombre}} ">{{$Producto->id}}, {{$Producto->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col ">
                                <label for="stock" class="control-label"> {{'Stock'}}</label>
                                <input type="text" class="form-control " name="stock" id="stock" value="" readonly>
                            </div>
                            <div class="col mt-1">
                                <label for="precio">Precio Venta</label>
                                <input type="text" class="form-control"  name="precio" id="precio" >
                            </div>

                            <div class="col mt-1">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="cantidad">
                            </div>
                        </div>
                        <br/>
                        <!------------------------------------------------------------------------------------------------------------------------------------------------------------->
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 d-block mx-auto float-right">
                            <div class="form-group">
                                <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead class="thead-light" style="background-color: #A9D0F5">
                                <tr>
                                    <th  class=" form-inline justify-content-center" >Borrar</th>

                                    <th  >ID</th>
                                    <th  >Producto</th>
                                    <th  >Cantidad</th>
                                    <th  >Precio c/u</th>

                                    <th  >Subtotal</th>

                                </tr>
                                </thead>
                                <tfoot>

                                <th>Total</th>
                                <td></td>
                                <td>{{$Producto->nombre}}</td>
                                <td></td>
                                <td></td>
                                <th>Q<!-- <h4 id="Subtotal">Q 0.00</h4> --><input type="text" name="total" id="total"></th>
                                </tfoot>
                            </table>

                        </div>
                        <!-------------------------------------------------------------------------------------------------------------------------------------------------------------->

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="guardar">
                            <div class="form-group">
                                <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
                                <input type="submit" class="btn btn-success" value="Guardar">

                                <button class="btn btn-danger" type="reset">Cancelar</button>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $("#cliente_id").select2();
        $("#productos_id").select2();

        $(document).ready(function(){

            $('#bt_add').click(function(){
                agregar();

            })
            mostrarValores();

        });

        //variables
        var cont =0;
        total = 0;
        subtotal=[];
        $('#guardar').hide();

        //cada vez que se cambie el articulo se ejecuta
        $('#productos_id').change(mostrarValores);
        $('#cliente_id').change(mostrarValores);

        function mostrarValores(){
            datosArticulo = document.getElementById('productos_id').value.split('_');
            $('#precio').val(datosArticulo[2]);
            $('#stock').val(datosArticulo[1]);

            datosCliente = document.getElementById('cliente_id').value.split('_');
            $('#direccion').val(datosCliente[1]);


        }

        function agregar(){
          //  var regExp = /\(([^)]+)\)/;
            datosArticulo = document.getElementById('productos_id').value.split('_');
            text = $('#productos_id option:selected').text();
            productos_id = datosArticulo[0];

            //productos_id = $('#productos_id option:selected').text();

            cantidad = $('#cantidad').val();
            precio = $('#precio').val();
            stock = $('#stock').val();


            if(productos_id != "" && precio != "" && cantidad != "" && cantidad > 0  )
            {

                if(stock >= cantidad)
                {
                    subtotal[cont] = (cantidad * precio);
                    total = total + subtotal[cont];

                    var fila = '<tr class="selected" id="fila'+cont+'"><td><button class="btn btn-danger" type="button" onclick="eliminar('+cont+');">X</button></td>' +
                        '<td><input type="hidden" name="productos_id[]" value="'+productos_id+'">'+/*   */productos_id+'</td>' +
                        '<td><input type="number" name="cantidad[]" value="'+cantidad+'"></td> ' +
                        '<td><input type="hidden" name="precio[]" value="'+precio+'"> '+/*   */precio+' </td> ' +
                        '<td><input type="hidden" name="subtotal[]" value="'+subtotal+'">Q'+subtotal[cont]+'</td></tr>';

                    //aumentar el contador
                    cont++;

                    //limpiar los controles
                    limpiar();

                    //indicar el subtotal
                    $('#subtotal').html('Q '+subtotal);
                    $('#total').val(total);
                    //mostrar los botones de guardar y cancelar
                    evaluar();

                    //agregar la fila a la tabla
                    $('#detalles').append(fila);

                    cantidad=0;
                    stock=0;
                    precio=0;

                }
                else
                {
                    alert('La cantidad a vender supera el stock de: ' + stock );
                }
            }
            else
            {
                alert('Error al ingresar la venta, revise los datos del articulo');
            }

        }


        function limpiar(){
            $('#cantidad').val('');



        }

        function evaluar(){
            if (total > 0)
            {
                $('#guardar').show();
            }
            else
            {
                $('#guardar').hide();
            }
        }

        function eliminar(index){
            total = total- subtotal[index];
            $('#subtotal').html('Q '+total);
            $('#total').val(total);
            $('#fila' + index).remove();
            evaluar();
        }



    </script>



</form>


@endsection
