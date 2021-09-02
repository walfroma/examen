<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $id)
    {
        //
        $keyword = $id->get('search');
        $perPage = 20;

        if (!empty($keyword)) {
            $Categoria = categoria::where('categoria', 'LIKE', "%$keyword%")
                ->orWhere('id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $Categoria = categoria::orderBy('categoria', 'ASC')->paginate($perPage);

        }

        return view('Categoria.index',  compact('Categoria'));

    }

    public function create()
    {

        return view('Categoria.create');
    }

    public function store(Request $request)
    {
        //Para requerir y validar datos
        $campos=[
            'categoria'=>'required|string|max:100'
        ];
        $Mensaje=["required"=>'La :attribute es requerida'];
        $this->validate($request,$campos,$Mensaje);

        $datosCategoria=request()->except('_token');
        categoria::insert($datosCategoria);

        return redirect('Categoria')->with('Mensaje','Categoria agregado con exito');
    }


    public function edit($id)
    {
        //
        $Categoria = categoria::findOrFail($id);

        return view('Categoria.edit',compact( 'Categoria'));
    }


    public function update(Request $request, $id)
    {
        //
        //Para requerir y validar datos
        $campos=[
            'categoria'=>'required|string|max:100'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);


        $datosCategoria=request()->except(['_token','_method']);
        categoria::where('id','=',$id)->update($datosCategoria);


        return redirect('Categoria')->with('Mensaje','Categoria modificado con exito');
    }

    public function destroy($id)
    {
        //
        categoria::destroy($id);
        return redirect('Categoria')->with('Mensaje','Categoria eliminado con exito');
    }
}
