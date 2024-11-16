@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('society_expenses.create') }}" class="btn btn-success btn-sm">Add Expense</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Expense List</h3>
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
                                            <th>Expense Type</th>
                                            <th>Expense Name</th>
                                            <th>Expense Date</th>
                                            <th>Expense Amount (BDT)</th>
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
    this.loadDataTable('exampleTable', '{{ route('society_expenses.index') }}',
        [
            {data: 'type_name', name: 'type_name'},
            {data: 'expense_name', name: 'expense_name'},
            {data: 'expense_date', name: 'expense_date'},
            {data: 'expense_amount', name: 'expense_amount'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
);

</script>
@endpush
