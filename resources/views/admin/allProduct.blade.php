@extends('layout/master_layout');
@section('contents');
<div class="card mb-4">
    <div class="card-header">
       <a href="{{route('product.create')}}" class="btn btn-primary">
            <span class="fas fa-pen"></span> Add Products</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Image</th>
                        <th>product</th>
                        <th>price</th>
                        <th>Qty</th>
                        <th>SKU</th>
                        <th>status</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sr. No</th>
                        <th>Image</th>
                        <th>product</th>
                        <th>price</th>
                        <th>Qty</th>
                        <th>SKU</th>
                        <th>status</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($product as $key => $item)

                    <tr>
                        <td>{{$key}}</td>
                        <td>
                            @if(!empty($item->imageName))
                            <img src="{{url('assets/productImage/',$item->imageName)}}" height="50px" width="50px">
                            @endif
                            
                        </td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->sku}}</td>
                        <td>
                                @if($item->status =="1")
                                    <span class="fas fa-check text-primary"></span>
                                @endif
                                @if($item->status =="0")
                                    <span class="fas fa-ban text-primary"></span>
                                @endif

                        </td>
                        <td>
                            <a href="/product/update/{{$item->id}}">
                                <span class="fa fa-pen text-success"></span>
                            </a>
                        </td>
                        <td>
                            <button data-id="{{$item->id}}" class="delete">
                                <span class="fa fa-trash text-danger"></span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection;
@section('scripts')
<script>
    $(document).ready(function(){
        $(".delete").on('click',function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url:'/product/delete/'+id,
                dataType:'json',
                success:function(response){
                    alert(response.messages);
                    window.location.href="{{route('all.product')}}";
                }
            })
        })
    })
</script>
@endsection;