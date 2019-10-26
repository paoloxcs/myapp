<?php

namespace App\Http\Controllers;

use stdClass;
use Validator;
use App\Product;
use App\Category;
use App\Dimension;
use App\Measurement;
use App\ProductPart;
use App\Compatibility;
use Illuminate\Http\Request;
use App\ProductCompatibility;

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

    public function edit($id)
    {
        $categories = Category::all();
        $measurements = Measurement::all();
        $dimensions = Dimension::all();
        $product = Product::with('measurements','dimensions')->findOrFail($id);
        return view('panel.product.edit', compact('categories','product','measurements','dimensions'));
    }

    public function editCompatibility($id)
    {
        $product = Product::with('compatibilities')->findOrFail($id);
        $compatibilities = Compatibility::all();
        return view('panel.product.compatibility', compact('product','compatibilities'));
    }

    public function storeCompatibility(Request $request, $id)
    {


        foreach($request->compats as $compat_id){
            
            $compat1 = ProductCompatibility::firstOrCreate(
                [
                    'name' => 'compat_static_'.$compat_id
                ],
                [
                'type_field' => 'STATIC',
                'product_id' => $id,
                'value_field' => $request["compat_static_$compat_id"],
                'compatibility_id' => $compat_id,
            ]);

            $compat1->value_field = $request["compat_static_$compat_id"];
            $compat1->save();


            $compat2 = ProductCompatibility::firstOrCreate(
                [
                    'name' => 'compat_dynamic_'.$compat_id,
                ],
                [
                'type_field' => 'DYNAMIC',
                'product_id' => $id,
                'value_field' => $request["compat_dynamic_$compat_id"],
                'compatibility_id' => $compat_id
            ]);


            $compat2->value_field = $request["compat_dynamic_$compat_id"];
            $compat2->save();


        }


        return back()->with(['message' => 'Los cambios se guardaron con éxito']);
    }

    // Metodo que permite retornar la vista de partes del producto
    public function ediParts($id)
    {
        $product = Product::with('dimensions','measurements','parts')->findOrFail($id);
        return view('panel.product.parts', compact('product'));
    }

    // Metodo que permite guardar partes del producto
    public function storeParts(Request $request, $id)
    {
        // Busca el producto mediante el id
        $product = Product::with('dimensions')->find($id);
        
        // Crea una instancia de stdClass para acumular las dimensiones
        $object = new stdClass;
        // Itera las dimensiones del producto y obtiene los campos del formulario
        foreach($product->dimensions as $index => $dimen){
            // Agrega la dimension del formulario al objeto con el nombre ejemplo: dimension_0
            $object->{'dimension_'.$index} = $request[$dimen->slug];
        }

        // Guardar en la base de datos 
        $product->parts()->create([
            'part_nro' => $request->part_nro,
            'dimensions' => json_encode($object), // el campo dimensions de la tabla partes recibe un objeto JSON
            'measurement_id' => $request->measurement
        ]);

        return back()->with(['message' => 'Registro guardado']);

    }

    // Metodo para borrar parte del producto
    public function destroyPart($part_id)
    {
        $part = ProductPart::findOrFail($part_id);
        $part->delete();

        return back()->with(['message' => 'Registro eliminado']);
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
