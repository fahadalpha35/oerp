@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('create_society_expense_type') }}" class="btn btn-success btn-sm">Add Expense Type</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Expense Type List</h3>
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
                              <th>Type Name</th>
                              <th>Status</th>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2)|| (auth()->user()->role_id == 3))
                              <th>Action</th>
                              @endif
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($society_expenses as $society_expense)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$society_expense->type_name}}</td>
                              <td>
                                @if($society_expense->active_status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                              </td>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <td>
                                <a href="{{route('edit_society_expense_type',$society_expense->id)}}" style="color: white"><button class="btn btn-warning"> Edit</button></a>
                                <a onclick="deleteOperationWithoutYajra('{{ route('destroy_society_expense_type', ':id') }}', {{$society_expense->id}})" style="color: white"><button class="btn btn-danger"> Delete</button></a>
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
