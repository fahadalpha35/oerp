@extends('backend.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('society_transaction_list')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <h3 class="mt-2 text-center">Edit Transaction Details</h3>
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
                        <form action="{{route('update_society_transaction',$society_transaction->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">        
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Account Name <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="account_id" name="account_id" style="width: 100%;">
                                            @foreach($account_types as $account_type)
                                            <option value="{{ $account_type->id }}" {{ $account_type->id == $society_transaction->account_id ? 'selected' : '' }}>{{ $account_type->account_name }}</option>
                                            @endforeach
                                       </select>
                                      </div>
                                </div> 
                                
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Transaction Date <small style="color: red">*</small></label>
                                        <input type="date" required  id="transaction_date" name="transaction_date" value="{{$society_transaction->transaction_date}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Transaction Name <small style="color: red">*</small></label>
                                        <input type="text" placeholder="Transaction Name" required id="transaction_name" name="transaction_name" value="{{$society_transaction->transaction_name}}" class="form-control form-control-lg" />
                                    </div>
                                </div>
                              
            
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Cost Less <small style="color: red">*</small></label>
                                        <select  class="form-control select2" required id="cost_less" name="cost_less" style="width: 100%;">
                                            <option value="{{$society_transaction->cost_less}}">
                                               @if($society_transaction->cost_less == 1)
                                               Yes
                                               @else
                                               No
                                               @endif
                                            </option>
                                             <option value="1">Yes</option>
                                             <option value="2">No</option>
                                         </select>
                                    </div>
                                </div>
            
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Expense Amount (BDT) <small style="color: red">*</small></label>
                                        <input type="number" step="0.01" required id="transaction_amount" name="transaction_amount" value="{{$society_transaction->transaction_amount}}" class="form-control form-control-lg" />
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
