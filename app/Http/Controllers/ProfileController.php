<?php

namespace App\Http\Controllers;

use Validator;
use App\Profile;
use App\Dimension;
use App\ProfilePart;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProfileController extends Controller
{
    public function index()
    {
    	// $profile = Profile::where('slug','15')->with(['dimensions' => function($q){
    	// 	$q->with('dimension');
    	// }])->with(['parts' => function($query){
    	// 	$query->with('dimensions_profile');
    	// }])->first();

        
        return view('panel.profile.index');
    }
    public function getProfiles()
    {
            $profiles = Profile::with('creator','markets','category')->orderBy('id','desc')->get();
            return response()->json([
                'profiles'  =>  $profiles
            ]);
    }

    public function generateTemplateExcelParts(Request $request)
    {
        Excel::create('plantilla-partes-del-perfil', function($excel){

            $profile = Profile::find($request->profile_id);
            
            $excel->sheet('', function($sheet){



                $sheet->row(1, [
                    'Tipo',
                    'Resumen',
                    'Información',
                    'Nombre de imagen',
                    'Estado',
                    'Categoría'
                ]);
                
            });

        })->export('xls');
    }
    
    public function getDimensions()
    {
        $dimensions = Dimension::all();
        return response()->json($dimensions);
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'type'      =>  'required',
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

        $profile = Profile::create([
            'type'  =>  $request->type,
            'slug'  =>  str_slug($request->type).'-'.uniqid(),
            'summary'   =>  $request->summary,
            'body'      =>  $request->body,
            'url_image' => $img_name,
            'category_id'  => $request->category,
            'created_by'    => Auth()->user()->id,
        ]);

        $profile->unit_measurements()->createMany([
            ['name' => 'METRIC','enabled' => false],
            ['name' => 'INCH', 'enabled' => false]
        ]);


        foreach ($request->unit_measurements as $value) {
            $profile->unit_measurements()->where('name',$value)->update(['enabled' => true]);
        }


        foreach ($request->dimensions as $value) {
            $profile->dimensions()->create([
                'dimension_id'  =>  $value
            ]);
        }

        return response()->json(['message'  =>  'Registro exitoso'], 201);

    }

    public function getParts($profile_id)
    {
        $profile = Profile::where('id',$profile_id)->with('unit_measurements')
        ->with(['dimensions' => function($query){
            $query->orderBy('id','ASC')->with('dimension');
        }])
        ->with(['parts' => function($query){
            $query->with(['dimensions_profile' => function($query){
                $query->orderBy('id','ASC')->with('dimension');
            }]);
        }])->first();
        
        return response()->json($profile, 200);
        

    }
}
