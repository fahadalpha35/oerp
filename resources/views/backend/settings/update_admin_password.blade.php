@extends('backend.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Settings</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Password</h4>
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
                        <form class="forms-sample" id="passwordResetForm">
                            <div class="form-group">
                                <label >Admin Username/Email</label>
                                <input type="text" class="form-control" value="{{$user_email}}" readonly="">
                            </div>
                            
                            <div class="form-group">
                                <label for="current_password">Current Password <small style="color: red">*</small></label>
                                <input type="password" class="form-control" id="present_password" placeholder="Enter Current Password" name="current_password" required="">
                                {{-- <span id="check_password"></span> --}}
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password <small style="color: red">*</small></label>
                                <input type="password" class="form-control" id="new_password" onkeyup="typePassword()" placeholder="Enter New Password" name="new_password" >
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password <small style="color: red">*</small></label>
                                <input type="password" class="form-control" id="confirm_password" onkeyup="machPassword()" placeholder="Confirm Password" name="confirm_password" >
                                <p id="message"></p>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.layout.footer')
    <!-- partial -->
</div>
@endsection


@push('masterScripts')
<script type="text/javascript">
  
    const new_password = document.getElementById('new_password');
    const confirm_password = document.getElementById('confirm_password');
    const message = document.getElementById('message');
    
    function typePassword() {
      confirm_password.value = '';
      message.style.color = 'white';                 
        };
    
    function machPassword() {   
            // Check if passwords match
            if (new_password.value === confirm_password.value){
                message.textContent = 'Passwords match!';
                message.style.color = 'green';
            }else{
                message.textContent = 'Passwords do not match!';
                message.style.color = 'red';
            }             
        };
    
    document.getElementById('passwordResetForm').addEventListener('submit',function(event){
      event.preventDefault();
    
        var passwordResetFormData = new FormData(this);
    
         var current_password = document.getElementById('present_password').value;
        if(current_password == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Current Password",
                });
            return false;
        }
    
        var new_password = document.getElementById('new_password').value;
        if(new_password == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter New Password",
                });
            return false;
        }
     
        if(new_password.length < 8){
          Swal.fire({
                icon: "warning",
                title: "New Password must be at least 8 characters samer",
              });
          return false;
        }
    
        var confirm_password = document.getElementById('confirm_password').value;
        if(confirm_password == ''){
        Swal.fire({
                icon: "warning",
                title: "Confirm password can not be null",
                });
            return false;
        }
    
        //matching new password and confirm password
        if (new_password !== confirm_password) {
          Swal.fire({
                icon: "error",
                title: "New Password and Confirm Password did not match",
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
     axios.post('update-admin-password',passwordResetFormData).then(response=>{
      console.log(response);
    
      Swal.fire({
                  icon: "success",
                  title: ''+ response.data.message
                });
            //  return false;
            setTimeout(function() {
                window.location.reload();
            }, 2000);
    
    
       }).catch(error => {
        if(error.response.data.error){
            Swal.fire({
                icon: "error",
                title: error.response.data.error
            });
        }else{
            Swal.fire({
                icon: "error",
                title: error.response.data.new_password
            });
        }
        });
    //   });
    
      });
    </script>
@endpush