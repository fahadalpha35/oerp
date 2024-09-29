@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <a href="{{ route('order.create') }}" class="btn btn-success btn-sm">Add Order</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Manufacture Orders List</h3>
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
                            <table id="ordersTable" class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Client ID</th>
                                        <th>Product Name</th>
                                        <th>Internal Notes</th>
                                        <th>Unit of Measure</th>
                                        <th>Purchase Unit of Measure</th>
                                        <th>Sales Price</th>
                                        <th>Cost</th>
                                        <th>Barcode</th>
                                        <th>SKU Code</th>
                                        <th>Image</th>
                                        <th>Delivery Date</th>
                                        <th>Quantity</th>
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

@push('masterScripts')
<script>
const csrfToken = '{{ csrf_token() }}'; // Define csrfToken globally

$(document).ready(function() {
    $('#ordersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('order.index') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'client_id', name: 'client_id' },
            { data: 'product_name', name: 'product_name' },
            { data: 'internal_notes', name: 'internal_notes' },
            { data: 'unit_of_measure', name: 'unit_of_measure' },
            { data: 'purchase_unit_of_measure', name: 'purchase_unit_of_measure' },
            { data: 'sales_price', name: 'sales_price' },
            { data: 'cost', name: 'cost' },
            { data: 'barcode', name: 'barcode' },
            { data: 'sku_code', name: 'sku_code' },
            { data: 'image', name: 'image' },
            { data: 'delivery_date', name: 'delivery_date' },
            { data: 'quantity', name: 'quantity' },
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
            axios.delete('{{ route('order.destroy', ':id') }}'.replace(':id', row_id), {
                headers: { 'X-CSRF-TOKEN': csrfToken }
            }).then(response => {
                Swal.fire({
                    icon: "success",
                    title: response.data.success,
                });
                $('#ordersTable').DataTable().ajax.reload();
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
