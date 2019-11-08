<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\PostImage;
use Illuminate\Http\Request;
use Session;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.post.index');
    }

    public function getPosts(Request $request)
    {
        $posts = Post::orderBy('id','DESC')->with('user')->paginate(6);
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(),[
            'title' =>  'required|string',
            'body'  =>  'required',
            'url_image' =>  'required'    
        ]);
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()], 422);
        }

        $post = Post::create([
            'title' =>  $request->title,
            'slug'  =>  str_slug($request->title),
            'summary'   =>  $request->summary,
            'body'  =>  $request->body,
            'user_id'   =>  Auth()->user()->id,
            'post_type' => $request->post_type
        ]);

        //Subir foto principal
        $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
        $request->file('url_image')->move(public_path().'/allimages/',$url_image);

        PostImage::create([
            'url_image' =>  $url_image,
            'is_main'   =>  true,
            'post_id'   =>  $post->id
        ]);

        return response()->json(['message'=>'Registro exitoso'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validation = \Validator::make($request->all(),[
            'title' =>  'required|string',
            'body'  =>  'required'    
        ]);

        if($validation->fails()){
            return response()->json(['errros'=>$validation->errors()], 422);
        }

        $post = Post::find($id);
        if ($request->title != $post->title) {
            $post->title = $request->title;
            $post->slug = str_slug($request->title);
        }

        $post->body = $request->body;
        $post->summary = $request->summary;
        $post->status = $request->status;
        $post->post_type = $request->post_type;
        $post->save();

        return response()->json(['message'=>'Actualización exitosa'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $fotos = PostImage::where('post_id','=',$post->id)->get();
        foreach ($fotos as $foto) {
            if (file_exists(public_path().'/allimages/'.$foto->url_image)) {
                unlink(public_path().'/allimages/'.$foto->url_image);
            }
        }

        $post->delete();
        return response()->json(['message'=>'Registro eliminado'], 200);
    }

    public function getPhotos($id)
    {
        $photos = PostImage::where('post_id',$id)->orderBy('id','desc')->get();

        return response()->json($photos);
    }

    public function savePhotos(Request $request)
    {
        $validation = \Validator::make($request->all(),[
            'photos' => 'required'
        ]);

        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()], 422);
        }

        foreach ($request->file('photos') as $index => $photo) {
           $url_image = uniqid().$index.'.'.$photo->getClientOriginalExtension();
           $photo->move(public_path().'/allimages/',$url_image);

           PostImage::create([
            'url_image' => $url_image,
            'is_main' => false,
            'post_id' => $request->post_id,
           ]);
        }

        return response()->json(['message'=>'Registro exitoso'], 200);
    }

    public function changeMainPhoto($id)
    {
        $photo = PostImage::find($id); // find photo by id
        $post = $photo->post; // get post relationship
        foreach ($post->images as $image) { // interation post->images
            $image->is_main = false; // change status is_main to false all images of post
            $image->save(); // save change
        }

        $photo->is_main = true; // define status main to true of photo in request
        $photo->save(); // save change

        return response()->json(['message'=>'Actualización exitosa'], 200);
    }

    public function destroyPhoto($id)
    {
        $photo = PostImage::find($id);
        $path_img_original = $photo->getOriginal('url_image');
        if (file_exists(public_path().'/allimages/'.$path_img_original)) {
            unlink(public_path().'/allimages/'.$path_img_original);
        }

        $photo->delete();

        return response()->json(['message'=>'Registro eliminado'], 200);
    }
}
