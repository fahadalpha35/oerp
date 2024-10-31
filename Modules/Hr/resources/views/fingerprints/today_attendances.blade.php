@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('fingerprint_portal')}}">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <br>
        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Device Today Attendance List</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <table id="fingerprintAttendanceTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Designation</th>                  
                                      <th>Branch</th>                      
                                      <th>Attendance Time</th>
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
    this.loadDataTable('fingerprintAttendanceTable', '{{ route('system_fingerprint_attendances_today') }}',
        [
            { data: 'name', name: 'name' },
            { data: 'designation_name', name: 'designation_name' }, 
            { data: 'br_name', name: 'br_name' },         
            { data: 'timestamp', name: 'timestamp' }  
        ]
);

</script>
@endpush
