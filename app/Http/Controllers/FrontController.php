<?php

namespace App\Http\Controllers;

use App\Post;
use App\Sede;
use App\Slide;
use App\Video;
use App\Market;
use App\Catalog;
use App\Product;
use App\Profile;
use App\Category;
use App\FluidKey;
use Carbon\Carbon;
use App\FluidGroup;
use App\ProductPart;
use App\Compatibility;

use App\Mail\QuotePart;
use App\TypeApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class FrontController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es');
    }

    public function index()
    {
        $slides = Slide::where('status','1')->get();
        $posts = Post::orderBy('created_at','DESC')->with('images')->limit(3)->get();
        
           
        return view('web.index',compact('slides','posts'));
    }


    public function getProducts()
    {
        $categories = Category::with(['products' => function($query){
            $query->where('status', 1);
        }])->get();
        // return response()->json($categories);
    	return view('web.products', compact('categories'));
    }
    public function getProductsOfCategory($categ_slug)
    {
        $category = Category::where('slug',$categ_slug)->with(['products' => function($query){
            $query->where('status', 1)->with(['operating_conditions' => function($query){
                $query->with('measurement');
            }]);
        }])->first();

        if($category){
            return view('web.category', compact('category'));
        }
        return redirect('/productos');

        // return response()->json($category);
    }
    public function getProduct($categ_slug,$product_slug)
    {
        $category = Category::where('slug',$categ_slug)
        ->with(['products' => function($query){
            $query->where('status', 1);
        }])->first();
        
        $compatibilities = Compatibility::all();
        $product = Product::where([
                ['slug', $product_slug],
                ['status', 1]
            ])->with('dimensions','compatibilities','measurements','operating_conditions','docs', 'parts', 'materials')->first();

        return view('web.product', compact('category','product','compatibilities'));
    }
    
    public function getParts($product_id)
    {
        
        $product = Product::with(['parts' => function($query){
            $query->orderBy('id','DESC');
        }])->findOrFail($product_id);

        return response()->json($product->parts);
    }
    //Catálogos
    public function getCatalogsViews()
    {
    	return view('web.catalogs');
    }
    public function getCatalogs(Request $request)
    {
        $catalogs = Catalog::with('brand')->orderBy('edicion','DESC')->paginate(9);
        return response()->json($catalogs);
    }
    public function getAllEditions(Request $request)
    {
        // $editions=Catalog::groupBy('edicion')->orderBy('id', 'DESC')->get();

        $editions = Catalog::distinct('edicion')->get()->pluck('edicion');
        return response()->json(['editions' => $editions]);
    }



    public function getNewsView(){

        return view('web.news');
    }

    public function getNews(Request $request)
    {
        $posts=Post::where('post_type','N')->orderBy('id','DESC')->with('images')->paginate(9);
        return response()->json($posts);
    }

    public function getEvents(Request $request)
    {
        $posts=Post::where('post_type','E')->orderBy('id','DESC')->with('images')->paginate(9);
        return response()->json($posts);
    }

    public function getNew($slug){
        $post=Post::where('slug',$slug)->first();
        $relations=Post::where('id','<>',$post->id)->where('post_type', 'N')->orderBy('id','DESC')->limit(3)->get();
    	return view('web.new',compact('post','relations'));
    }
    public function getEventsView(){
        return view('web.events');
    }
    public function getEvent($slug){
            $post=Post::where('slug',$slug)->first();
            $relations=Post::where('id','<>',$post->id)->where('post_type', 'E')->orderBy('id','DESC')->limit(3)->get();
            return view('web.event',compact('post','relations'));
    }
    public function getVideosView(){
        return view('web.videos');
    }
    public function getVideos(Request $request)
    {
        $videos=Video::with('category')->orderBy('created_at','DESC')->paginate(9);
        return response()->json($videos);
    }
    public function getContactView(){
        return view('web.contact');
    }
    public function getSedes(Request $request)
    {
        $sedes=Sede::orderBy('created_at', 'DESC')->paginate(9);
        return response()->json($sedes);
    }

    //Funcionamiento de Mailers
    //Enviando solicitud de info para una parte
    public function sendQuotePart(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'name'=>'required|string|max:80',
            'comment'=>'required|string',
            'email'=>'required|email',
            'mobile'=>'required|string|max:15',
            'company'=>'required|string|max:80',
        ],[
            'name.required'=>'Este campo es requerido',
            'mobile.required'=>'El teléfono es requerido',
            'email.required'=>'El correo electrónico es requerido',
            'comment.required'=>'Escriba aqui su consulta',
            'company.required'=>'Este campo es requerido'
        ]);

        $data=[
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'comment'=>$request->comment,
            'company'=>$request->company,
            'part_nro'=>$request->part_nro
        ];
        Mail::to('paolo_xc@hotmail.com')->cc('postmaster2@constructivo.com')
        ->send(new QuotePart($data));
        // Session::flash('msg', 'Su información fue enviada con éxito.'); //para otra vista/ruta
        return back()->with('msg', 'Su información fue enviada con éxito.');
    }

    /* Test de vista de búsqueda*/
    public function getSearchResults(){
        return view('web.productfinder');
    }



    /**
     * Metodo para que devuelve resultados de busqueda
     */
    public function searchQuery(Request $request)
    {
        // Creacion de variables a partir de parametros
        $prod_name = $request->has('prod_name') ? $request->prod_name : '';
        $part_number = $request->has('part_number') ? $request->part_number : 0;
        $max_pressure = $request->has('max_pressure') ? $request->max_pressure : 0;
        $max_speed = $request->has('max_speed') ? $request->max_speed : 0;


        //Busqueda de productos
        $products = Product::where('name', 'like', $prod_name.'%')->get();

        //Busqueda de partes
        $part = ProductPart::where('part_nro', $part_number)->first();


        return response()->json([
            'products'   => $products,
            'part'  => $part
        ], 200);
        


    }

    public function getMarkets()
    {
        $markets = Market::orderBy('id','desc')->get();

        return view('web.markets', compact('markets'));
    }

    public function getMarket($slug)
    {
        $market = Market::where('slug', $slug)->with('products')->first();

        return view('web.market', compact('market'));
    }
}
