<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\categories;
use App\Models\subcategories;
use App\Models\brands;

class shopController extends Controller
{
    public function index(Request $request, $categorySlug=null, $subcategorySlug=null){

        $categorySelected = '';
        $subcategorySelected = '';
        $brandSelected = [];
         $category = categories::orderBy('id','ASC')
                                ->with('sub_category')
                                ->where('status','1')
                                ->get();
        $brand = brands::orderBy('id','ASC')->get();
        $products = product::with('product_image')
                            ->where('status','1');
        if(!empty($categorySlug))
        {
            $categorys = categories::where('slug',$categorySlug)->first();
            $products = $products->where('categories_id',$categorys->id);
        }
        if(!empty($subcategorySlug))
        {
            $subcategory = subcategories::where('slug',$subcategorySlug)->first();
            $products = $products->where('subcategories_id',$subcategory->id);
        }
        if(!empty($request->get('brand')))
        {
            $brandSelected = explode(',',$request->get('brand'));
            $products = $products->whereIn('brand_id',$brandSelected);
        }
        $products = $products->get();
        $product['product'] = $products;
        $product['categories'] =$category;
        $product['brand'] =$brand;
        $product['brandSelected'] =$brandSelected;
        return view('front/shop',$product);
    }
    public function product_front($slug)
    {
        $product = product::where('slug',$slug)->with('product_image')->first();
        $data['product'] = $product;
        return view('front/single',$data);
    }
}
