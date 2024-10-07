@extends('backend.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div style="width: 100%; background-color: #fff;border-radius: 20px;">
     
            <div class="mt-5 row" style="padding: 25px;">
                <a href="{{ route('apply_leave') }}" class="btn btn-success btn-sm"> Add Leave Application</a>  
                      
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <h3 class="mt-2 text-center">Leave Applications List</h3>
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
                            <table id="leaveApplicationsTable" class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Applicant Name</th>
                                        <th>Application Type</th>
                                        <th>Leave Type</th>
                                        <th>Application Date</th>
                                        <th>Approved Date</th>
                                        <th>Declined Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach($leaveApplications as $application)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $application->name }}</td>
                                        <td>
                                            @if($application->application_type == 1)
                                            <span class="badge badge-info">File Attachment</span>
                                            @else
                                            <span class="badge badge-success">Application Form</span>
                                            @endif
                                        </td>
                                        <td>{{ $application->leave_type_name }}</td>
                                        <td>{{ $application->application_date }}</td>
                                        <td>{{ $application->application_approved_date }}</td>
                                        <td>{{ $application->application_decline_date }}</td>
                                        <td>
                                            @if($application->application_status == 1)
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($application->application_status == 2)
                                            <span class="badge badge-success">Approved</span>
                                            @else
                                            <span class="badge badge-success">Declined</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($application->application_status == 1)           
                                            <a href="{{ route('review_leave', $application->id) }}" style="color: white">
                                                <button class="btn btn-info">
                                                    <i class="fa-solid fa-magnifying-glass"></i> Review
                                                </button>
                                            </a>
                                            @elseif($application->application_status == 2)
                                            <a href="#" style="color: white">
                                                <button disabled class="btn btn-success">
                                                    Approved
                                                </button>
                                            </a>
                                            @else
                                            <a href="#" style="color: white">
                                                <button disabled class="btn btn-danger">
                                                    Declined
                                                </button>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
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
$(document).ready(function() {
    $('#leaveApplicationsTable').DataTable({
        responsive: true, // Enable responsive behavior
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from printing
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from CSV
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from Excel
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from PDF
                }
            }
        ]
    });
});
</script>
@endpush
