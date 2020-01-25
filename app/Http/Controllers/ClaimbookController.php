<?php

namespace App\Http\Controllers;

use App\Claimbook;
use Illuminate\Http\Request;
use Session;

class ClaimbookController extends Controller
{
    public function index()
    {
    	return view('panel.claimbook.index');
    }

    public function getClaims(Request $request)
    {
    	$claims = Claimbook::orderBy('created_at', 'ASC')->paginate(10);
    	return response()->json($claims);
    }

    public function update(Request $request, $id)
    {
        //validación
        $validation = \Validator::make($request->all(),[
            'response' => 'required|string'
        ]);
        //condicionando validación de elementos no recuperables
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }
        //Buscando el item a actualizar
        $claim = Claimbook::find($id);

        //Asignando valores para actualizar
        $claim->request_client = $request->response;
        $claim->save();

        //Retornando la respuesta
        return response()->json(['message'=>'Respuesta ingresada correctamente'], 200);
    }
}
