@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('designations.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Edit Designation</h3>
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
                         <form action="{{route('designations.update',$designation->id)}}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Level <small style="color: red">*</small></label>
                                        <select class="form-control select2" required id="level" name="level" style="width: 100%;">
                                            <option selected value="{{$designation->level}}">
                                                @if($designation->level == 1)
                                                Managing Level
                                                @elseif($designation->level == 2)
                                                Operational Level
                                                @else
                                                Support Level
                                                @endif
                                            </option>
                                            <option value="">Select Level</option>
                                            <option value="1">Managing Level</option>
                                            <option value="2">Operational Level</option>
                                            <option value="3">Support Level</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Designation <small style="color: red">*</small></label>
                                    <input type="text" class="form-control" required id="designation_name" name="designation_name" value="{{$designation->designation_name}}">
                                </div>
                                </div>
                              </div>

                            <input type="hidden" value="{{$designation->id}}" name="id" id="designation_id">
                            <button type="submit" id="sub" class="btn btn-info float-right mr-4">Update</button>
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
