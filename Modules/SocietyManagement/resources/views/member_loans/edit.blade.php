@extends('backend.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('society_member_loans.index')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <br>
                    <h3 class="mt-2 text-center">Edit Loan Details</h3>
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
                                 
                    <form action="{{route('society_member_loans.update',$loan->id)}}" method="POST">
                        @csrf
                        @method('PUT')            
                        <div class="row">
                           
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                  <label>Member <small style="color: red">*</small></label>
                                    <select  class="form-control select2" id="member_id" name="member_id" style="width: 100%;">
                                        @foreach($members as $member)
                                        <option value="{{ $member->id }}" {{ $member->id == $loan->member_id ? 'selected' : '' }}>{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label for="loan_start_date" class="form-label">Loan Start Date <small style="color: red">*</small></label>
                                    <input type="date" name="loan_start_date" id="loan_start_date" value="{{$loan->loan_start_date}}" class="form-control form-control-lg" required>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label for="loan_amount" class="form-label">Loan Amount <small style="color: red">*</small></label>
                                    <input type="number" name="loan_amount" id="loan_amount" value="{{$loan->loan_amount}}" class="form-control form-control-lg" required>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label for="interest_rate" class="form-label">Interest Rate (%) <small style="color: red">*</small></label>
                                    <input type="number" step="0.01" name="interest_rate" id="interest_rate" class="form-control form-control-lg" value="{{$loan->interest_rate}}" required>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label for="repayment_term" class="form-label">Repayment Term (Months) <small style="color: red">*</small></label>
                                    <input type="number" name="repayment_term" id="repayment_term" class="form-control form-control-lg" value="{{$loan->repayment_term}}" required>
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
