<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\categories;
use App\Models\product;

class homeController extends Controller
{
    public function index()
    {   $product['latestProduct'] = product::select('products.*','product_images.image as images')
                                ->join('product_images','product_images.product_id','=','products.id')
                                ->orderBy('id','ASC')
                                ->where('status','1')
                                ->take(6)
                                ->get();
        $product['featured_product'] = product::select('products.*','product_images.image as images')
                                ->join('product_images','product_images.product_id','=','products.id')
                                ->orderBy('id','ASC')
                                ->where('is_featured','Yes')
                                ->get();
        return view('front/index',$product);
    }
}
