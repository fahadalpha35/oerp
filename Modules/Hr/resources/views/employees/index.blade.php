@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="width: 100%; background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm">Add Employee</a>

                <div class="col-md-12 col-xl-12 col-sm-12">
                    <h3 class="mt-2 text-center">Employee List</h3>
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
                              <th>Company sd</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Designation</th>
                              <th>Branch</th>
                              <th>Department</th>
                              <th>Joining Date</th>
                              <th>Monthly Salary (BDT)</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($employees as $employee)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$employee->employee_company}}</td>
                              <td>{{$employee->employee_name}}</td>
                              <td>{{$employee->employee_email}}</td>
                              <td>{{$employee->employee_designation}}</td>
                              <td>{{$employee->employee_branch}}</td>
                              <td>{{$employee->employee_department}}</td>
                              <td>{{$employee->joining_date}}</td>
                              <td>{{$employee->monthly_salary}}</td>
                              <td>
                                <a href="/employees/{{ $employee->id }}/" style="color: white"><button class="btn btn-info"> View</button></a>
                                <a href="{{route('employees.edit',$employee->id)}}" style="color: white"><button class="btn btn-warning"> Edit</button></a>
                                <a onclick="deleteOperationWithoutYajra('{{ route('employees.destroy', ':id') }}', {{$employee->id}})" style="color: white"><button class="btn btn-danger"> Delete</button></a>
                              </td>
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
