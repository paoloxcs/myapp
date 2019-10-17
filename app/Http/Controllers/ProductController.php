<?php

namespace App\Http\Controllers;

use Validator;
use App\Product;
use App\Dimension;
use App\Measurement;
use App\Compatibility;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('panel.product.index');
    }
    public function getProducts()
    {
        $products = Product::with('category')->orderBy('id','DESC')->paginate(6);
        return response()->json($products, 200);

    }

    
    public function getDimensions()
    {
        $dimensions = Dimension::all();
        return response()->json($dimensions);
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'      =>  'required',
            'summary'   =>  'required|string',
            'body'      =>  'required|string',
            'url_image' =>  'required|mimes:jpg,png,jpeg|max:100',
            'category'  =>  'required|numeric',
            'dimensions'    =>  'required',
            'measurements'  => 'required'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 422);
        }

        $extension= $request->file('url_image')->getClientOriginalExtension();
        $img_name = uniqid().'.'.$extension;
        $request->file('url_image')->move(public_path('/allimages/'),$img_name);

        $product = Product::create([
            'name'  =>  $request->name,
            'slug'  => str_slug($request->name).'-'.str_random(4),
            'summary' => $request->summary,
            'body'  => $request->body,
            'url_image' => $img_name,
            'category_id' => $request->category,
        ]);

        // Crear relacion con unidades de medida
        $product->measurements()->sync($request->measurements);
        // Crear relacion con dimensiones
        $product->dimensions()->sync($request->dimensions);

        return response()->json(['message'  =>  'Registro exitoso'], 201);

    }

    public function getParts($profile_id)
    {

    }

    public function getMeasurements()
    {
        $measurements = Measurement::all();
        return response()->json($measurements, 200);
    }
    public function getCompatibilities()
    {
        $compatibilities = Compatibility::all();
        return response()->json($compatibilities, 200);
    }

    // public function generateTemplateExcelParts(Request $request)
    // {
    //     Excel::create('plantilla-partes-del-perfil', function($excel){

    //         $profile = Profile::find($request->profile_id);
            
    //         $excel->sheet('', function($sheet){



    //             $sheet->row(1, [
    //                 'Tipo',
    //                 'Resumen',
    //                 'Información',
    //                 'Nombre de imagen',
    //                 'Estado',
    //                 'Categoría'
    //             ]);
                
    //         });

    //     })->export('xls');
    // }

}
