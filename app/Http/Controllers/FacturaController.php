<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\detalle_venta;
use App\Models\factura;
use App\Models\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function index(Request $id)
    {
        //
        $keyword = $id->get('search');
        $perPage = 20;

        if (!empty($keyword)) {
            $Factura = factura ::where('factura', 'LIKE', "%$keyword%")
                ->orWhere('id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $Factura = factura::latest()->paginate($perPage);

        }


        return view('Factura.index',  compact( 'Factura'));



    }


    public function create()
    {


        $Cliente = cliente::all();
        $Producto = producto::all();
        $Factura = factura::all();

        return view('Factura.create', compact('Cliente', 'Producto', 'Factura'));
    }

    public function store(Request $request)
    {
        // try{
        DB::beginTransaction();

        $venta = new factura($request->all());
        /*$venta -> id = $request -> get('id');
        $venta -> cliente_id = $request -> get('cliente_id');
        $venta -> negocio_id = $request -> get('negocio_id');
        $venta -> fecha = $request -> get('fecha');
        $venta -> descuento = $request -> get('descuento');
        $venta -> total = $request -> get('total'); */
        $venta->usuario_id = Auth::user()->id;
        $venta->save();
        //  if($venta->save()){
        // $id = $request -> get('id');
        $productos_id = $request ->get('productos_id');
        $cantidad =$request-> get('cantidad');
        $precio = $request -> get('precio');
        $subtotal = $request -> get('subtotal');

        $cont = 0;


        while($cont < count($productos_id)){

            $detalle = new detalle_venta($request->all());
            // $detalle -> id = $id -> id;
            //$detalle -> facturas()->associate($venta);
            $detalle -> facturas_id = $venta -> id;
            $detalle -> productos_id = $productos_id[$cont];
            $detalle -> cantidad = $cantidad[$cont];
            $detalle -> precio = $precio[$cont];
            $detalle -> subtotal = $subtotal[$cont];
            $detalle -> save();

            $cont = $cont+1;
        }

        DB::commit();
        //   return ['id' => $venta->id];

        //}catch (\Exception $e) {
        //  DB::rollback();

        //  }
        return redirect('Factura');

    }


    public function show($id)
    {


        return view('Factura.show');

    }


    public function edit($id)
    {
        //


        return view('Factura.edit',compact('Factura'));
    }


    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $Factura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        facturas::destroy($id);
        //return redirect('Factura');
        return redirect('Factura')->with('Mensaje','Factura eliminado con Exito');
    }
}
