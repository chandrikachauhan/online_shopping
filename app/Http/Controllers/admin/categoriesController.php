<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\facades\validator;
use Illuminate\support\facades\DB;
use Illuminate\support\facades\File;
use App\Models\categories;

class categoriesController extends Controller
{
    public function index()
    {
        $categories_data = DB::table('categories')->get();
        return view('admin/categories',['categories'=>$categories_data]);
    }
    public function create(Request $request)
    {
        $validator = validator::make($request->all(),[
            "name" => "required",
            "slug" => "required",
            'picture' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);
        if($validator->passes()){
            $file_name = null;
            if($request->hasfile('picture'))
            {
                $file = $request->file('picture');
                $path = public_path("assets/uploadCategories");
                $file_name = time().$file->getClientOriginalName();
                $file->move($path , $file_name);
                
            }
            $categories = DB::table('categories')
            ->insert([
            "name" => $request->name,
            "slug" => $request->slug,
            "status" => $request->status,
            "picture" => $file_name,
            "created_at" =>now()
            ]);
                return response()->json([
                    'status' => 'true',
                    'messages' =>'Categories add Successful'
                ]);
        }
        else{
                return response()->json([
                    'status'=>'false',
                    'messages'=>$validator->messages()
                ]);
        }
    }
    public function delete(String $id)
    {
        $data = DB::table('categories')
        ->where('id',$id)
        ->get();
        $destination = "assets/uploadCategories".$data->picture;
        if(file_exists($destination))
        {
            File::delete($destination);
            DB::table('categories')
                ->where('id',$id)
                ->delete();
            return response()->json([
                'status' => 'true',
                'messages' => 'Data Delete successful'
            ]);

        }
        else{
            return response()->json([
                'status' => 'false',
                'messages' =>'Data Not Delete'
            ]);
        }
    }
    public function update(String $id)
    {
        $single_data = DB::table('categories')
                            ->where('id',$id)
                            ->get();
        return view('admin/updateCategories',['data'=>$single_data]);
    }
    public function store(Request $request)
    {   
        $id = $request->cate_id;
        $file_name = null;
        if($request->hasfile('picture'))
            {
                $data = categories::find($id);
                $destination = "assets/uploadCategories/".$data->picture;
                if(File::exists($destination))
                {
                    File::delete($destination);
                };
                $file = $request->file('picture');
                $path = public_path('assets/uploadCategories');
                $file_name = time().$file->getClientOriginalName();
                $file->move($path,$file_name);
                DB::table('categories')
                ->where('id',$request->cate_id)
                ->update([
                    'picture'=>$file_name
                ]);
            }
        $store = DB::table('categories')
                        ->where('id',$request->cate_id)
                        ->update([
                            'name'=>$request->name,
                            'slug'=>$request->slug,
                            'status'=>$request->status,
                            'updated_at'=>now()
                        ]);
            if($store)
            {
                echo "<script>alert('Updated successful');window.location.href='/admin/categories';</script>";
            }
    }
}
