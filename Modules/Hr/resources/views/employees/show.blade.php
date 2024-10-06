@extends('backend.layout.layout')
@section('content')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-outline-info float-right" href="{{route('employees.index')}}">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>

                        <div class="col-12">
                            <h3 class="mt-2 text-center">Employee Details</h3>
                        <br>
                        <div class="card">


                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('/backend/images/' . $employee->profile_pic) }}"
                                         alt="&nbsp;no preview&nbsp;"
                                         height="150px"
                                         width="150px"
                                         style="border: 2px solid #9eb6c3;
                                                border-radius: 50%;
                                                box-shadow: 0 0 0 3px #fff, 0 0 0 5px #6eb9e5;"
                                                onerror="this.onerror=null;this.src='{{ asset('/backend/images/avatar5.png') }}';">
                                    <br><br>
                                </div>

                                <h4 class="text-muted text-center">{{ $employee->emp_name }}</h4>
                                <h4 class="text-muted text-center">{{ $employee->designation }}</h4>
                                <br>
                                <h3 class="mb-4 text-center">Official Details</h3>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Full Name:</label>
                                        <h5 style="color: #0098ef">{{ $employee->emp_name }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Email:</label>
                                        <h5 style="color: #0098ef">{{ $employee->email }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Joining Date:</label>
                                        <h5 style="color: #0098ef">{{ $employee->joining_date }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Designation:</label>
                                        <h5 style="color: #0098ef">{{ $employee->designation }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Monthly Salary:</label>
                                        <h5 style="color: #0098ef">{{ $employee->monthly_salary }} BDT</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Branch:</label>
                                        <h5 style="color: #0098ef">{{ $employee->branch }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Department:</label>
                                        <h5 style="color: #0098ef">{{ $employee->department }}</h5>
                                    </div>
                                </div>

                                <h3 class="mb-3 text-center">Personal Details</h3>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Father Name:</label>
                                        <h5 style="color: #0098ef">{{ $employee->father_name }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Mother Name:</label>
                                        <h5 style="color: #0098ef">{{ $employee->mother_name }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Religion:</label>
                                        <h5 style="color: #0098ef">{{ $employee->religion }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Gender:</label>
                                        <h5 style="color: #0098ef">{{ $employee->gender }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Marital Status:</label>
                                        <h5 style="color: #0098ef">{{ $employee->marital_status }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>NID Number:</label>
                                        <h5 style="color: #0098ef">{{ $employee->nid_number }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Date of Birth:</label>
                                        <h5 style="color: #0098ef">{{ $employee->birth_date }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Blood Group:</label>
                                        <h5 style="color: #0098ef">{{ $employee->blood_group }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Nationality:</label>
                                        <h5 style="color: #0098ef">{{ $employee->nationality }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Present Address:</label>
                                        <h5 style="color: #0098ef">{{ $employee->present_address }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Permanent Address:</label>
                                        <h5 style="color: #0098ef">{{ $employee->permanent_address }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                        </div>

                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->
        </div>
@endsection
