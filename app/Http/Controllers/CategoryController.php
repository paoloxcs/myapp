<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.category.index');
    }

    public function getCategories(Request $request)
    {
        $categories = Category::orderBy('id','desc')->paginate(6);
        return response()->json($categories);
    }
    public function getCategoriesAll()
    {
        $categories = Category::orderBy('id','desc')->get();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.category.create');
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
            'name'  =>'required|string|max:100',
            'description' => 'required',
            'url_image' => 'required'
        ]);
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors(),'status'=>422]);
        }

        $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
        $request->file('url_image')->move(public_path().'/allimages/',$url_image);


        // Save subcategoria
        Category::create([
            'name'  =>  $request->name,
            'slug'  =>  str_slug($request->name),
            'description' =>  $request->description,
            'url_image' => $url_image
        ]);

        return response()->json(['message'=>'Registro exitoso','status'=>200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = Category::find($id);
        return view('panel.category.edit',compact('category'));
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
            'name'  =>'required|string|max:100',
            'description' => 'required'
        ]);
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors(),'status'=>422]);
        }

        $category = Category::find($id);

        if ($request->file('url_image')) {
            if (file_exists(public_path().'/allimages/'.$category->url_image)) {
                unlink(public_path().'/allimages/'.$category->url_image);
            }
            $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
            $request->file('url_image')->move(public_path().'/allimages/',$url_image);

            $category->url_image = $url_image;
        }


        if($request->name != $category->name){
            $category->name = $request->name;
            $category->slug = str_slug($request->name);
        }

        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();

        return response()->json(['message'=>'Actualización exitosa','status'=>200]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        if (file_exists(public_path().'/allimages/'.$category->url_image)) {
            unlink(public_path().'/allimages/'.$category->url_image);
        }

        $category->delete();

        return response()->json(['message'=>'Registro eliminado','status'=>200]);
    }
}
