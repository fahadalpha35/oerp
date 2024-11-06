@extends('backend.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('society_committees.index')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <h3 class="mt-2 text-center">Edit Committee Details</h3>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            @if(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> {{ Session::get('error_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success: </strong> {{ Session::get('success_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <br>
                        <form action="{{route('society_committees.update',$committee ->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')            
                            <div class="row">        
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Committee Name <small style="color: red">*</small></label>
                                        <input type="text" placeholder="Committee Name" required id="name" name="name" value="{{$committee->name}}" class="form-control form-control-lg" />
                                    </div>
                                </div>
            
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Description</label>
                                        <textarea name="description" id="description" class="form-control">{{$committee->description}}</textarea>
                                    </div>
                                </div>
            
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Starting Date <small style="color: red">*</small></label>
                                        <input type="date" required  id="start_date" name="start_date" value="{{$committee->start_date}}" class="form-control form-control-lg" />
                                    </div>
                                </div>
            
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Expiration Date </label>
                                        <input type="date"  id="end_date" name="end_date" value="{{$committee->end_date}}" class="form-control form-control-lg" />
                                    </div>
                                </div>
            
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Active Status <small style="color: red">*</small></label>
                                        <select  class="form-control select2" id="active_status" name="active_status" style="width: 100%;">
                                            <option value="{{$committee->active_status}}">
                                                @if($committee->active_status == 1)
                                                Active
                                                @else
                                                Inactive
                                                @endif
                                            </option>
                                          <option value="1">Active</option>
                                          <option value="2">Inactive</option>
                                      </select>
                                      </div>
                                </div>           
                              </div>            
                            <button type="submit" class="btn btn-primary float-right">Update</button><br><br><br>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('masterScripts')
<script>
$.noConflict(); // Ensures jQuery does not conflict with other libraries
jQuery(document).ready(function($) {
    $('.select2').select2();
})
</script>
@endpush
