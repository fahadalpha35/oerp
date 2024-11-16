@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('sold_event_tickets.create') }}" class="btn btn-success btn-sm">Sale Ticket</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Sold Ticket List</h3>
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
                                            <th>Ticket Selling Date</th>
                                            <th>Ticket Type</th>
                                            <th>Ticket Price (BDT)</th>
                                            <th>Sold Ticket Quantity</th>
                                            <th>Total Revenue</th>
                                            {{-- <th>Action</th> --}}
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
    this.loadDataTable('exampleTable', '{{ route('sold_event_tickets.index') }}',
        [
            {data: 'event_name', name: 'event_name'},
            {data: 'ticket_selling_date', name: 'ticket_selling_date'},
            {data: 'ticket_type_label', name: 'ticket_type_label'},
            {data: 'ticket_price', name: 'ticket_price'},
            {data: 'sold_ticket_quantity', name: 'sold_ticket_quantity'},
            {data: 'total_revenue', name: 'total_revenue'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
);

</script>
@endpush
