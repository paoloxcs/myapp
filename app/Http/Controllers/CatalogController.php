<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Session;
use App\Catalog;

class CatalogController extends Controller
{
    //Recuperando vista de Panel
    public function index()
    {
    	return view('panel.catalog.index');
    }
    //Recuperando todos los catálogos registrados
    public function getCatalogs(Request $request)
    {
    	$catalogs = Catalog::orderBy('edicion','DESC')->with('brand')->paginate(10);
    	return response()->json($catalogs);
    }

    //Registrando nuevo catálogo
    public function store(Request $request)
    {
        //validación
        $validation = \Validator::make($request->all(),[
            'name' => 'required|string',
            'edicion' => 'required|numeric',
            'url_image' =>  'required|mimes:jpg,png,jpeg|max:100',
            'ruta' => 'required|mimes:pdf|max:10000'
        ]);
        //condicionando validación
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }
        //Subiendo Portada
        $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
        $request->file('url_image')->move(public_path().'/allimages/',$url_image);

        //Subiendo Documento
        $ruta = uniqid().'.'.$request->file('ruta')->getClientOriginalExtension();
        $request->file('ruta')->move(public_path().'/docs/',$ruta);

        //Registrando Nuevo Catálogo
        $catalog = Catalog::create([
            'name' => $request->name,
            'url_image' => $url_image,
            'ruta' => $ruta,
            'edicion' => $request->edicion,
            'brand_id'=> $request->brand_id
        ]);
        return response()->json(['message'=>'Registro exitoso'], 200);
    }

    public function update(Request $request, $id)
    {
        //validación
        $validation = \Validator::make($request->all(),[
            'name' => 'required|string',
            'edicion' => 'required|numeric'
        ]);
        //condicionando validación de elementos no recuperables
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }
        //Buscando el item a actualizar
        $catalog = Catalog::find($id);

        //Validando si hay un nuevo documento para subir
        if($request->file('ruta')){
            $validation = \Validator::make($request->all(),['ruta'=>'mimes:pdf|max:10000']);
            //Validando si el documento cumple con los requisitos
            if($validation->fails()){
                return response()->json(['errors'=>$validation->errors()], 422);
            }
            //Borrando la imagen que se va reemplazar
            if($catalog->ruta && file_exists(public_path('/docs/'.$catalog->ruta))){
                unlink(public_path('/docs/'.$catalog->ruta));
            }
            //Subiendo nueva imagen
            $ruta = uniqid().'.'.$request->file('ruta')->getClientOriginalExtension();
            $request->file('ruta')->move(public_path().'/docs/',$ruta);
            $catalog->ruta=$ruta;
        }

        //Validando si hay nueva imagen para reemplazar
        if($request->file('url_image')){
            $validation = \Validator::make($request->all(),['url_image'=>'mimes:jpg,png,jpeg|max:100']);

            if($validation->fails()){
                return response()->json(['errors'=>$validation->errors()], 422);
            }
            if($catalog->url_image && file_exists(public_path('/allimages/'.$catalog->url_image))){
                unlink(public_path('/allimages/'.$catalog->url_image));
            }

            //Subir foto portada
            $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
            $request->file('url_image')->move(public_path().'/allimages/',$url_image);

            $catalog->url_image=$url_image;
        }
        //Asignando valores para actualizar
        $catalog->name = $request->name;
        $catalog->edicion= $request->edicion;
        $catalog->brand_id = $request->brand_id;  
        $catalog->save();

        //Retornando la respuesta
        return response()->json(['message'=>'Actualización exitosa'], 200);
    }

    public function destroy($id)
    {
        $catalog = Catalog::find($id);
        if($catalog->url_image && file_exists(public_path().'/allimages/'.$catalog->url_image)){
            unlink(public_path().'/allimages/'.$catalog->url_image);
        }
        if($catalog->ruta && file_exists(public_path().'/docs/'.$catalog->ruta)){
            unlink(public_path().'/docs/'.$catalog->ruta);
        }
        $catalog->delete();
        return response()->json(['message'=>'Registro eliminado'],200);
    }
}
