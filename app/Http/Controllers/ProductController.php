<?php

namespace App\Http\Controllers;

use App\Product;
use App\Dimension;
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
            'unit_measurements'  => 'required'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 422);
        }

        $extension= $request->file('url_image')->getClientOriginalExtension();
        $img_name = uniqid().'.'.$extension;
        $request->file('url_image')->move(public_path('/allimages/'),$img_name);

        




        return response()->json(['message'  =>  'Registro exitoso'], 201);

    }

    public function getParts($profile_id)
    {

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
