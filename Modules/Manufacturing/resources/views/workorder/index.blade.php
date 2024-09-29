@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div style="background-color: #fff; border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <a href="{{ route('workorder.create') }}" class="btn btn-success btn-sm">Add Work Order</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Manufacture Work Orders List</h3>
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
                            <table id="workOrdersTable" class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Estimation ID</th>
                                        <th>Assign Manager</th>
                                        <th>Priority</th>
                                        <th>Notes</th>
                                        <th>Preferred Date</th>
                                        <th>Preference Note</th>
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

this.loadDataTable('workOrdersTable', '{{ route('workorder.index') }}',
    [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'estimation_id', name: 'estimation_id' },
            { data: 'assign_manager', name: 'assign_manager' },
            { data: 'priority', name: 'priority' },
            { data: 'notes', name: 'notes' },
            { data: 'preferred_date', name: 'preferred_date' },
            { data: 'preference_note', name: 'preference_note' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
);

</script>
@endpush
@endsection
