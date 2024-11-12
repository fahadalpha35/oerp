@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('event_tickets.create') }}" class="btn btn-success btn-sm">Add Ticket</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Event Ticket List</h3>
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
                                            <th>Ticket Type</th>
                                            <th>Ticket Price (BDT)</th>
                                            <th>Ticket Quantity</th>
                                            <th>Ticket Status</th>
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
    this.loadDataTable('exampleTable', '{{ route('event_tickets.index') }}',
        [
            {data: 'event_name', name: 'event_name'},
            {data: 'ticket_type_label', name: 'ticket_type_label'},
            {data: 'ticket_price', name: 'ticket_price'},
            {data: 'ticket_quantity', name: 'ticket_quantity'},
            {data: 'ticket_status_label', name: 'ticket_status_label'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
);

</script>
@endpush
