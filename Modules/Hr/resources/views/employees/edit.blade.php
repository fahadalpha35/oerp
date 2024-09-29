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

                                <h4 class="text-muted text-center">{{ $employee->full_name }}</h4>
                                <h4 class="text-muted text-center">{{ $employee->designation }}</h4>
                                <br>
                                <h3 class="mb-4 text-center">Official Details</h3>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>Full Name:</label>
                                        <h5 style="color: #0098ef">{{ $employee->full_name }}</h5>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>Email:</label>
                                        <h5 style="color: #0098ef">{{ $employee->email }}</h5>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>Joining Date:</label>
                                        <h5 style="color: #0098ef">{{ $employee->joining_date }}</h5>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>Designation:</label>
                                        <h5 style="color: #0098ef">{{ $employee->designation }}</h5>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>Monthly Salary:</label>
                                        <h5 style="color: #0098ef">{{ $employee->monthly_salary }} BDT</h5>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>Branch:</label>
                                        <h5 style="color: #0098ef">{{ $employee->branch }}</h5>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-4">
                                        <label>Department:</label>
                                        <h5 style="color: #0098ef">{{ $employee->department }}</h5>
                                    </div>
                                </div>
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
                                <form action="{{ route('employees.update',$employee->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <!-- Monthly Salary -->
                                    <div  class="form-group mb-4">
                                        <label >Monthly Salary <small style="color: red">*</small></label>
                                    <input type="number"  step="0.01" value="{{$employee->monthly_salary}}"  id="monthly_salary" name="monthly_salary" value="{{ old('monthly_salary') }}" class="form-control form-control-lg" />
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                    <!-- Level select -->
                                        <div  class="form-group mb-4">
                                            <label >Level <small style="color: red">*</small></label>
                                            <select  class="form-control select2" id="level" name="level" style="width: 100%;">
                                            <option value="">Select Level</option>
                                            <option value="1">Managing Level</option>
                                            <option value="2">Operational Level</option>
                                            <option value="3">Support Level</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <!-- Designation -->
                                        <div  class="form-group mb-4">
                                            <label >Designation <small style="color: red">*</small></label>
                                            <select  class="form-control select2" id="designation_id" name="designation_id" style="width: 100%;">
                                            <option value="{{$employee->designation_id}}" >{{$employee->designation}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <!-- Branch select -->
                                        <div  class="form-group mb-4">
                                            <label >Branch <small style="color: red">*</small></label>
                                            <select  class="form-control select2" id="branch_id" name="branch_id" style="width: 100%;">
                                                <option selected="selected" value="{{$employee->branch_id}}">{{$employee->branch}}</option>
                                                @foreach($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->br_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                        <div class="col-md-6 col-sm-12">
                                            <!-- Designation -->
                                            <div  class="form-group mb-4">
                                                <label >Department <small style="color: red">*</small></label>
                                                <select  class="form-control select2" id="department_id" name="department_id" style="width: 100%;">
                                                <option value="{{$employee->department_id}}" >{{$employee->department}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Submit</button><br>
                                </form>

                            </div>
                        </div>

                        </div>
                        </div>

                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->
        </div>
@endsection

@push('masterScripts')

<script>
    $.noConflict(); // Ensures jQuery does not conflict with other libraries
    jQuery(document).ready(function($) {
        $('.select2').select2();

        //level and designation dependancy dropdown logic start
        $('#level').on('change',function(event){
            event.preventDefault();
            var selectedLevel = $('#level').val();

            if (selectedLevel == '') {
                    $('#designation_id').html('');
                    return false;
                }
            // Function to get CSRF token from meta tag
            function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }
            // Set up Axios defaults
            axios.defaults.withCredentials = true;
            axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

            axios.post('/level.designation.dependancy',{
                            data: selectedLevel
                        }).then(response=>{
                        $('#designation_id').html(response.data);
                            console.log(response.data);
                        });

            });
            //level and designation dependancy dropdown logic end


            //branch and department dependancy dropdown logic start
            $('#branch_id').on('change',function(event){
                event.preventDefault();
                var selectedBranch = $('#branch_id').val();

                if (selectedBranch == '') {
                        $('#department_id').html('');
                        return false;
                    }
                // Function to get CSRF token from meta tag
                function getCsrfToken() {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                }
                // Set up Axios defaults
                axios.defaults.withCredentials = true;
                axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

                axios.post('/branch.department.dependancy',{
                                data: selectedBranch
                            }).then(response=>{
                            $('#department_id').html(response.data);
                                console.log(response.data);
                            });

                });
            //branch and department dependancy dropdown logic end
    })

    </script>
@endpush
