<?php

namespace App\Http\Controllers;

use App\Sede;
use Illuminate\Http\Request;
use Session;

class SedeController extends Controller
{
    public function index()
    {
    	return view('panel.sede.index');
    }

    public function getSedes(Request $request)
    {
    	$sedes = Sede::orderBy('name', 'ASC')->paginate(10);
    	return response()->json($sedes);
    }

    public function store(Request $request)
    {
        //validación
        $validation = \Validator::make($request->all(),[
            'name' => 'required|string',
            'address' => 'required|string',
            'district' =>  'required|string',
            'city' => 'required|string',
            'maps_code' => 'required|string'
        ]);
        //condicionando validación
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }

        //Registrando Nuevo Catálogo
        $sede = Sede::create([
            'name' => $request->name,
            'address' => $request->address,
            'district' => $request->district,
            'city' => $request->city,
            'maps_code'=> $request->maps_code
        ]);
        return response()->json(['message'=>'Registro exitoso'], 200);
    }

    public function update(Request $request, $id)
    {
        //validación
        $validation = \Validator::make($request->all(),[
            'name' => 'required|string',
            'address' => 'required|string',
            'district' =>  'required|string',
            'city' => 'required|string',
            'maps_code' => 'required|string'
        ]);
        //condicionando validación de elementos no recuperables
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }
        //Buscando el item a actualizar
        $sede = Sede::find($id);

        //Asignando valores para actualizar
        $sede->name = $request->name;
        $sede->address= $request->address;
        $sede->district = $request->district;
        $sede->city = $request->city;
        $sede->maps_code = $request->maps_code;
        $sede->save();

        //Retornando la respuesta
        return response()->json(['message'=>'Actualización exitosa'], 200);
    }

    public function destroy($id)
    {
        $sede = Sede::find($id);
        $sede->delete();
        return response()->json(['message'=>'Registro eliminado'],200);
    }
}
