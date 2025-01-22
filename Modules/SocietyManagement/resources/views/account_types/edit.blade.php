@extends('backend.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('society_account_type_list')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <h3 class="mt-2 text-center">Edit Account Type</h3>
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
                        <form action="{{route('update_society_account_type',$account_type->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf     
                            <div class="row">        
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Account Name <small style="color: red">*</small></label>
                                        <input type="text" placeholder="Account Name"  id="account_name" name="account_name" value="{{$account_type->account_name}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                              <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Type <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="accounts_type" name="accounts_type" style="width: 100%;">
                                            <option value="{{$account_type->accounts_type}}">
                                                @if($account_type->accounts_type == 'A')
                                                Asset
                                                @elseif($account_type->accounts_type == 'L')
                                                Liability
                                                @else
                                                Equity
                                                @endif
                                            </option>
                                            <option value="A">Asset</option>
                                            <option value="L">Liability</option>
                                            <option value="E">Equity</option>
                                      </select>
                                      </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Transaction Type <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="transaction_type" name="transaction_type" style="width: 100%;">
                                            <option value="{{$account_type->transaction_type}}">
                                                @if($account_type->transaction_type == 1)
                                                Debit
                                                @else
                                                Credit
                                                @endif
                                            </option>
                                            <option value="1">Debit</option>
                                            <option value="2">Credit</option>
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
