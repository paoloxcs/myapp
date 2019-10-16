<?php

namespace App\Http\Controllers;

use App\Category;
use App\FluidGroup;
use App\FluidKey;
use App\Post;
use App\Catalog;
use App\Profile;
use App\Slide;
use App\Video;
use App\TypeApplication;
use Carbon\Carbon;
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
        $categories = Category::with('profiles')->get();
        // return response()->json($categories);
    	return view('web.products', compact('categories'));
    }
    public function getProductsOfCategory($categ_slug)
    {
        $category = Category::where('slug',$categ_slug)->with('profiles')->first();
        if($category){
            return view('web.category', compact('category'));
        }
        return redirect('/productos');

        // return response()->json($category);
    }
    public function getProduct($categ_slug,$profile_slug)
    {
        $category = Category::where('slug',$categ_slug)->with('profiles')->first();
        
        $profile = Profile::where('slug',$profile_slug)->with(['dimensions' => function($q){
            $q->orderBy('id','ASC')->with('dimension');
        }])->with('unit_measurements')->first();

        $type_applications = TypeApplication::orderBy('id','ASC')->get();
        $fluid_keys = FluidKey::all();
        $fluid_groups = FluidGroup::with(['items.profile_compatibilities' => function($q) use($profile){
            $q->orderBy('type_application_id','ASC')->where('profile_id',$profile->id)->with('fluid_key');
        }])->get();

        // return response()->json($profile);
        return view('web.product', compact('category','profile','type_applications','fluid_keys','fluid_groups'));
    }
    
    public function getParts($profile_id)
    {
        $profile = Profile::where('id',$profile_id)->with(['parts'=> function($q){
            $q->with(['dimensions_profile' => function($query){
                $query->orderBy('id','ASC')->with('dimension');
            }]);
        }])->first();

        return response()->json($profile->parts);
    }
    //Catálogos
    public function getCatalogsViews()
    {
    	return view('web.catalogs');
    }
    public function getCatalogs(Request $request)
    {
        $catalogs=Catalog::with('brand')->orderBy('edicion','DESC')->paginate(9);
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
    public function getContact(){
        return view('web.contact');
    }
}
