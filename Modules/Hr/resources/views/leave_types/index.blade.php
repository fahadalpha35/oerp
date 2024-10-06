@extends('backend.layout.layout')


@section('content')

  <div class="content-wrapper">
    <div style="width: 100%; background-color: #fff;border-radius: 20px;">
        <div class="mt-5 row" style="padding: 25px;">

          @if((auth()->user()->role_id == 1) || (auth()->user()->role_id == 2) || (auth()->user()->role_id == 3))
          <a href="{{ route('leave_types.create') }}" class="btn btn-success btn-sm">Add Leave Type</a>  
          @endif
          <div class="col-md-12 col-xl-12 col-sm-12">
            <h3 class="mt-2 text-center">Leave Type List</h3>
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
                        <th>Leave Type Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i = 1 @endphp
                      @foreach($leave_types as $leave_type)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$leave_type->type_name}}</td>
                      <td>
                        <a href="{{route('leave_types.edit',$leave_type->id)}}" style="color: white"><button class="btn btn-warning">Edit</button></a>
                        <a onclick="deleteOperationWithoutYajra('{{ route('leave_types.destroy', ':id') }}', {{$leave_type->id}})" style="color: white"><button class="btn btn-danger"> Delete</button></a>
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

// function deleteOperation(row_id)
//     { 
      
//       Swal.fire({
//       title: 'Are you sure?',
//       text: '',
//       icon: 'warning',
//       showCancelButton: true,
//       confirmButtonText: 'Yes',
//       cancelButtonText: 'Cancel'
//     }).then((result) => {
//       if (result.isConfirmed) {
       
//             // Function to get CSRF token from meta tag
//              function getCsrfToken() {
//               return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
//               }
//             // Set up Axios defaults
//             axios.defaults.withCredentials = true;
//             axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

//             axios.get('sanctum/csrf-cookie').then(response=>{
//             axios.post('/api/delete_leave_type/'+ row_id).then(response=>{
//               console.log(response);
//               setTimeout(function() {
//                   window.location.reload();
//               }, 2000);
//               Swal.fire({
//                           icon: "success",
//                           title: ''+ response.data.message,
//                         });
//                     return false;                   
//               }).catch(error => Swal.fire({
//                           icon: "error",
//                           title: error.response.data.message,
//                           }))
//             });
//       } else if (result.isDismissed) {
//         Swal.fire('Cancelled', '', 'error');
//       }
//     });
//     }
  </script>
  @endpush