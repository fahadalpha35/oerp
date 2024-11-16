@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('society_expense_type_list')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Expense Type</h3>
                  <br>
                  <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{route('store_society_expense_type')}}" method="POST">
                                @csrf
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Type Name <small style="color: red">*</small></label>
                                        <input type="text" placeholder="Expense Type Name" required id="type_name" name="type_name" value="{{old('type_name')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                               

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Active Status <small style="color: red">*</small></label>
                                        <select  class="form-control select2" id="active_status" name="active_status" style="width: 100%;">
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
