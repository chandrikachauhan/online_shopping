@extends('layout/front_master_layout')
@section('contents')
<style>
   
    .menu{
        min-width: 100%;
        background-color:#f8f8f8;
        margin: 10px;
        text-align:center;
        box-shadow:0px 2px 3px black;
        padding-bottom:15px;
        border:none;

    }
    .content{
        min-width:100%;
        background-color:#f8f8f8;
    }
    .headers{
        height:80px;
    }
    .card{
        margin-top:20px;
        text-align:center;
        background-color:#f8f8f8;
    }
    .select{
        top:15px;
        overflow:hidden;
        position:relative;
    }
    .header-menu{
        min-height:60px;
        background-color:#816263;
        color:white;
        font-family:'Lato-Regular';
    }
    ul{
        list-style:none;
    }
    .dropdowns{
        cursor:pointer;
        display:black;
        font-size:18px;
        position:relative;
        transition:all ease 0.5;
        margin-top:10px;
        border-radius:5px;
        min-height:40px;
        line-height:40px;
    }
	.dropdowns a:hover{
		text-decoration:none;
		color:white;
	}
    .dropdowns:hover{
        background-color:#816263;
        color:white;
    }
    .dropdowns i{
        position:absolute;
        top:12px;
        right:10px;
		font-size:10px;
    }
   .submenuItems{
    display:none;
   }
   .accordion-menu li.active .submenuItems{
    display:block;
   }
   .submenuItems li{
    min-height:30px;
   }
   .submenuItems li:hover{
	border:1px solid #816263;
	border-radius:5px;
   }
   .submenuItems a{
    display:block;
    color:black;
    transition:all 0.2s ease-out;
    padding:6px 6px 6px 20px;
    text-decoration:none;
   }
</style>
    <div class="col-sm-12 container">
        <div class="col-sm-3">
            <div class="col-sm-12 headers"></div>
            <div class="col-sm-12 menu">
                    <div class="row">
                        <div class="header-menu">
                            <h3>Our Products</h3>
                        </div>
                    </div>
                    <ul class="accordion-menu">
						@if($categories->isNotEmpty())
						@foreach($categories as $category)
                        <li class="link">
                            <div class="dropdowns">
								<a href="{{route('shop.index',$category->slug)}}">
                                {{$category->name}}
                                <i class="glyphicon glyphicon-chevron-down"></i>
								</a>
                            </div>
							@if($category->sub_category->isNotEmpty())
							@foreach($category->sub_category as $subcategory)
                            <ul class="submenuItems">
                                <li><a href="{{route('shop.index',[$category->slug,$subcategory->slug])}}">{{$subcategory->name}}</a></li>
                            </ul>
							@endforeach
							@endif
                        </li>
                       @endforeach
					   @endif
                    </ul>
            </div>
            <div class="col-sm-12 menu">
				<div class="row">
                    <div class="header-menu">
                        <h3>Brand</h3>
                    </div>
				</div>
				<div class="col-sm-12">
					<table cellpadding="10px" cellspacing="20px" style="text-align:center;">
						@if($brand->isNotEmpty())
						@foreach($brand as $brands)
						<tr>
							<td><input {{ (in_array($brands->id ,$brandSelected)) ? 'checked' : '' }} type="checkbox" class="checked" name="brand" value="{{ $brands->id}}"></td>
							<td> {{$brands->name}}</td>
						</tr>
                        @endforeach
						@endif
					</table>
				</div>
            </div>
            <div class="col-sm-12 headers"></div>
        </div>
        <div class="col-sm-9">
        <div class="col-sm-12 headers">
            <div class="col-sm-5"></div>
            <div class="col-sm-5">
            </div>
            <div class="col-sm-2 select">
                <select name="">
                    <option value="">SORT BY</option>
                    <option value="">Name</option>
                    <option value="">Price</option>
                </select>
            </div>
        </div>
            <div class="col-sm-12">
                @foreach($product as $key =>$product)
                @foreach($product->product_image as $images)
                    <div class="col-sm-4 card">
                        <div class="row">
                            <a href="{{route('shop.product',$product->slug)}}" title="View Click">
                            <div class="col-sm-12">
                                <img src="{{url('assets/productImage/'.$images->image)}}" alt="" height="300px" class="img-responsive">
                            </div>
                            </a>
                            <div class="col-sm-12">
								<div class="col-sm-6">
									<div class="row">
										<h4>{{$product->title}}</h4>
									</div>
								</div>
								<div class="col-sm-6">
								<div class="row">
										<h4>${{$product->price}}</h4>
									</div>
								</div>
                                    
                            </div>
                            <div class="col-sm-12">
                                    <p style="font-family:monotype-corsiva;">{{$product->description}}</p>
                            </div>
                            <div class="col-sm-12">
							<a class="cbp-vm-icon cbp-vm-add item_add" href="#">Add to cart</a>
                            </div>
                        </div>
                        </div>
                    @endforeach
                    @endforeach
            </div>

            <div class="col-sm-12 headers"></div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    var listElements = document.querySelectorAll('.link');
    listElements.forEach(listElement =>{
        listElement.addEventListener('click',() => {
            if(listElement.classList.contains('active')){
                listElement.classList.remove('active');
            }
            else{
                listElements.forEach(listE => {
                    listE.classList.remove('active');
                })
                listElement.classList.toggle('active');
            }
        })
    })
    $(".checked").change(function(){
        aply_filter();
    })
    function aply_filter(){
        var brand = [];
        $('.checked').each(function(){
            if($(this).is(':checked')==true)
        {
            brand.push($(this).val());
        }
        })
        // console.log(brand.toString());
        var url = '{{url()->current() }}?';
        window.location.href = url+'&brand='+brand.toString();
    }
</script>
@endsection