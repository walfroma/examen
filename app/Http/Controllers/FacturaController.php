<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\detalle_venta;
use App\Models\factura;
use App\Models\producto;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

        $Usuario = cliente::all();

        return view('Factura.create', compact(  'Usuario'));
    }

    public function store(Request $request)
    {
        $Factura = new factura($request->all());
        $Factura->usuario_id = Auth::user()->id;
     //   $Factura->cliente_id = $request->cliente_id;
        $Factura->total = '0';
        $Factura->save();


       // $Fac = factura::findOrFail($id);

        return Redirect('Factura/'.$Factura->id.'/Detalle');
    }

    public function detalle($id)
    {
        $Factura = factura::findOrFail($id);
        $Cliente = cliente::all();
        $Producto = producto::all();
        $Detalle = DB::table('detalle_ventas')
            ->join('productos', 'productos.id', 'detalle_ventas.productos_id')->select('detalle_ventas.*', 'productos.nombre')
        ->where('detalle_ventas.facturas_id', '=', $Factura->id)->get();

        $Suma = DB::table('detalle_ventas')->where('detalle_ventas.facturas_id', '=', $Factura->id)
            ->sum('detalle_ventas.subtotal');


        return view('Factura.detalle', compact(  'Cliente', 'Factura', 'Producto', 'Detalle', 'Suma'));
    }

    public function store2(Request $request, $id){

        $Factura = factura::findOrFail($id);
        $Detalle = new detalle_venta($request->all());
        $Detalle->facturas_id = $id;

        $productos_id = $request ->productos_id;
        $Productos = DB::table('productos')->where('id', '=', $productos_id)->value('precio');
        $Detalle->precio = $Productos;

        $cantidad = $request ->cantidad;
        $SUBTOTAL = $cantidad * $Productos;
        $Detalle->subtotal = $SUBTOTAL;
       // dd($Detalle);

        $Detalle->save();


        //return $this->detalle();
        return Redirect('Factura/'.$Factura->id.'/Detalle');

    }


    public function show(Request $request, $id)
    {


    }


    public function update(Request $request, $id)
    {
        $Factura = factura::findOrFail($id);
        $Factura -> fill($request->all());
        $Factura -> update();

        return Redirect('Factura');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $Factura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        detalle_venta::destroy($id);

        return back();

    }
}
