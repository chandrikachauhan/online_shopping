@extends('layout/master_layout');
@section('contents');
<div class="container mb-4 pt-0">
    <div class="card shadow-lg border-0 rounded-lg ">
        <div class="card-header">
            <a href="{{route('all.product')}}" class="close"  data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
                <h3 class="text-center font-weight-light my-2">
                    @isset($product) 
                        Update Products
                    @endisset
                    @empty($product)
                        Create Products
                    @endempty
                   
                </h3>
        </div>
        <div class="card-body">
            @isset($product)
            <form action="/product/finalUpdate" method="post" enctype="multipart/form-data">
            @endisset
            @empty($product)
                <div id="alert"></div>
                <form id="productData" method="post" enctype="multipart/form-data">
            @endempty
                @csrf
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputFirstName">Title</label>
                            @isset($product)
                                <input type="hidden" name="update_id" value="{{$product->id}}">
                            @endisset
                            <input class="form-control" value="@if(isset($product)){{$product->title}}@endif" name="title" id="title" type="text" placeholder="Enter Title Here"/>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputLastName">Slug</label>
                            <input class="form-control" value="@if(isset($product)){{$product->slug}}@endif" name="slug" id="slug" type="text" placeholder="Enter Slug " />
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="small mb-1" for="inputEmailAddress">Description</label>
                    <input class="form-control" value="@isset($product){{$product->description}}@endisset" name="description" id="description" type="text" aria-describedby="emailHelp" placeholder="Enter description" />
                    <p></p>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">Price</label>
                            <input class="form-control" value="@if(isset($product)){{$product->price}}@endif" name="price" id="price" type="number" placeholder="Enter price" />
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputConfirmPassword">Campare Price (option)</label>
                            <input class="form-control" value="@if(isset($product)){{$product->campare_price}}@endif" name="campare_price" id="compare_price" type="number" placeholder="Enter Compare Price" />
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">More information</label>
                            <input class="form-control" value="@if(isset($product)){{$product->moreInformation}}@endif" name="moreInformation" id="moreInformation" type="text" placeholder="Enter Information" />
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputConfirmPassword">Spacification</label>
                            <input class="form-control" value="@if(isset($product)){{$product->spacification}}@endif" name="spacification" id="spacification" type="text" placeholder="Enter spacification" />
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputConfirmPassword">Related Product</label>
                            <input class="form-control" value="@if(isset($product)){{$product->related}}@endif" name="related" id="related" type="text" placeholder="Enter related product" />
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">categories</label> 
                            <select name="categories_id" id="category" class="form-control">
                                @if(!empty($cate_data))
                                    @isset($product)
                                        @foreach($cate_data as $cate)
                                            @if($product->categories_id == $cate->id)
                                                <option value="{{$cate->id}}" selected>{{$cate->name}}</option>
                                                @else
                                                <option  value="{{$cate->id}}">{{$cate->name}}</option>
                                            @endif
                                        @endforeach
                                    @endisset
                                    @empty($product)
                                        <option value="">---- Select Categories ----</option>
                                        @foreach($cate_data as $cate)
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    @endempty
                                @endif
                            </select>                       
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputConfirmPassword">Sub Categories</label>
                            <select name="sub_categories_id" id="subcate_data" class="form-control">
                                <option value="">---- Select Subcaategories ----</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">Brand</label>
                            <select name="brand_id" id="brand" class="form-control">
                            <option>------ select brand -----</option>
                                @if(!empty($brand))
                                        @isset($product)
                                            @foreach($brand as $item)
                                                @if($product->brand_id == $item->id)
                                                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                                                    @else
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endif                                            @endforeach
                                        @endisset
                                        @empty($product)
                                            @foreach($brand as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endempty
                                @endif
                            </select>                        
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputConfirmPassword">Featured Product (option)</label>
                            <select name="is_featured" id="is_featured" class="form-control">
                            <option>------ select Featured -----</option>
                                @isset($product)
                                    @if($product->is_featured =="Yes")
                                        <option selected value="Yes">yes</option>
                                        <option value="No">No</option>
                                        @elseif($product->is_featured =="No")
                                        <option value="Yes">yes</option>
                                        <option selected value="No">No</option>
                                    @endif
                                @endisset
                                @empty($product)
                                    <option value="Yes">yes</option>
                                    <option value="No">No</option>
                                @endempty
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">SKU</label>
                            <input class="form-control" value="@if(isset($product)){{$product->sku}}@endif" name="sku" id="sku" type="text" placeholder="Enter Sku" />
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputConfirmPassword">BarCode (option)</label>
                            <input class="form-control" value="@if(isset($product)){{$product->barcode}}@endif" name="barcode" id="barcode" type="string" placeholder="Enter Barcode" />
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">Track Quantity (option)</label>
                            <select name="track_qty" id="track_qty" class="form-control">
                            <option>------ Track Quantity -----</option>
                            @isset($product)
                                    @if($product->track_qty =="Yes")
                                        <option selected value="Yes">yes</option>
                                        <option value="No">No</option>
                                        @elseif($product->track_qty =="No")
                                        <option value="Yes">yes</option>
                                        <option selected value="No">No</option>
                                    @endif
                                @endisset
                                @empty($product)
                                    <option value="Yes">yes</option>
                                    <option value="No">No</option>
                                @endempty
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputConfirmPassword">Quantity</label>
                            <input class="form-control" value="@if(isset($product)){{$product->qty}}@endif" name="qty" id="qty" type="number" placeholder="Enter Quantity" />
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">Select Products</label>
                            <input type="file" id="image" name="images" class="form-control" id="image">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">Status</label>
                            <select name="status" id="status" class="form-control">
                            <option>------ select status -----</option>

                                @isset($product)
                                    @if($product->status == 1)
                                        <option selected value="1">Active</option>
                                        <option value="0">Black</option>
                                        @elseif($product->status == 0)
                                        <option value="1">Active</option>
                                        <option selected value="0">Block</option>
                                    @endif
                                @endisset
                                @empty($product)
                                    <option value="1">Active</option>
                                    <option value="0">Black</option>
                                @endempty
                            </select>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        @isset($product)
                            <input type="submit" name="submit" value="Update" class="btn btn-primary col-md-12">
                        @endisset
                        @empty($product)
                            <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary col-md-12">
                        @endempty
                    </div>
                    <div class=" col-md-6">
                        <a href="{{route('all.product')}}">
                            <button type="button" class="btn btn-secondary col-md-12" data-dismiss="modal">Close</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <div class="small"><a href="login.html">Have an account? Go to login</a></div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("#productData").submit(function(events){
            events.preventDefault();
            var form_data = new FormData(this);
                $.ajax({
                    url:'/product/store',
                    type:'POST',
                    data : form_data,
                    contentType:false,
                    processData:false,
                    dataType:'json',
                    success:function(response){
                        if(response['status'] == true){
                            alert(response.messages);
                            window.location.href="{{route('all.product')}}";
                        }
                        else{
                            var errors = response['messages'];
                            if(errors['title']){
                                $("#title").addClass('is-invalid')
                                .siblings('p').addClass('invalid-feedback').html(errors['title']);
                            }
                            else{
                                $("#title").removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback').html();
                            }
                            if(errors['description']){
                                $("#description").addClass('is-invalid')
                                .siblings('p').addClass('invalid-feedback').html(errors['description']);
                            }
                            else{
                                $("#description").removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback').html();
                            }
                            if(errors['price']){
                                $("#price").addClass('is-invalid')
                                .siblings('p').addClass('invalid-feedback').html(errors['price']);
                            }
                            else{
                                $("#price").removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback').html();
                            }
                            if(errors['sku']){
                                $("#sku").addClass('is-invalid')
                                .siblings('p').addClass('invalid-feedback').html(errors['sku']);
                            }
                            else{
                                $("#sku").removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback').html();
                            }
                            if(errors['qty']){
                                $("#qty").addClass('is-invalid')
                                .siblings('p').addClass('invalid-feedback').html(errors['qty']);
                            }
                            else{
                                $("#qty").removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback').html();
                            }
                            if(errors['images']){
                                $("#image").addClass('is-invalid')
                                .siblings('p').addClass('invalid-feedback').html(errors['images']);
                            }
                            else{
                                $("#image").removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback').html();
                            }
                        }
                    }
                })
        });
        $("#category").change(function(){
            var id = $(this).val();
            $.ajax({
                url:'/productsubcate',
                type:'get',
                data:{'cate_id':id},
                datatype:'json',
                success:function(response)
                {
                    subcate = response['psubcategories'];
                    $.each(subcate,function(key,value){
                        $("#subcate_data").append(
                            "<option value='"+value.id+"'>"+value.name+"</option>"
                        );
                    })
                }
            })
        });
        $("#title").on('keyup',function(){
            var title = $("#title").val();
            $("#slug").val(title);
        });
    });
</script>
@endsection