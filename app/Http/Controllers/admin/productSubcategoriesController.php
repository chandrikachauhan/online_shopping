<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\subcategories;

class productSubcategoriesController extends Controller
{
    public function index(Request $request)
    {
        $subcate = subcategories::orderBy('name','ASC')
                            ->where('categories_id',$request->cate_id)
                            ->get();
            if(!empty($subcate))
            {
                return response()->json([
                    'status'=> true,
                    'psubcategories'=> $subcate
                ]);
            }
            else{
                return response()->json([
                    'status'=> false,
                    'psubcategories'=> []
                ]);
            }
            
    }
}
