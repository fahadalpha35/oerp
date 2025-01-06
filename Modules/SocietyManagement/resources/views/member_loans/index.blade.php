@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('society_member_loans.create') }}" class="btn btn-success btn-sm">Add Loan</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Members Loan List</h3>
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
                                            <th>Member Name</th>
                                            <th>Loan Number</th>
                                            <th>Loan Amount (BDT)</th>
                                            <th>Interest Rate</th>
                                            <th>Total Amount Due (BDT)</th>
                                            <th>Repayment Term</th>                                           
                                            <th>Loan Start Date</th>                                           
                                            <th>Loan End Date</th>                                           
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
    this.loadDataTable('exampleTable', '{{ route('society_member_loans.index') }}',
        [
    
            {data: 'member_name', name: 'member_name'},
            {data: 'loan_number', name: 'loan_number'},
            {data: 'loan_amount', name: 'loan_amount'},
            {data: 'interest_rate', name: 'interest_rate'},
            {data: 'total_amount_due', name: 'total_amount_due'},
            {data: 'repayment_term', name: 'repayment_term'},
            {data: 'loan_start_date', name: 'loan_start_date'},
            {data: 'loan_end_date', name: 'loan_end_date'},
            {data: 'status_label', name: 'status_label'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
);

</script>
@endpush
