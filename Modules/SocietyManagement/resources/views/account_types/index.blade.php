@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('add_society_account_type') }}" class="btn btn-success btn-sm">Add Account Type</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Account Type List</h3>
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
                         <table id="exampleTableWithoutYajra" class="table table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                              <th>Serial No.</th>
                              <th>Account Name</th>
                              <th>Type</th>
                              <th>Transaction Type</th>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2)|| (auth()->user()->role_id == 3))
                              <th>Action</th>
                              @endif
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($account_types as $account_type)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$account_type->account_name}}</td>
                              <td>
                                @if(($account_type->accounts_type) == 'A')
                                Asset
                                @elseif(($account_type->accounts_type) == 'L')
                                Liability
                                @else
                                Equity
                                @endif
                              </td>
                              <td>
                                @if($account_type->transaction_type == 1)
                                  Debit
                                @else
                                  Credit
                                @endif
                              </td>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <td>
                                <a href="{{route('edit_society_account_type',$account_type->id)}}" style="color: white"><button class="btn btn-warning"> Edit</button></a>
                                <a onclick="deleteOperationWithoutYajra('{{ route('delete_society_account_type', ':id') }}', {{$account_type->id}})" style="color: white"><button class="btn btn-danger"> Delete</button></a>
                              </td>
                              @endif
                            </tr>
                            @endforeach

                            </tbody>
                          </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('masterScripts')
<script>
$(document).ready(function() {
    var table = $('#exampleTableWithoutYajra').DataTable({
        responsive: true,
    });
});
</script>
@endpush
