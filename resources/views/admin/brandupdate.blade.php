@extends('layout/master_layout')
@section('contents')
<div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg  mb-4">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Brand Update</h3></div>
                                    <div class="card-body">
                                        <form action="/brand/store" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="cate_id" value="{{$single_data->id}}">
                                                        <label class="small mb-1" for="inputFirstName">Name</label>
                                                        <input name="name" value="{{$single_data->name}}" class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">slug</label>
                                                        <input name="slug" value="{{$single_data->slug}}" class="form-control py-4" id="inputLastName" type="text" placeholder="Enter description" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Update">
                                            </div>
                                          
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.html">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
