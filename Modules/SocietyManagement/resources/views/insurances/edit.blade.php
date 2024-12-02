@extends('backend.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('society_insurances.index')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <br>
                    <h3 class="mt-2 text-center">Edit Insurance Details</h3>
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
                                 
                    <form action="{{route('society_insurances.update',$insurance->id)}}" method="POST">
                        @csrf
                        @method('PUT')            
                        <div class="row">
                           
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                  <label>Member <small style="color: red">*</small></label>
                                    <select  class="form-control select2" id="member_id" name="member_id" style="width: 100%;">
                                        @foreach($members as $member)
                                        <option value="{{ $member->id }}" {{ $member->id == $insurance->member_id ? 'selected' : '' }}>{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Policy Number <small style="color: red">*</small></label>
                                    <input type="text" required id="policy_number" name="policy_number" value="{{$insurance->policy_number}}" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Provider <small style="color: red">*</small></label>
                                    <input type="text" required id="provider" name="provider" value="{{$insurance->provider}}" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Start Date <small style="color: red">*</small></label>
                                    <input type="date" required id="start_date" name="start_date" value="{{$insurance->start_date}}" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>End Date </label>
                                    <input type="date" id="end_date" name="end_date" value="{{$insurance->end_date}}" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Insurance Amount (BDT) <small style="color: red">*</small></label>
                                    <input type="number" step="0.01" required id="premium_amount" name="premium_amount" value="{{$insurance->premium_amount}}" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12" id="description-container" style="display: none;">
                                <div  class="form-group mb-4">
                                    <label>Insurance Coverage Details</label>
                                    <textarea name="coverage_details" id="coverage_details" class="form-control">{{$insurance->coverage_details}}</textarea>
                                </div>
                            </div>
                                      
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Status <small style="color: red">*</small></label>
                                    <select  class="form-control select2" required id="status" name="status" style="width: 100%;">
                                     <option value="{{$insurance->status}}">
                                        @if($insurance->status == 1)
                                        Active
                                        @else
                                        Expired
                                        @endif
                                     </option>
                                      <option value="1">Active</option>
                                      <option value="2">Expired</option>
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
