@extends('backend.layout.layout')
@section('content') 
<div class="main-panel">
    <div class="content-wrapper">
      
         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('employees.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>         
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Employee</h3>
                  <br>
                  <div class="card">
                      {{-- <div class="card-header">
                          <h3 class="card-title">Add Branch</h3>
                        </div> --}}
                        <div class="card-body">
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
                            <form action="{{ route('employees.store') }}" method="POST">
                                @csrf
                                    <!-- Name input -->
                                    <div class="form-group mb-4">
                                    <label for="Name">Full Name <small style="color: red">*</small></label>
                                    <input type="text"  placeholder="Full Name" id="name" name="name" value="{{ old('name') }}" class="form-control form-control-lg" />
                                </div> 
                    
                                <!-- Email input -->
                                <div  class="form-group mb-4">
                                    <label for="Email">Email <small style="color: red">*</small></label>
                                    <input type="email"   placeholder="Email" id="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" />
                                </div> 
                    
                                <!-- Password input -->
                                <div  class="form-group mb-4">
                                    <label >Password <small style="color: red">*</small></label>
                                    <input type="password"   placeholder="Password" onkeyup="typePassword()" id="password" name="password" class="form-control form-control-lg" />
                                </div>
                    
                                <!-- Cofirm password input -->
                                <div  class="form-group mb-4">
                                    <label >Confirm Password <small style="color: red">*</small></label>
                                    <input type="password"  placeholder="Confirm Password" onkeyup="machPassword()"  id="confirm_password" name="password_confirmation" class="form-control form-control-lg" />
                                    <p id="message"></p>
                                    @error('password_confirmation')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Joining Date -->
                                <div  class="form-group mb-4">
                                    <label >Joining Date <small style="color: red">*</small></label>
                                    <input type="date"   id="joining_date" name="joining_date" value="{{ old('joining_date') }}" class="form-control form-control-lg" />
                                </div>
                                            
                                <!-- Monthly Salary -->
                                <div  class="form-group mb-4">
                                    <label >Monthly Salary <small style="color: red">*</small></label>
                                <input type="number"  step="0.01"  id="monthly_salary" name="monthly_salary" value="{{ old('monthly_salary') }}" class="form-control form-control-lg" />
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
                                        <option value="" >Select Designation</option>                                                            
                                        </select>
                                    </div>
                                </div>
                                    
                                <div class="col-md-6 col-sm-12">
                                    <!-- Branch select -->
                                    <div  class="form-group mb-4">
                                        <label >Branch <small style="color: red">*</small></label>
                                        <select  class="form-control select2" id="branch_id" name="branch_id" style="width: 100%;">
                                            <option selected="selected" value="">Select Branch</option>
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
                                            <option value="" >Select Department</option>                                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>                                                     
                                <button type="submit" class="btn btn-primary float-right">Submit</button><br>
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
    @include('backend.layout.footer')
</div>
@endsection


@push('masterScripts')

<script>
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
