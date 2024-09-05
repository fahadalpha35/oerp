<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Otithee ERP | Register</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('backend/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ url('backend/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->

   <!-- Select2 CSS -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ url('backend/vendors/select2/select2.min.css') }}">

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('backend/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ url('backend/images/favicon.png') }}" />
    <style>
        body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            font-family: 'Arial', sans-serif;
        }
        .container-scroller {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .auth-form-light {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }
        .brand-logo img {
            width: 120px;
            margin-bottom: 0px;
        }
        h4 {
            font-size: 19px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        h6 {
            font-size: 16px;
            font-weight: 400;
            color: #777;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
            color: #555;
            background: #f2f2f2;
            border: none;
        }
        .auth-form-btn {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            border-radius: 30px;
            padding: 12px 0;
            font-size: 18px;
            transition: background 0.3s ease;
        }
        .auth-form-btn:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
        }
        .auth-link {
            color: #2575fc;
            text-decoration: none;
            font-size: 14px;
        }
        .auth-link:hover {
            text-decoration: underline;
        }
        .form-check-label {
            font-size: 14px;
            color: #777;
        }
        .alert {
            border-radius: 10px;
            font-size: 14px;
        }
        .content-wrapperlogin {
            background: #c8d3ff;
            padding: 2.375rem 2.375rem;
            width: 100%;
            -webkit-flex-grow: 1;
            flex-grow: 1;
            }
    </style>
</head>
<body>
    <div class="container-fluid page-body-wrapper">
        <div class="container-wrapper">
            <div class="content-wrapperlogin d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-center py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{ url('backend/images/oerp.png') }}" alt="logo">
                            </div>
                            <h4>Welcome!</h4>
                            <h6 class="font-weight-light">Sign up for a new account</h6>
                            @if(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> {{ Session::get('error_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                        <form class="pt-3" action="{{route('admin.register')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" required class="form-control form-control-lg" id="name" name="name" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="email" required class="form-control form-control-lg" id="email" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="password" required id="password" name="password" onkeyup="typePassword()" class="form-control form-control-lg" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="password" required id="confirm_password" onkeyup="machPassword()" class="form-control form-control-lg" placeholder="Confirm Password">
                                                <p id="message"></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h3>Company Details</h3>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" required placeholder="Company Name" id="company_name" name="company_name" class="form-control form-control-lg" />
                                            </div>        
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" required placeholder="Official Contact No." id="contact_no" name="contact_no" class="form-control form-control-lg" />
                                            </div>  
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" required placeholder="Trade License No." id="trade_license_no" name="trade_license_no" class="form-control form-control-lg" />
                                            </div>  
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" required placeholder="BIN No." id="bin_no" name="bin_no" class="form-control form-control-lg" />
                                            </div> 
                                        </div>
        
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" required placeholder="TIN No." id="tin_no" name="tin_no" class="form-control form-control-lg" />
                                            </div> 
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" required placeholder="Business Type" id="business_type" name="business_type" class="form-control form-control-lg" />
                                            </div> 
                                        </div>


        
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <textarea required placeholder="Company Address" id="company_address" name="company_address" class="form-control" ></textarea>
                                            </div> 
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" required placeholder="Country" id="country" name="country" class="form-control form-control-lg" />
                                            </div> 
                                        </div>

                                        {{-- <div class="col-md-6 col-sm-12"></div> --}}
        
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <select class="form-control select2" id="division" name="division" style="width: 100%;">
                                                <option selected="selected" value="">Select Division</option>
                                                @foreach($divisions as $division)
                                                <option value="{{$division->id}}">{{$division->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
        
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <select class="form-control select2" id="district" name="district" style="width: 100%;">
                                                    <option value="" >Select District</option>
                                                    </select>
                                            </div>
                                        </div>
        
                                    </div>
                                </div>
                            </div>                             
    
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Register</button>                               
                                    {{-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="#">Register</a> --}}
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="{{route('admin.login')}}" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
    </div>
   
    <!-- page-body-wrapper ends -->
    <!-- container-scroller -->

<!-- axios library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>

<!-- jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- plugins:js -->
<script src="{{ url('backend/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- inject:js -->
<script src="{{ url('backend/js/off-canvas.js') }}"></script>
<script src="{{ url('backend/js/hoverable-collapse.js') }}"></script>
<script src="{{ url('backend/js/template.js') }}"></script>
<script src="{{ url('backend/js/settings.js') }}"></script>
<script src="{{ url('backend/js/todolist.js') }}"></script>
<!-- endinject -->

<!-- Select2 JS -->
<script src="{{ url('backend/vendors/select2/select2.min.js') }}"></script>

    <script>
        $.noConflict(); // Ensures jQuery does not conflict with other libraries
        jQuery(document).ready(function($) {
            $('.select2').select2();

            //division and district dependancy dropdown logic start
            $('#division').on('change',function(event){
            event.preventDefault();
            var selectedDivision = $('#division').val();

            if (selectedDivision == '') {
                    $('#district').html('');
                    return false;
                }

            // Function to get CSRF token from meta tag
            function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }
            // Set up Axios defaults
            axios.defaults.withCredentials = true;
            axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

            axios.post('/backend/division',{
                    data: selectedDivision
                }).then(response=>{
                $('#district').html(response.data);
                    console.log(response.data);
                });
           
            });
            //division and district dependancy dropdown logic end
        });
   

        const given_passoword = document.getElementById('password');
        const confirm_password = document.getElementById('confirm_password');
        const message = document.getElementById('message');

        function typePassword() {
            confirm_password.value = '';
            message.style.color = 'white';                 
                };

        function machPassword() {   
                // Check if passwords match
                if (given_passoword.value === confirm_password.value){
                    message.textContent = 'Passwords match!';
                    message.style.color = 'green';
                }else{
                    message.textContent = 'Passwords do not match!';
                    message.style.color = 'red';
                }             
            };

        
    </script>

</body>
</html>
