<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index(Request $id)
    {
        //
        $keyword = $id->get('search');
        $perPage = 20;

        if (!empty($keyword)) {
            $Cliente = DB::table('clientes')
                ->where('nombre', 'LIKE', "%$keyword%")->orWhere('apellido', 'LIKE', "%$keyword%")
                ->orWhere('edad', 'LIKE', "%$keyword%")->orWhere('telefono', 'LIKE', "%$keyword%")
                ->orWhere('nit', 'LIKE', "%$keyword%")->orWhere('direccion', 'LIKE', "%$keyword%")
                ->select('clientes.*')
                ->latest()->paginate($perPage);
        } else {
            $Cliente = DB::table('clientes')
                ->select('clientes.*')
                ->paginate($perPage);


        }


        return view('Cliente.index',  compact('Cliente'));



    }


    public function create()
    {

        return view('Cliente.create');
    }


    public function store(Request $request)
    {

        $campos=[
            'nit'=>'required|string|max:100',
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'edad'=>'required|max:100',
            'telefono'=>'required|string|max:100',
            'direccion'=>'required|string|max:100',

        ];
        $Mensaje=["required"=>'La :attribute es requerida'];
        $this->validate($request,$campos,$Mensaje);

        $datosCliente=request()->except('_token');
        cliente::insert($datosCliente);

        return redirect('Cliente')->with('Mensaje','Cliente agregado con Exito');
    }


    public function show($id)
    {


    }


    public function edit($id)
    {
        //
        $Cliente = cliente::findOrFail($id);

        return view('Cliente.edit',compact('Cliente'));
    }


    public function update(Request $request, $id)
    {
        //
        //Para requerir y validar datos
        $campos=[
            'nit'=>'required|string|max:100',
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'edad'=>'required|max:100',
            'telefono'=>'required|string|max:100',
            'direccion'=>'required|string|max:100',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);


        $datosCliente=request()->except(['_token','_method']);
        cliente::where('id','=',$id)->update($datosCliente);

        return redirect('Cliente')->with('Mensaje','Cliente modificado con Exito');
    }


    public function destroy($id)
    {
        //
        cliente::destroy($id);
        return redirect('Cliente')->with('Mensaje','Cliente eliminado con Exito');
    }
}
