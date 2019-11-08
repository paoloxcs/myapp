<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.brand.index');
    }

    public function getBrands(Request $request)
    {
       $brands = Brand::orderBy('id','desc')->paginate(6);
       return response()->json($brands);
    }
    public function getBrandsAll()
    {
        $brands = Brand::orderBy('name','asc')->get();
        return response()->json($brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*return view('panel.brand.create');*/
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
            'name'  =>  'required|string|max:80',
            'url_image'=>   'required'
        ]);

        if($validation->fails()){
            return response()->json(['errors' => $validation->errors()],422);
        }

        $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
        $request->file('url_image')->move(public_path().'/allimages/',$url_image);

        Brand::create([
            'name'  =>  $request->name,
            'slug'  =>  str_slug($request->name),
            'url_image'=> $url_image
        ]);

        return response()->json(['message'=>'Registro exitoso'],200);
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
       /* $brand = Brand::find($id);
        return view('panel.brand.edit',compact('brand'));*/
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
        $validation = \Validator::make($request->all(),['name'=>'required|string|max:80']);
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }

        $brand = Brand::find($id);
        if ($request->file('url_image') && $request->file('url_image') != null ) {
            $path_img_original = $brand->getOriginal('url_image');
            if (file_exists(public_path().'/allimages/'.$path_img_original)) {
                unlink(public_path().'/allimages/'.$path_img_original);
            }
            $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
            $request->file('url_image')->move(public_path().'/allimages/',$url_image);
            $brand->url_image = $url_image;
        }

        if ($request->name != $brand->name) {
            $brand->name = $request->name;
            $brand->slug = str_slug($request->name);
        }
        $brand->status = $request->status;
        $brand->save();

        return response()->json(['message'=>'Actualización exitosa'],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $path_img_original = $brand->getOriginal('url_image');
        if (file_exists(public_path().'/allimages/'.$path_img_original)) {
            unlink(public_path().'/allimages/'.$path_img_original);
        }
        $brand->delete();
        return response()->json(['message'=>'Registro eliminado'],200);
    }
}
