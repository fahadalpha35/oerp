@extends('backend.layout.layout')

@section('content')

    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <a href="{{ route('purchase.create') }}" class="btn btn-success btn-sm">Add Purchase</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Purchase Lists</h3>
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
                            <table id="supplierTable" class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Supplier Name</th>
                                        <th>Purchase Date</th>
                                        <th>Invoice No</th>
                                        <th>Sub Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Total</th>
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

@endsection

@push('masterScripts')
<script>

this.loadDataTable('supplierTable', '{{ route('purchase.index') }}',
        [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'supplier.name', name: 'supplier.name' },
            {data: 'purchase_date', name:'purchase_date'},
            {data: 'invoice_no', name:'invoice_no'},
            {data: 'sub_total', name:'sub_total'},
            {data: 'paid', name:'paid'},
            {data: 'due', name:'due'},
            {data: 'total', name:'total'},
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
);
</script>
@endpush
