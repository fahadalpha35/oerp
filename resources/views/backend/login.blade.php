<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Otithee ERP</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('backend/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ url('backend/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
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
    <div class="container-scroller">
        <div class="content-wrapperlogin d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-center py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <img src="{{ url('backend/images/oerp.png') }}" alt="logo">
                        </div>
                        <h4>Welcome!</h4>
                        <h6 class="font-weight-light">Sign in to your account</h6>
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
                        <form class="pt-3" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" required name="email" id="email" class="form-control form-control-lg" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" required name="password"  id="password" class="form-control form-control-lg" placeholder="Password">
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Login</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                {{-- <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> Keep me signed in
                                    </label>
                                </div> --}}
                                {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
   

    <script src="{{ url('backend/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- inject:js -->
    <script src="{{ url('backend/js/off-canvas.js') }}"></script>
    <script src="{{ url('backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('backend/js/template.js') }}"></script>
    <script src="{{ url('backend/js/settings.js') }}"></script>
    <script src="{{ url('backend/js/todolist.js') }}"></script>
    <!-- endinject -->
</body>
</html>
