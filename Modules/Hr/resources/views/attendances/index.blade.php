@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Attendance List</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <table id="exampleTable" class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Employee Name</th>
                                            <th>Attendance Date</th>
                                            <th>Entry Time</th>
                                            <th>Exit Time</th>
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
    this.loadDataTable('exampleTable', '{{ route('attendances.index') }}',
        [
            {data: 'id', name: 'id'},
            {data: 'member_name', name: 'member_name'},
            {data: 'attendance_date', name: 'attendance_date'},
            {data: 'entry_time', name: 'entry_time'},
            {data: 'exit_time', name: 'exit_time'},
        ]
);

</script>
@endpush
