<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Session;
use App\Slide;

class SlideController extends Controller
{
    //Recuperando vista de Panel
    public function index()
    {
    	return view('panel.slide.index');
    }

    //Recuperando todos los slides registrados
    public function getSlides(Request $request)
    {
    	$slides = Slide::orderBy('id','DESC')->paginate(10);
    	return response()->json($slides);
    }
    //Registro de un nuevo slide
    public function store(Request $request)
    {
        //validando campos
        $validation = \Validator::make($request->all(),[
            'slidename'=>'required|string',
            'headerline'=>'required|string',
            'slidetext'=>'required|string',
            'textlink'=>'string',
            'actionlink'=>'string',
            'url_image'=>'required|mimes:jpg,png,jpeg|max:100'
        ]);
        //Testeando validación
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }
        //Subiendo imagen
        $url_image=uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
        $request->file('url_image')->move(public_path().'/images/',$url_image);

        //Registrando Slide en la Base de Datos
        $slide = Slide::create([
            'slidename' => $request->slidename,
            'headerline' => $request->headerline,
            'slidetext' => $request->slidetext,
            'textlink' => $request->textlink,
            'actionlink' => $request->actionlink,
            'url_image' => $url_image
        ]);

        //Retornando respuesta via Ajax
        return response()->json(['message'=>'Registro exitoso'],200);
    }

    //Actualizando Slide
    public function update(Request $request, $id)
    {
        //validación
        $validation = \Validator::make($request->all(),[
            'slidename' => 'required|string',
            'headerline' => 'required|string',
            'slidetext' => 'required|string',
            'textlink' => 'string',
            'actionlink' => 'string'
        ]);
        //condicionando validación de elementos no recuperables
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }
        //Buscando el item a actualizar
        $slide = Slide::find($id);

        //Validando si hay nueva imagen para reemplazar
        if($request->file('url_image')){
            $validation = \Validator::make($request->all(),['url_image'=>'mimes:jpg,png,jpeg|max:100']);

            if($validation->fails()){
                return response()->json(['errors'=>$validation->errors()], 422);
            }
            if($slide->url_image && file_exists(public_path('/images/'.$slide->url_image))){
                unlink(public_path('/images/'.$slide->url_image));
            }

            //Subir foto portada
            $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
            $request->file('url_image')->move(public_path().'/images/',$url_image);

            $slide->url_image=$url_image;
        }
        //Asignando valores para actualizar
        $slide->slidename = $request->slidename;
        $slide->headerline= $request->headerline;
        $slide->slidetext = $request->slidetext;
        $slide->textlink = $request->textlink;
        $slide->actionlink = $request->actionlink;
        $slide->status = $request->status;
        $slide->save();

        //Retornando la respuesta
        return response()->json(['message'=>'Actualización exitosa'], 200);
    }

    //Borrando slide
    public function destroy($id)
    {
        $slide = Slide::find($id);
        if($slide->url_image && file_exists(public_path().'/images/'.$slide->url_image)){
            unlink(public_path().'/images/'.$slide->url_image);
        }
        $slide->delete();
        return response()->json(['message'=>'Registro eliminado'],200);
    }
}
