<?php

namespace App\Http\Controllers;

use App\Post;
use App\Sede;
use App\Slide;
use App\Video;
use App\Catalog;
use App\Product;
use App\Profile;
use App\Category;
use App\FluidKey;
use Carbon\Carbon;
use App\FluidGroup;
use App\Compatibility;
use App\TypeApplication;
use Illuminate\Http\Request;


class FrontController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es');
    }

    public function index()
    {
        $slides = Slide::where('status','1')->get();
        $news=Post::where('post_type','=','N')->orderBy('created_at','DESC')->with('images')->limit(3)->get();
        // $news=Post::where('post_type','=','N')->orderBy('created_at','DESC')->with(['images' => function($query){$query->where('is_main',1);}])->limit(3)->get();
           
        return view('web.index',compact('slides','news'));
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
            ])->with('dimensions','compatibilities','measurements','operating_conditions','docs', 'parts')->first();

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
        $relations=Post::where('id','<>',$post->id)->orderBy('id','DESC')->limit(3)->get();
    	return view('web.new',compact('post','relations'));
    }
    public function getEventsView(){
        return view('web.events');
    }
    public function getEvent(){
        return view('web.event');
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
}
