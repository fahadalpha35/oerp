@extends('backend.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <a href="{{ route('part.create') }}" class="btn btn-success btn-sm">Add Part</a>
                
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Manufacture Parts List</h3>
                    <div class="card">
                        <div class="card-body">
                            @if(Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error: </strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success: </strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table id="partsTable" class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Unit</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.layout.footer')
</div>

@push('masterScripts')
<script>
const csrfToken = '{{ csrf_token() }}'; // Define csrfToken globally

$(document).ready(function() {
    $('#partsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('part.index') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price' },
            { data: 'unit', name: 'unit' },
            { data: 'description', name: 'description' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        responsive: true
    });
});

function deleteOperation(row_id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete('{{ route('part.destroy', ':id') }}'.replace(':id', row_id), {
                headers: { 'X-CSRF-TOKEN': csrfToken }
            }).then(response => {
                Swal.fire({
                    icon: "success",
                    title: response.data.message,
                });
                $('#partsTable').DataTable().ajax.reload();
            }).catch(error => {
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
@endsection
