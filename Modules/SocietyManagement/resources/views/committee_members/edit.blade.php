@extends('backend.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('committee_members.index')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <br>
                    <h3 class="mt-2 text-center">Edit Committee Member</h3>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h5>Member Name : {{$committee_member->member_name}}</h5>
                            <h5>Member ID : {{$committee_member->member_unique_id}}</h5>
                            <br>
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
                                 
                    <form action="{{route('committee_members.update',$committee_member->id)}}" method="POST">
                        @csrf
                        @method('PUT')            
                        <div class="row">        
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Committee Name <small style="color: red">*</small></label>
                                    <select required class="form-control select2" id="committee_id" name="committee_id" style="width: 100%;">
                                     <option value="{{$committee_member->committee_id}}">{{$committee_member->committee_name}}</option>
                                     @foreach($committees as $committee)
                                      <option value="{{$committee->id}}">{{$committee->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>
        
        
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Designation <small style="color: red">*</small></label>
                                    <input type="text" required  id="committee_member_designation" name="committee_member_designation" value="{{$committee_member->committee_member_designation}}" class="form-control form-control-lg" />
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
