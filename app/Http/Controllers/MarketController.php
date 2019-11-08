<?php

namespace App\Http\Controllers;

use App\Market;
use Illuminate\Http\Request;
use Session;
class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $markets = Market::orderBy('id','desc')->get();
        return view('panel.market.index',compact('markets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.market.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'      =>  'required|string|max:80',
            'url_image' =>  'required' 
        ]);
        $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
        $request->file('url_image')->move(public_path().'/allimages/',$url_image);
        
        Market::create([
            'name'  =>  $request->name,
            'slug'  =>  str_slug($request->name),
            'url_image'=> $url_image
        ]);

        Session::flash('msg-success','Registro exitoso!');
        return redirect()->route('markets.index');

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
        $market = Market::find($id);
        return view('panel.market.edit',compact('market'));
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
        $this->validate($request,[
            'name'  =>  'required|string'
        ]);
        $market = Market::find($id);
        if ($request->file('url_image')) {
            $path_img_original = $market->getOriginal('url_image');
            if(file_exists(public_path().'/allimages/'.$path_img_original)){
                unlink(public_path().'/allimages/'.$path_img_original);
            }
            
            $url_image = uniqid().'.'.$request->file('url_image')->getClientOriginalExtension();
            $request->file('url_image')->move(public_path().'/allimages/',$url_image);

            $market->url_image = $url_image;
        }

        if ($request->name != $market->name) {
            $market->name = $request->name;
            $market->slug = str_slug($request->name);
        }

        $market->save();
        Session::flash('msg-success','Actualización exitosa!');
        return redirect()->route('markets.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $market = Market::find($id);
        $path_img_original = $market->getOriginal('url_image');
        if(file_exists(public_path().'/allimages/'.$path_img_original)){
            unlink(public_path().'/allimages/'.$path_img_original);
        }
        $market->delete();

        return back()->with('msg-success','Registro eliminado!');
    }
}
