@extends('layout.master_layout')
@section('contents')
<div class="card mb-4">
    <div class="card-header">
        <button type="button" class=" btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <span class="fas fa-pen"></span> Add brand</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>slug</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>slug</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach($brand as $key => $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->slug}}</td>
                        <td><a href="/brand/update/{{$item->id}}"><span class="fa fa-pen text-success"></span></a></td>
                        <td>
                            <button data-id="{{$item->id}}" class="branddelete">
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

<!--Model code of add cotegories--->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class=" text-center">Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="brandData" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
        <span id="alert"></span>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Name</label>
                <input type="text" id="name" placeholder="ENTER BRAND NAME" name="name" class="form-control">
                <p></p>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">slug:</label>
                <input type="text" class="form-control" id="slug" placeholder="ENTER SLUG HERE..." name="slug">
                <p></p>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("#brandData").on('submit',function(events){
            events.preventDefault();
            var category = new FormData(this);
            $.ajax({
                url:"{{route('brand.create')}}",
                type:"post",
                data:category,
                contentType:false,
                processData:false,
                datatype:"json",
                success:function(response){
                   if(response.status =="true"){
                        $("#alert").addClass('alert alert-success')
                        .html(response.messages);
                        window.location.href="{{route('brand')}}";
                   }
                   else{
                        var messages = response['messages'];
                        if(messages["name"])
                        {
                            $("#name").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(messages['name']);
                        }
                        else{
                            $("#name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('');
                        }
                        if(messages["slug"])
                        {
                            $("#slug").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(messages['slug']);
                        }
                        else{
                            $("#slug").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('');
                        }
                   }
                }
            })
        });
        $(".branddelete").on('click',function(){
            var delete_id = $(this).attr("data-id");
            $.ajax({
                url:"/brand/delete/"+delete_id,
                type:'get',
                success:function(response){  
                    alert(response.messages);
                    window.location.href="{{route('brand')}}";
                }
            });
        });
    });
</script>
@endsection