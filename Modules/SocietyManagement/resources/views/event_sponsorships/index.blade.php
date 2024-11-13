@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('event_sponsorships.create') }}" class="btn btn-success btn-sm">Add Sponsorship</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Sponsorship List</h3>
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
                                            <th>Event Name</th>
                                            <th>Sponsor Name</th>
                                            <th>Contact Number</th>
                                            <th>Contribution Amount (BDT)</th>
                                            <th>Amount Collection Date</th>
                                            <th>Payment Status</th>
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
    this.loadDataTable('exampleTable', '{{ route('event_sponsorships.index') }}',
        [
    
            {data: 'event_name', name: 'event_name'},
            {data: 'sponsor_name', name: 'sponsor_name'},
            {data: 'contact_number', name: 'contact_number'},
            {data: 'contribution_amount', name: 'contribution_amount'},
            {data: 'money_collection_date', name: 'money_collection_date'},
            {data: 'payment_status_label', name: 'payment_status_label'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
);

</script>
@endpush
