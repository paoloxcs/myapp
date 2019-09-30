<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Session;
use App\Video;

class VideoController extends Controller
{

    //Recuperando vista de Panel
    public function index()
    {
    	return view('panel.video.index');
    }

    //Recuperando todos los videos para Panel
    public function getVideos(Request $request)
    {
        $videos = Video::orderBy('id','DESC')->with('category')->paginate(6);
        return response()->json($videos);
    }

    public function store(Request $request)
    {
    	$validation = \Validator::make($request->all(),[
    	    'nombre' =>  'required|string',
    	    'embed'  =>  'required|string',
    	    'url_image' =>  'required|mimes:jpg,png,jpeg|max:100'
    	]);
    	if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()], 422);
        }

        //Subir foto portada
        $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
        $request->file('url_image')->move(public_path().'/allimages/',$url_image);

        //Registrando  video
        $video = Video::create([
            'nombre' =>  $request->nombre,
            'embed'  =>  $request->embed,
            'url_image'  =>  $url_image,
            'categoria_id' => $request->category_id           
        ]);
        return response()->json(['message'=>'Registro exitoso'], 200);
    }

    public function update(Request $request, $id)
    {
    	$validation = \Validator::make($request->all(),[
            'nombre' =>  'required|string',
            'embed'  =>  'required' 
        ]);

        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()], 422);
        }

        $video = Video::find($id);


        if($request->file('url_image')){
            $validation = \Validator::make($request->all(),['url_image'=>'mimes:jpg,png,jpeg|max:100']);

            if($validation->fails()){
                return response()->json(['errors'=>$validation->errors()], 422);
            }
            if($video->url_image && file_exists(public_path('/allimages/'.$video->url_image))){
                unlink(public_path('/allimages/'.$video->url_image));
            }

            //Subir foto portada
            $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
            $request->file('url_image')->move(public_path().'/allimages/',$url_image);

            $video->url_image=$url_image;


        }

        $video->nombre = $request->nombre;
        $video->embed= $request->embed;
        $video->categoria_id = $request->category_id;    
        $video->save();

        return response()->json(['message'=>'Actualización exitosa'], 200);
    }

    public function destroy($id)
    {
        $video = Video::find($id);        
            if ($video->url_image && file_exists(public_path().'/allimages/'.$video->url_image)) {
                unlink(public_path().'/allimages/'.$video->url_image);
            }
        $video->delete();
        return response()->json(['message'=>'Registro eliminado'], 200);
    }
}
