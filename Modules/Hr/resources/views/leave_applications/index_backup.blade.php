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
                            <table id="exampleTableWithoutYajra" class="table table-bordered table-hover">
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
                                        <td>
                                            @if($application->application_status == 1)
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($application->application_status == 2)
                                            <span class="badge badge-success">Approved</span>
                                            @else
                                            <span class="badge badge-danger">Declined</span>
                                            @endif
                                        </td>
                                        <td>{{ $application->application_approved_date }}</td>
                                        <td>{{ $application->application_decline_date }}</td>
                                        <td>
                                            
                                            <!-- Application way is 'file attachment' -->
                                            @if($application->application_type == 1)
                                            <!-- File Attachment is pending/submitted start -->
                                            @if($application->application_status == 1)
                                            <a href="" style="color: white">
                                                <button class="btn btn-outline-primary">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                                </button>
                                            </a>
                                            @else
                                            <a href="#" style="color: white">
                                                <button disabled class="btn btn-outline-secondary">Submitted</button>
                                            </a>
                                            @endif
                                            <!-- File Attachment is pending/submitted end -->

                                            <!-- Application way is 'Leave Application Form' -->
                                            @else
                                            <!-- Leave Application Form is pending/submitted start -->
                                            @if($application->application_status == 1)
                                            <a href="" style="color: white">
                                                <button class="btn btn-outline-primary">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                                </button>
                                            </a>
                                            @else
                                            <a href="#" style="color: white">
                                                <button disabled class="btn btn-outline-secondary">Submitted</button>
                                            </a>
                                            @endif
                                            <!-- Leave Application Form is pending/submitted end -->

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
</div>

@endsection

@push('masterScripts')
<script>
$(document).ready(function() {
    var table = $('#exampleTableWithoutYajra').DataTable({
        responsive: true,
    });
});
</script>
@endpush
