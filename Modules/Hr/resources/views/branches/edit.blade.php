@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('branches.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Edit Branch</h3>
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
                          <form action="{{route('branches.update',$branch->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                          <div class="row">
                              <div class="col-md-12 col-sm-12">
                                  <div  class="form-group mb-4">
                                      <label>Branch Name <small style="color: red">*</small></label>
                                      <input type="text" required placeholder="Branch Name" id="br_name" name="br_name" value="{{$branch->br_name}}" class="form-control form-control-lg" />
                                  </div>
                              </div>

                              <div class="col-md-12 col-sm-12">
                              <div  class="form-group mb-4">
                                  <label>Branch Address <small style="color: red">*</small></label>
                                  <textarea name="br_address" required id="br_address"  class="form-control form-control-lg summernote">{{$branch->br_address}}</textarea>
                              </div>
                              </div>

                              <div class="col-md-12 col-sm-12">
                              <div  class="form-group mb-4">
                                  <label for="password">Branch Type <small style="color: red">*</small></label>
                                  <select class="form-control select2" required id="br_type" name="br_type" style="width: 100%;">
                                    <option selected value="{{$branch->br_type}}">
                                        @if(($branch->br_type)==1)
                                        Head Office
                                        @else
                                        Single Branch
                                        @endif
                                    </option>
                                      <option value="1">Head Office</option>
                                      <option value="2">Single Branch</option>
                                  </select>
                              </div>
                              </div>

                              <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Branch Status <small style="color: red">*</small></label>
                                    <select required class="form-control select2" id="br_status" name="br_status" style="width: 100%;">
                                        <option selected value="{{$branch->br_status}}">
                                            @if(($branch->br_status) == 1)
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
@endsection


@push('masterScripts')
<script>
$.noConflict(); // Ensures jQuery does not conflict with other libraries
jQuery(document).ready(function($) {
    $('.select2').select2();
})
</script>
@endpush
