<?php

namespace App\Http\Controllers;

use stdClass;
use Validator;
use App\Market;
use App\Product;
use App\Category;
use App\Dimension;
use App\ProductDoc;
use App\Iso;
use App\Measurement;
use App\ProductPart;
use App\ProductMaterial;
use App\Compatibility;
use Illuminate\Http\Request;
use App\ProductCompatibility;
use App\ProductOperatingCondition;

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
        $markets = Market::all();
        $product = Product::with('measurements','dimensions','operating_conditions','markets')->findOrFail($id);
        return view('panel.product.edit', compact('categories','product','measurements','dimensions','markets'));
    }

    //Metodo para actualizar el producto
    public function update(Request $request, $id)
    {
        
        $this->validate($request,[
            'name'      =>  'required',
            'summary'   =>  'required|string',
            'body'      =>  'required|string',
            'category'  =>  'required|numeric',
            'dimensions'    =>  'required',
            'measurements'  => 'required',
            'markets'   =>  'required'
        ]);

        
        $product = Product::findOrFail($id);
        if($request->file('url_image')){
            $img_original = $product->getOriginal('url_image');
    
            if($img_original && file_exists(public_path('/allimages/'.$img_original))){
                unlink(public_path('/allimages/'.$img_original));
            }

            $extension= $request->file('url_image')->getClientOriginalExtension();
            $img_name = uniqid().'.'.$extension;
            $request->file('url_image')->move(public_path('/allimages/'),$img_name);

            $product->url_image = $img_name;
        }

        if($request->name != $product->name){
            $product->name = $request->name;
            $product->slug = str_slug($request->name).'.'.str_random(4);
        }

        $product->summary = $request->summary;
        $product->body = $request->body;
        $product->category_id = $request->category;
        $product->status = $request->status;

        $product->save();


        // Crear relacion con unidades de medida
        $product->measurements()->sync($request->measurements);
        // Crear relacion con dimensiones
        $product->dimensions()->sync($request->dimensions);
        // Crear relacion con mercados
        $product->markets()->sync($request->markets);

        return back()->with(['message' => 'Actualización exitosa']);


    }


    // Metodo para guardar condiciones de operacion
    public function storeOperatingCondition(Request $request, $id)
    {
        $this->validate($request, [
            'measurement' => 'required',
            'max_pressure' => 'required|string',
            'max_speed' => 'required|string',
            'min_temp' => 'required|string',
            'max_temp' => 'required|string',
        ]);

        $product = Product::findOrFail($id);
        $product->operating_conditions()->create([
            'max_pressure' => $request->max_pressure,
            'min_temp' => $request->min_temp,
            'max_temp' => $request->max_temp,
            'max_speed' => $request->max_speed,
            'measurement_id' => $request->measurement
        ]);

        return back()->with(['message' => 'Registro hecho']);

    }

    //Metodo para quitar una condicion de operacion
    public function destroyOperatingCondition($operating_id)
    {
        $op_condition = ProductOperatingCondition::findOrFail($operating_id);
        $op_condition->delete();

        return back()->with(['message' => 'Se eliminó un registro']);
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
                    'unique_key' => 'compat'.$compat_id.'static'.$id
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
                    'unique_key' => 'compat'.$compat_id.'dynamic'.$id
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

    //Método que permite retonar la vista de los documentos anexos por perfil
    public function getDocs($id)
    {
        $product= Product::with('docs')->findOrFail($id);
        return view('panel.product.docs', compact('product'));
    }
    //Método que permite guardar los documentos anexos por perfil
    public function storeDocs(Request $request, $id)
    {
        $product = Product::with('docs')->find($id);
        $validation = \Validator::make($request->all(),[
            'name' => 'required|string',
            'ruta' => 'required|mimes:pdf|max:10000'
        ]);
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }
        $ruta = uniqid().'.'.$request->file('ruta')->getClientOriginalExtension();
        $request->file('ruta')->move(public_path().'/docs/',$ruta);
        $product->docs()->create([
            'name' => $request->name,
            'url_doc' => $ruta,
        ]);
        return back()->with(['message' => 'Registro guardado']);
    }
    //Método para eliminar el documento anexo al perfil
    public function destroyDoc($doc_id)
    {
        $doc = ProductDoc::findOrFail($doc_id);
        if($doc->url_doc && file_exists(public_path().'/docs/'.$doc->url_doc)){
            unlink(public_path().'/docs/'.$doc->url_doc);
        }
        $doc->delete();
        return back()->with(['message' => 'Se eliminó el documento']);
    }

    //Método que permite retornar la vista de los materiales disponibles por perfil
    public function getMaterials($id)
    {
        $product=Product::with('materials')->findOrFail($id);
        return view('panel.product.material', compact('product'));
    }
    //Método que permite guardar los materiales disponibles por perfil
    public function storeMaterials(Request $request, $id)
    {
        $product = Product::with('materials')->find($id);
        $validation = \Validator::make($request->all(),[
            'name' => 'required|string',
            'type' => 'required|string',
            'colour' => 'required|string',
            'options' => 'required|string'
        ]);
        if($validation->fails()){
            return response()->json(['errors'=>$validation->errors()],422);
        }
        $product->materials()->create([
            'name' => $request->name,
            'type' => $request->type,
            'colour' => $request->colour,
            'options' => $request->options
        ]);
        return back()->with(['message' => 'Registro guardado']);
    }
    //Método para eliminar el material agregado por perfil
    public function destroyMaterial($material_id)
    {
        $material = ProductMaterial::findOrFail($material_id);
        $material->delete();
        return back()->with(['message' => 'Se eliminó el material']);
    }
    //Método para listar los certificados asociados por Perfil
    public function getIsos($id)
    {
        $isos = Iso::orderBy('name','asc')->get();
        $product=Product::with('isos')->findOrFail($id);
        return view('panel.product.iso', compact('product', 'isos'));
    }
    //Método para agregar una certificación a un Perfil
    public function storeProductIso(Request $request, $id)
    {
        $product = Product::with('isos')->find($id);
        $product->isos()->syncWithoutDetaching([
            'iso_id' => $request->iso,
            'product_id' => $product->id,
        ]);
        return back()->with(['message' => 'Registro guardado']);
    }
    //Método para eliminar una certificación a un Perfil
    public function destroyProductIso($iso_id)
    {
        $product = Product::with('isos')->find($iso_id);
        $product->isos()->detach();
        return back()->with(['message' => 'Registro guardado']);
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

        //Subiendo Documento
        $ruta = uniqid().'.'.$request->file('ruta')->getClientOriginalExtension();
        $request->file('ruta')->move(public_path().'/docs/',$ruta);

        // Guardar en la base de datos 
        $product->parts()->create([
            'part_nro' => $request->part_nro,
            'dimensions' => json_encode($object), // el campo dimensions de la tabla partes recibe un objeto JSON
            'measurement_id' => $request->measurement,
            'ruta' => $ruta
        ]);

        return back()->with(['message' => 'Registro guardado']);

    }

    // Metodo para borrar parte del producto
    public function destroyPart($part_id)
    {
        $part = ProductPart::findOrFail($part_id);
        //Buscando el documento anexo
        if($part->ruta && file_exists(public_path().'/docs/'.$part->ruta)){
            unlink(public_path().'/docs/'.$part->ruta);
        }
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
