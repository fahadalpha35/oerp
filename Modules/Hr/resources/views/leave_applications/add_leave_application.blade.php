@extends('backend.layout.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{ route('apply_leave') }}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <h3 class="mt-2 text-center">Add Leave Application</h3>
                <br>
                    <div class="card">
                        <div class="card-body">
                            <form id="addNewLeaveApplicationForm">             
                                <!-- Application Type input -->
                                <div class="form-group mb-4">
                                    <label>Leave Type <small style="color: red">*</small></label>
                                    <select required class="form-control select2" id="leave_type" name="leave_type" style="width: 100%;">                                  
                                        <option value="">--Select--</option>
                                        @foreach ($leave_types as $leave_type)
                                        <option value="{{$leave_type->id}}">{{$leave_type->type_name}}</option>
                                        @endforeach                                                             
                                    </select>
                                </div> 

                                <!-- Application Date input -->
                                <div class="form-group mb-4">
                                    <label for="application_date">Application Date <small style="color: red">*</small></label>
                                    <input type="date" readonly id="application_date" name="application_date" value="{{ date('Y-m-d') }}" class="form-control form-control-lg" />
                                </div>

                                <h5>Leave Duration</h5>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label >Application From <small style="color: red">*</small></label>
                                            <input type="date" required id="application_from" name="application_from" value="{{ date('Y-m-d') }}" class="form-control form-control-lg" />
                                        </div> 
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label >Application To <small style="color: red">*</small></label>
                                            <input type="date" required id="application_to" name="application_to" value="{{ date('Y-m-d') }}" class="form-control form-control-lg" />
                                        </div> 
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="duration">Duration (days)</label>
                                            <input type="text" id="duration" name="duration" readonly class="form-control form-control-lg" />
                                        </div> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Application Body</label>
                                    <textarea class="form-control" name="application_msg" id="application_msg"></textarea>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-info float-right mr-4">Submit</button>
                                <br>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <br>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>

@endsection

@push('masterScripts')
<script type="text/javascript">

$.noConflict(); // Ensures jQuery does not conflict with other libraries
    jQuery(document).ready(function($) {
      $('.select2').select2();
    })


// Execute the function (duration between application from and application to) when the page loads
document.addEventListener('DOMContentLoaded', validateAndCalculateDuration);

 // Get today's date
 const today = new Date().toISOString().split('T')[0];
// Set the minimum date to today
document.getElementById('application_from').setAttribute('min', today);
document.getElementById('application_to').setAttribute('min', today);

// Attach the function to the 'change' event of the 'application_to' input
document.getElementById('application_from').addEventListener('change', clearApplicationToDate);
document.getElementById('application_to').addEventListener('change', validateDates);
document.getElementById('application_to').addEventListener('change', validateAndCalculateDuration);


//clear 'Application To' date is 'Application From' is changing
 function clearApplicationToDate(){
    document.getElementById('application_to').value = ''; // Clear the 'application_to' field
    document.getElementById('duration').value = ''; // Clear the 'duration' field
 }

 // Function to compare the dates and show alert
 function validateDates() {
        const fromDate = document.getElementById('application_from').value;
        const toDate = document.getElementById('application_to').value;
        
        if (toDate < fromDate) {
                Swal.fire({
                icon: "warning",
                title: " 'Application To' date cannot be earlier than 'Application From' date.",
            });
            
            document.getElementById('application_to').value = ''; // Clear the 'application_to' field
        }
    }


 // Function to compare dates, show alert, clear 'application_to', and calculate duration
 function validateAndCalculateDuration() {
        const fromDate = new Date(document.getElementById('application_from').value);
        const toDate = new Date(document.getElementById('application_to').value);
        
        if (toDate < fromDate) {
            alert('The "Application To" date cannot be earlier than the "Application From" date.');
            document.getElementById('application_to').value = ''; // Clear the 'application_to' field
            document.getElementById('duration').value = ''; // Clear the duration field
        } else {
            // Calculate the duration in days
            const durationInMilliseconds = toDate - fromDate;
            // const durationInDays = durationInMilliseconds / (1000 * 60 * 60 * 24);
            const durationInDays = (durationInMilliseconds / (1000 * 60 * 60 * 24)) + 1; // Add 1 to count the first day
            document.getElementById('duration').value = durationInDays; // Display duration
        }
    }


document.getElementById('addNewLeaveApplicationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var leaveFormData = new FormData(this);

    var leave_type = document.getElementById('leave_type').value;
    if (leave_type == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Enter Leave Type",
        });
        return false;
    }

    var application_msg = document.getElementById('application_msg').value;
    if (application_msg == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Enter Application Body",
        });
        return false;
    }

        // Function to get CSRF token from meta tag
        function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
        // Set up Axios defaults
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


        // axios.get('sanctum/csrf-cookie').then(response=>{
        axios.post('/leave_application_form_fillup_store', leaveFormData).then(response=>{
        console.log(response);
        window.location.reload();
   
        Swal.fire({
                    icon: "success",
                    title: ''+ response.data.message,
                    });
                return false;
                
        }).catch(error => Swal.fire({
                    icon: "error",
                    title: error.response.data.message.email,
                    }))
        // });
});
</script>
@endpush
