@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('society_events.create') }}" class="btn btn-success btn-sm">Add Event</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Event List</h3>
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
                                            <th>Event Start Date</th>
                                            <th>Event End Date</th>
                                            <th>Event Budget (BDT)</th>
                                            <th>Organized By</th>
                                            <th>Event Location</th>
                                            <th>Status</th>
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
    this.loadDataTable('exampleTable', '{{ route('society_events.index') }}',
        [
    
            {data: 'event_name', name: 'event_name'},
            {data: 'event_start_date', name: 'event_start_date'},
            {data: 'event_end_date', name: 'event_end_date'},
            {data: 'event_budget', name: 'event_budget'},
            {data: 'organized_by', name: 'organized_by'},
            {data: 'event_loaction', name: 'event_loaction'},
            {data: 'event_status_label', name: 'event_status_label'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
);

</script>
@endpush
