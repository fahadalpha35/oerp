@extends('backend.layout.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('leave_types.index')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="col-12">
              <h3 class="mt-2 text-center">Edit Leave Type</h3>
                <br>
                <div class="card">
                    {{-- <div class="card-header">
                        <h3 class="card-title">Add Branch</h3>
                      </div> --}}
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
                       <form action="{{route('leave_types.update',$leave_type->id)}}" method="POST" >
                          @csrf
                          @method('PUT')
                          <div class="row">
                          
                              <div class="col-md-12 col-sm-12">
                              <div  class="form-group mb-4">
                                <label>Type Name <small style="color: red">*</small></label>
                                <input type="text" required id="type_name" value="{{$leave_type->type_name}}" name="type_name" class="form-control" />
                              </div>
                              </div>
                            </div>

                          <input type="hidden" value="{{$leave_type->id}}" name="id" id="leave_type_id">
                          <button type="submit" id="sub" class="btn btn-info float-right mr-4">Update</button>
                        </form>
                    </div>
                  </div>
            </div>
        </div>      
        <br>
         
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
@endsection