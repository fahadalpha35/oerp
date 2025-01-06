@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('society_member_loans.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Member Loan</h3>
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
                            <form action="{{route('society_member_loans.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                      <label>Member <small style="color: red">*</small></label>
                                        <select  class="form-control select2" id="member_id" name="member_id" style="width: 100%;">
                                            <option value="">Select Member</option>
                                            @foreach($members as $member)
                                            <option value="{{$member->id}}">{{$member->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                    <label for="loan_start_date" class="form-label">Loan Start Date <small style="color: red">*</small></label>
                                    <input type="date" name="loan_start_date" id="loan_start_date" value="{{old('loan_start_date')}}" class="form-control form-control-lg" required>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                    <label for="loan_amount" class="form-label">Loan Amount <small style="color: red">*</small></label>
                                    <input type="number" name="loan_amount" id="loan_amount" value="{{old('loan_amount')}}" class="form-control form-control-lg" required>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">    
                                    <label for="interest_rate" class="form-label">Interest Rate (%) <small style="color: red">*</small></label>
                                    <input type="number" step="0.01" name="interest_rate" id="interest_rate" class="form-control form-control-lg" value="{{old('interest_rate')}}" required>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label for="repayment_term" class="form-label">Repayment Term (Months) <small style="color: red">*</small></label>
                                        <input type="number" name="repayment_term" id="repayment_term" class="form-control form-control-lg" value="{{old('repayment_term')}}" required>
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
