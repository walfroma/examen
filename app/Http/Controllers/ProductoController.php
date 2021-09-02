<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index(Request $id)
    {

        $keyword = $id->get('search');
        $perPage = 20;

            if (!empty($keyword)) {
                $Producto = DB::table('productos')
                    ->join('categorias', 'categorias.id', '=', 'productos.categoria_id')
                    ->where('nombre', 'LIKE', "%$keyword%")->orWhere('descipcion', 'LIKE', "%$keyword%")
                    ->orWhere('precio', 'LIKE', "%$keyword%")
                    ->orWhere('categoria', 'LIKE', "%$keyword%")->orWhere('estado', 'LIKE', "%$keyword%")
                    ->select('productos.*',  'categorias.categoria')
                    ->latest()->orderBy('categoria', 'ASC')
                    ->orderBy('productos.nombre', 'ASC')->paginate($perPage);
            } else {
                $Producto = DB::table('productos')
                    ->join('categorias', 'categorias.id', '=', 'productos.categoria_id')
                    ->select('productos.*', 'categorias.categoria')
                    ->orderBy('categoria', 'ASC')
                    ->orderBy('productos.nombre', 'ASC')->paginate($perPage);
            }





        return view('Producto.index',  compact('Producto'));



    }

    public function create()
    {
        //
        $Categoria = categoria::all();

        return view('Producto.create', compact( 'Categoria'));
    }


    public function store(Request $request)
    {

        $Producto = new producto($request->all());
        $Producto ->estado = 'Disponible';
        $Producto->save();
        return redirect('Producto')->with('Mensaje','Producto agregado con Exito');
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        //
        $Producto = producto::findOrFail($id);
        $Categoria = categoria::all();

        return view('Producto.edit',compact( 'Producto', 'Categoria'));
    }


    public function update(Request $request, $id)
    {

        $Producto = producto::findOrFail($id);
        $Producto->fill($request->all());
        $Producto ->estado = 'Disponible';
        $Producto->update();


        return redirect('Producto')->with('Mensaje','Producto modificado con Exito');
    }


    public function destroy($id)
    {
        $Producto = producto::findOrFail($id);
        $Producto->estado = 'No Disponible';
        $Producto->stock = '0';
        $Producto->update();

        return redirect('Producto')->with('Mensaje','Producto dado de baja con Exito');
    }

}
