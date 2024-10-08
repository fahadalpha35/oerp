@extends('backend.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div style="width: 100%; background-color: #fff;border-radius: 20px;">
     
            <div class="mt-5 row" style="padding: 25px;">
                <a href="{{ route('apply_leave') }}" class="btn btn-success btn-sm"> Add Leave Application</a>  
                      
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <h3 class="mt-2 text-center">Review Leave Applications</h3>
                    <div class="card">
                        <!-- /.card-header -->
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
                            <table id="leave_approval_table" class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Applicant Name</th>
                                        <th>Application Type</th>
                                        <th>Leave Type</th>
                                        <th>Application Date</th>
                                        <th>Status</th>
                                        <th>Approved Date</th>
                                        <th>Declined Date</th>                                      
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <br>
       
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@push('masterScripts')
<script>
    this.loadDataTable('leave_approval_table', '{{ route('leave_application_approval_list') }}',
            [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'application_type_label', name: 'application_type_label', orderable: false, searchable: true },
                { data: 'leave_type_name', name: 'leave_type_name' },
                { data: 'application_date', name: 'application_date' },
                { data: 'application_status_label', name: 'application_status_label',searchable: true },
                { data: 'application_approved_date', name: 'application_approved_date' },
                { data: 'application_decline_date', name: 'application_decline_date' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
    );
    </script>
@endpush
