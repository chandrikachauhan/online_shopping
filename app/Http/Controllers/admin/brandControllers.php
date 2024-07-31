<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\facades\validator;
use App\Models\brands;

class brandControllers extends Controller
{
    public function index()
    {
        $data['brand'] = brands::get();
        return view('admin/brand',$data);
    }
    public function create(Request $request)
    {
        $validation = validator::make($request->all(),
        [
            'name' => 'required',
            'slug' => 'required'
        ]);
        if($validation->passes())
        {
            $brand =new brands();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->created_at = now();
            $brand->save();
            return response()->json([
                'status'=>'true',
                'messages'=>'Brand add successful'
            ]);
        }
        else{
            return response()->json([
                'status' => 'false',
                'messages' => $validation->messages()
            ]);
        }
    }
    public function delete(string $id)
    {
        $brand = brands::find($id);
        $brand->delete();
        return response()->json([
            'status' => 'true',
            'messages' => 'Data Delete successful'
        ]);
    }
    public function update(string $id)
    {
        $brand['single_data'] = brands::find($id);
        return view('admin/brandupdate',$brand);
    }
    public function store(Request $request)
    {
        $update = brands::find($request->cate_id);
        $update->name = $request->name;
        $update->slug = $request->slug;
        $update->save();
        return redirect()->route('brand');
    }
}
