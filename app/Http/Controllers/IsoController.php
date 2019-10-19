<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iso;

class IsoController extends Controller
{
    //Vista Panel
    public function index()
    {
    	return view('panel.iso.index');
    }
    //Recuperando Todos los Isos Agregados
    public function getIsos(Request $request)
    {
    	$isos = Iso::orderBy('name','ASC')->paginate(10);
    	return response()->json($isos);
    }
    //Guardando nuevo ISO
    public function store(Request $request)
    {
    	//validating
    	$validation = \Validator::make($request->all(),[
    		'name' => 'required|string',
    		'description' => 'required|string'
    	]);
    	//testing validation
    	if($validation->fails()){
    		return response()->json(['errors'=>$validation->errors()],422);
    	}
    	//Saving
    	$iso=Iso::create([
    		'name'=>$request->name,
    		'description'=>$request->description
    	]);
    	return response()->json(['message'=>'Registro exitoso'],200);
    }
    public function update(Request $request, $id)
    {
    	//validating
    	$validation = \Validator::make($request->all(),[
    		'name'=>'required|string',
    		'description'=>'required|string'
    	]);
    	//testing validation
    	if($validation->fails()){
    		return response()->json(['errors'=>$validation->errors()],422);
    	}
    	//Finding item to update
    	$iso = Iso::find($id);
    	//Updating
    	$iso->name = $request->name;
    	$iso->description = $request->description;
    	$iso->save();

    	return response()->json(['message'=>'Actualización exitosa'],200);
    }
    public function destroy($id)
    {
    	//Finding item
    	$iso = Iso::find($id);
    	$iso->delete();
    	return response()->json(['message'=>'Registro eliminado'],200);
    }
}
