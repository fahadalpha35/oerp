@extends('backend.layout.layout')
@section('content') 
<div class="main-panel">
    <div class="content-wrapper">
      
         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('departments.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>         
              <div class="col-12">
                <h3 class="mt-2 text-center">Edit Department</h3>
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
                          <form action="{{route('departments.update',$dept->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                          <div class="row">       
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Department Name <small style="color: red">*</small></label>
                                    <input type="text" required  id="dept_name"  value="{{$dept->dept_name}}" name="dept_name" class="form-control form-control-lg" />
                                </div> 
                            </div>  
                  
                              <div class="col-md-12 col-sm-12">
                              <div  class="form-group mb-4">
                                  <label for="password">Branch <small style="color: red">*</small></label>
                                  <select class="form-control select2" required id="branch_id" name="branch_id" style="width: 100%;">
                                    <option selected value="{{$dept->branch_id}}">{{$dept->branch_name}}</option>
                                    @foreach($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->br_name}}</option>
                                    @endforeach
                                  </select>
                              </div>  
                              </div>
   
                              <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Status <small style="color: red">*</small></label>
                                    <select required class="form-control select2" id="dept_status" name="dept_status" style="width: 100%;">
                                        <option selected value="{{$dept->dept_status}}">
                                            @if(($dept->dept_status) == 1)
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
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                          </form>  
                      </div>
                      <!-- /.card-body -->
                    </div>
              </div>           
          </div>      
          <br>      
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

    </div>
    @include('backend.layout.footer')
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