@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('add_society_transaction') }}" class="btn btn-success btn-sm">Add Transaction</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Transaction List</h3>
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
                                            <th>Account Name</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction Name</th>
                                            <th>Cost Less</th>
                                            <th>Transaction Amount (BDT)</th>
                                            <th>Action</th> <!-- Added Action column -->
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
    </div>
@endsection

@push('masterScripts')
<script>
    this.loadDataTable('exampleTable', '{{ route('society_transaction_list') }}',
        [
            {data: 'account_name', name: 'account_name'},
            {data: 'transaction_date', name: 'transaction_date'},
            {data: 'transaction_name', name: 'transaction_name'},
            {data: 'cost_less_type', name: 'cost_less_type'},
            {data: 'transaction_amount', name: 'transaction_amount'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
);
</script>
@endpush
