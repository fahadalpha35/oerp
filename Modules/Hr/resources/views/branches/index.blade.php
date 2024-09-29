@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('branches.create') }}" class="btn btn-success btn-sm">Add Branch</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Branch List</h3>
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
                            <div class="">
                                <table id="exampleTable" class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Company</th>
                                            <th>Branch Type</th>
                                            <th>Branch</th>
                                            <th>Status</th>
                                            <th>Action</th> <!-- Added Action column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($branches as $branch)
                                            <tr>
                                                <td>{{ $branch->id }}</td>
                                                <td>{{ $branch->company_id }}</td>
                                                <td>{{ $branch->br_type }}</td>
                                                <td>{{ $branch->br_name }}</td>
                                                <td>{{ $branch->br_status }}</td>
                                                <td>
                                                    <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
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
const csrfToken = '{{ csrf_token() }}'; // Define csrfToken globally

$(document).ready(function() {

    var table = $('#exampleTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('branches.index') }}",
        columns: [
            // {data: 'id', name: 'id'},
            {data: 'company_name', name: 'company_name',},
            {data: 'branch_type_label', name: 'branch_type_label'},
            {data: 'br_name', name: 'br_name'},
            {data: 'branch_status_label', name: 'branch_status_label'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});

function deleteBranch(branchId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won’t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform the delete action
            axios.delete('{{ route('branches.destroy', ':id') }}'.replace(':id', branchId), {
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token
                }
            })
            .then(response => {
                Swal.fire(
                    'Deleted!',
                    'Your branch has been deleted.',
                    'success'
                );
                // Reload or refresh the DataTable
                $('#exampleTable').DataTable().ajax.reload();
            })
            .catch(error => {
                Swal.fire(
                    'Error!',
                    'There was a problem deleting the branch.',
                    'error'
                );
            });
        }
    });
}


</script>
@endpush
