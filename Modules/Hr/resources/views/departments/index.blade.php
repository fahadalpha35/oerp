@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('departments.create') }}" class="btn btn-success btn-sm">Add Department</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Department List</h3>
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
                              <th>Company Name</th>
                              <th>Branch Name</th>
                              <th>Department Name</th>
                              <th>Status</th>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <th>Action</th>
                              @endif
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($departments as $department)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$department->company_name}}</td>
                              <td>{{$department->branch_name}}</td>
                              <td>{{$department->dept_name}}</td>
                              <td>
                                @if($department->dept_status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                              </td>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <td>
                                <a href="{{route('departments.edit',$department->id)}}" style="color: white"><button class="btn btn-warning"> Edit</button></a>
                                <a onclick="deleteOperationWithoutYajra('{{ route('departments.destroy', ':id') }}', {{$department->id}})" style="color: white"><button class="btn btn-danger"> Delete</button></a>
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
