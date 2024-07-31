<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\facades\validator;
use Illuminate\support\facades\DB;
use Illuminate\support\facades\File;
use App\Models\categories;
use App\Models\subcategories;
use App\Models\brands;
use App\Models\product;
use App\Models\productImage;

class productController extends Controller
{
    public function index()
    {
        $product = product::select('products.*','image as imageName')
        ->leftJoin('product_images','products.id','product_images.product_id')
        ->get();
        // dd($product);
        return view('admin/allProduct',compact('product'));
    }
    public function create()
    {
        $categories['cate_data'] = categories::orderBy('name','ASC')->get();
        $categories['brand'] = brands::orderBy('name','ASC')->get();
        return view('admin/product',$categories);
    }
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'brand_id' => 'required',
            'sku' => 'required',
            'qty' => 'required',
            'images' => 'required|mimes:jpg,jpeg,png,pdf|max:1024',
            'status' => 'required'
        ]);
        if($validator->passes())
        {   
            $product = new product;
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->campare_price = $request->campare_price;
            $product->moreInformation = $request->moreInformation;
            $product->spacification = $request->spacification;
            $product->related = $request->related;
            $product->categories_id = $request->categories_id;
            $product->subcategories_id = $request->sub_categories_id;
            $product->brand_id = $request->brand_id;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->save();
                if(!empty($product))
                {
                    if($request->hasfile('images'))
                    {
                        $image =new productImage();
                        $file = $request->file('images');
                        $file_name = time().'-'.$file->getClientOriginalName();
                        $path = public_path('assets/productImage');
                        $file->move($path, $file_name);
                        $image->product_id = $product->id;
                        $image->image = $file_name;
                        $image->save();
                }
                return response()->json([
                    'status'=>true,
                    'messages'=>"Product Created successful"
                ]);   
            }
            else{
                return response()->json([
                    'status'=>false,
                    'messages'=>"Product Not Created successful"
                ]);
            }
        }
        else{
            return response()->json([
                'status' => false,
                'messages' =>$validator->messages()
            ]);
        }

    }
    public function delete(string $id)
    {
        $product = product::find($id);
        $product->delete();
        $images = productImage::find($id);
            $destination = "assets/productImage/".$images->image;
            if(File::exists($destination))
            {
                File::delete($destination);
                $pimages = productImage::find($images->id);
                $pimages->delete();
                return response()->json([
                    'status' =>true,
                    'messages'=>'Product Delete successful'
                ]);
            }
            else{
                return response()->json([
                    'status'=>false,
                    'messages'=>'Data not delete successful'
                ]);
            }
    }
    public function update(string $id)
    {
        $categories['product'] = product::find($id);
        $categories['cate_data'] = categories::orderBy('name','ASC')->get();
        $categories['brand'] = brands::orderBy('name','ASC')->get();
        return view('admin/product',$categories);
    }
    public function finalUpdate(Request $request)
    {
        if($request->hasfile('images'))
        {
            $images = productImage::find($request->update_id);
            $image = productImage::find($images->id);
            $destination = "assets/productImage/".$image->image;
            if(file_exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('images');
            $file_name = time().'-'.$file->getClientOriginalName();
            $path = public_path('assets/productImage');
            $file->move($path, $file_name);
            $image->product_id = $request->update_id;
            $image->image = $file_name;
            $image->save();
        }
        if(empty($request->sub_categories_id))
        {   
            $product = product::find($request->update_id);
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->campare_price = $request->campare_price;
            $product->moreInformation = $request->moreInformation;
            $product->spacification = $request->spacification;
            $product->related = $request->related;
            $product->categories_id = $request->categories_id;
            $product->brand_id = $request->brand_id;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->save();
                if(!empty($product))
                {
                    echo "<script>alert('Product Created successful');window.location.href='/product';</script>";   
                }
            else{
                echo "<script>alert('Product Not Created successful');window.location.href='/product';</script>";                    
            }
        }
        else
        {   
            $product = product::find($request->update_id);
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->campare_price = $request->campare_price;
            $product->categories_id = $request->categories_id;
            $product->subcategories_id = $request->sub_categories_id;
            $product->brand_id = $request->brand_id;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->save();
                if(!empty($product))
                {
                    echo "<script>alert('Product Created successful');window.location.href='/product';</script>";   
                }
            else{
                echo "<script>alert('Product Not Created successful');window.location.href='/product';</script>";
            }
        }
    }
}
