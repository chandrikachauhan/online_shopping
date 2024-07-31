<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\subcategories;
use Illuminate\support\facades\validator;

class subcategoriesController extends Controller
{
    public function index()
    {
        $categories = categories::get();
        $subcategories = subcategories::select('subcategories.*','categories.name as categoriesName')
                            ->latest('id')
                            ->leftJoin('categories','categories.id','subcategories.categories_id');
        $subcategories = $subcategories->get();
        return view('admin/subcategories',[
            'categories'=>$categories,
            'subcategories'=>$subcategories
        ]);
    }
    public function create(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required'
        ]);
        if($validator->passes())
        {
            $store = new subcategories;
            $store->name = $request->name;
            $store->categories_id = $request->categories_id;
            $store->slug = $request->slug;
            $store->status = $request->status;
            $store->created_at = now();
            $store->save();
            return response()->json([
                'status' => 'true',
                'messages' => 'data created duccessful'
            ]);
        }
        else{
            return response()->json([
                'status' => 'false',
                'messages' => $validator->messages()
            ]);
        }

    }
    public function delete(string $id)
    {
        $data_delete = subcategories::find($id);
        $data_delete->delete();
        return response()->json([
            'status' => 'true',
            'messages'=>'Data delete successful'
        ]);
    }
    public function update(string $id)
    {
        $get_single = subcategories::find($id);
        return view('admin/subcategoriesupdate',['single_data'=>$get_single]);
    }
    public function store(Request $request)
    {
        $update = subcategories::find($request->cate_id);
        $update->name =$request->name;
        $update->slug =$request->slug;
        $update->status =$request->status;
        $update->updated_at = now();
        $update->save();
        return redirect()->route('subcategories');
    }
}
