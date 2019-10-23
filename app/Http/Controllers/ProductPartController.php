<?php

namespace App\Http\Controllers;

use Validator;
use App\Product;
use App\ProductPart;
use App\Dimension;
use App\Measurement;
use Illuminate\Http\Request;

class ProductPartController extends Controller
{
    public function index($id)
    {
    	$heads=Product::with(['dimensions' => function($q) use($id){
            $q->where('product_id','=',$id)->orderBy('id');
        }])->get();
       return view('panel.productpart.index', compact('heads'));
    }
}
