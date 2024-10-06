@extends('master')

@section('title')
Edit Leave Application
@endsection

@push('css')
<style>
#for_permission_review{
    display: none;
}
</style>
@endpush

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('leave_applications')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Leave Application Details</h3>
                  </div>        

                    <div class="card-body">
                        <form id="updateLeaveApplicationForm">
                          <div class="row">
                            <div class="col-md-12 col-sm-12">
                              <!-- Application Type -->
                                <div class="form-group mb-4">
                                  <label>Leave Type <small style="color: red">*</small></label>
                                  <select required class="form-control select2bs4" id="leave_type" name="leave_type" style="width: 100%;">                                  
                                      <option value="{{$leaveApplication->leave_type}}">{{$leaveApplication->leave_type_name}}</option>
                                      @foreach ($leave_types as $leave_type)
                                      <option value="{{$leave_type->id}}">{{$leave_type->type_name}}</option>
                                      @endforeach                                                             
                                  </select>
                              </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                              <!-- Application From -->
                              <div class="form-group mb-4">
                                <label>Application From <small style="color: red">*</small></label>
                                <input type="date" required class="form-control" name="application_from" id="application_from" value="{{$leaveApplication->application_from}}">
                            </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                              <!-- Application To -->
                              <div class="form-group mb-4">
                                <label>Application To <small style="color: red">*</small></label>
                                <input type="date" required class="form-control" name="application_to" id="application_to" value="{{$leaveApplication->application_to}}">
                            </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                              <!-- Duration-->
                              <div class="form-group mb-4">
                                <label for="duration">Duration (days)</label>
                                <input type="text" id="duration" name="duration" readonly class="form-control form-control-lg"  value="{{$leaveApplication->duration}}"/>
                            </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                              <!-- Application Body -->
                            <div class="form-group mb-4">
                              <label>Application Body</label>
                              <textarea required class="form-control" name="application_msg" id="application_msg">{{$leaveApplication->application_msg}}</textarea>
                            </div>
                            </div>
                          </div>

                            <input type="hidden" value="{{$leaveApplication->id}}" name="id" id="leave_application_id">
                            <button type="submit" id="sub" class="btn btn-info float-right mr-4">Update</button>
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
<script>
 
 $(document).ready(function() {
    // Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
});


// Execute the function (duration between application from and application to) when the page loads
document.addEventListener('DOMContentLoaded', validateAndCalculateDuration);

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



// Update leave application form submission
document.getElementById('updateLeaveApplicationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var updateLeaveApplicationFormData = new FormData(this);
    var leave_application_id = document.getElementById('leave_application_id').value;



    var leave_type = document.getElementById('leave_type').value;
    if (leave_type == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Select Leave Type",
        });
        return false;
    }

    var application_msg = document.getElementById('application_msg').value;
    if (application_msg == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Fillup Application Body",
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

    axios.post('/api/update_leave_application/' + leave_application_id, updateLeaveApplicationFormData).then(response => {
        console.log(response);
        setTimeout(function() {
            // window.location.reload();
            window.location.href = "{{ route('leave_applications') }}";
        }, 2000);
        Swal.fire({
            icon: "success",
            title: response.data.message,
        });
        return false;
    }).catch(error => Swal.fire({
        icon: "error",
        title: error.response.data.message,
    }));
});
    
</script>
@endpush
