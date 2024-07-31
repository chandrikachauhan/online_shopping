@extends('layout.master_layout')
@section('contents')
<div class="card mb-4">
    <div class="card-header">
        <button type="button" class=" btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <span class="fas fa-pen"></span> Add Categories</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>slug</th>
                        <th>status</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>slug</th>
                        <th>status</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach($categories as $key => $item)
                    <tr>
                        <td><img src="{{url('assets/uploadCategories/',$item->picture)}}" height="50px" width="50px"></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->slug}}</td>
                        <td>
                                @if($item->status=="1")
                                    <span class="fas fa-check text-primary"></span>
                                @endif
                                @if($item->status=="0")
                                    <span class="fas fa-ban text-primary"></span>
                                @endif

                        </td>
                        <td><a href="/categories/update/{{$item->id}}"><span class="fa fa-pen text-success"></span></a></td>
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

<!--Model code of add cotegories--->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class=" text-center">Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="categoriesData" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
        <span id="alert"></span>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Name</label>
                <input type="text" id="name" placeholder="ENTER PRODUCT NAME" name="name" class="form-control">
                <p></p>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">slug:</label>
                <input type="text" class="form-control" id="slug" placeholder="ENTER SLUG HERE..." name="slug">
                <p></p>
            </div>
            <div class="form-group">
            <label for="message-text" class="col-form-label">Status:</label>
                <select class="form-control" name="status">
                    <option selected>---select---</option>
                    <option value="1"> active</option>
                    <option value="0"> block</option>
                </select>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Picture</label>
                <input type="file" id="picture" name="picture" class="form-control">
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
        $("#categoriesData").on('submit',function(events){
            events.preventDefault();
            var category = new FormData(this);
            $.ajax({
                url:"{{route('categories.create')}}",
                type:"post",
                data:category,
                contentType:false,
                processData:false,
                datatype:"json",
                success:function(response){
                   if(response.status =="true"){
                        $("#alert").addClass('alert alert-success')
                        .html(response.messages);
                        window.location.href="{{route('categories')}}";
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
                        if(messages["picture"])
                        {
                            $("#picture").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(messages['picture']);
                        }
                        else{
                            $("#picture").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('');
                        }
                   }
                }
            })
        })
        $(".delete").on('click',function(){
            var delete_id = $(this).attr("data-id");
            $.ajax({
                url:"/admin/categories/delete/"+delete_id,
                type:'get',
                success:function(response){
                    alert(response.messages);
                    window.location.href="{{route('categories')}}";
                }
            })
        });
    })
</script>
@endsection