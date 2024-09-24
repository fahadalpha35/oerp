@extends('backend.layout.layout')

@section('content') 
<div class="main-panel">
    <div class="content-wrapper">
      
        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm">Add Employee</a>
               
                <div class="col-md-12 col-sm-12">
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
                         <table id="exampleTable" class="table table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                              <th>Serial No.</th>
                              <th>Company</th>
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
                                <a href="{{route('employees.show',$employee->id)}}" style="color: white"><button class="btn btn-info"> View</button></a>
                                <a href="{{route('employees.edit',$employee->id)}}" style="color: white"><button class="btn btn-warning"> Edit</button></a>
                                <a onclick="deleteOperation({{$employee->id}})" style="color: white"><button class="btn btn-danger"> Delete</button></a>
                              </td>
                            </tr> 
                            @endforeach              
                     
                            </tfoot>
                          </table>
                            
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    @include('backend.layout.footer')
</div>
@endsection


@push('masterScripts')

<script>
const csrfToken = '{{ csrf_token() }}'; // Define csrfToken globally

$(document).ready(function() {
    var table = $('#exampleTable').DataTable({
        responsive: true,       
    });
});


function deleteOperation(row_id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        customClass: {
            popup: 'my-swal-class'
        },
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform the delete action
            axios.delete('{{ route('employees.destroy', ':id') }}'.replace(':id', row_id), {
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token
                }
            }) 
            .then(response => {
             console.log(response);
              setTimeout(function() {
                  window.location.reload();
              }, 2000);
              Swal.fire({
                          icon: "success",
                          title: ''+ response.data.message,
                        });
                    return false; 
            })
            .catch(error => {
                Swal.fire(
                    'Error!',
                    'There was an issue with deleting the data',
                    'error'
                );
            });
        }
    });
}

</script>
@endpush
