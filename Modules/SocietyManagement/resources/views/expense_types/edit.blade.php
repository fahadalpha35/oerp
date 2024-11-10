@extends('backend.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('society_expense_type_list')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <h3 class="mt-2 text-center">Edit Expense Type</h3>
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
                        <form action="{{route('update_society_expense_type',$society_expense ->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf       
                            <div class="row">        
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Expense Type Name <small style="color: red">*</small></label>
                                        <input type="text" placeholder="Expense Type Name" required id="type_name" name="type_name" value="{{$society_expense->type_name}}" class="form-control form-control-lg" />
                                    </div>
                                </div>
            
            
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Active Status <small style="color: red">*</small></label>
                                        <select  class="form-control select2" id="active_status" name="active_status" style="width: 100%;">
                                            <option value="{{$society_expense->active_status}}">
                                                @if($society_expense->active_status == 1)
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
