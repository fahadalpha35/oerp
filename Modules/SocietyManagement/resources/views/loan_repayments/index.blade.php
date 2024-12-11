@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Loan Repayments List</h3>
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
                                            <th>Loan Number</th>
                                            <th>Due Date</th>
                                            <th>Amount Due (BDT)</th>
                                            <th>Amount Paid (BDT)</th>                                   
                                            <th>Status</th>
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
    </div>
@endsection


@push('masterScripts')

<script>
    this.loadDataTable('exampleTable', '{{ route('loan_repayment_list') }}',
        [
    
            {data: 'loan_number', name: 'loan_number'},
            {data: 'due_date', name: 'due_date'},
            {data: 'amount_due', name: 'amount_due'},
            {data: 'amount_paid', name: 'amount_paid'},
            {data: 'status_label', name: 'status_label'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
);

</script>
@endpush
