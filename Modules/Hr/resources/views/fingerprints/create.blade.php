@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('fingerprint_portal')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Device User</h3>
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
                            <form id="addUserFingerPrintForm">
                                <div class="row">
        
                                    <div class="col-md-12 col-sm-12">
                                      <div class="form-group mb-4">
                                          <label>Admin/Employee <small style="color: red">*</small></label>
                                          <select required class="form-control select2" id="system_user_id" name="system_user_id" style="width: 100%;">
                                          <option value="">Select</option>                              
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option> 
                                            @endforeach                           
                                        </select>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>UID <small style="color: red">*</small></label>
                                            <input type="number" required id="uid" name="uid" class="form-control form-control-lg" />
                                        </div> 
                                    </div> 
        
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>User ID <small style="color: red">*</small></label>
                                            <input type="number" required id="machine_user_id" name="machine_user_id" class="form-control form-control-lg" />
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Role ID <small style="color: red">*</small></label>
                                            <input type="number" required id="role_id" name="role_id" class="form-control form-control-lg" />
                                        </div> 
                                    </div>
        
                                    <div class="col-md-12 col-sm-12">
                                        <div  class="form-group mb-4">
                                            <label>Password <small style="color: red">*</small></label>
                                            <input type="password" required id="password" name="password" class="form-control form-control-lg" />
                                        </div> 
                                    </div>
        
                                    <div class="col-md-12 col-sm-12">
                                        <div  class="form-group mb-4">
                                            <label>Card Number <small style="color: red">*</small></label>
                                            <input type="number" id="card_no" name="card_no" class="form-control form-control-lg" />
                                        </div> 
                                    </div>
                                                     
                                  </div>
                                  <button type="submit" class="btn btn-success float-right">Submit</button>
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
$.noConflict();
jQuery(document).ready(function($) {
    $('.select2').select2();
})

document.getElementById('addUserFingerPrintForm').addEventListener('submit',function(event){
  event.preventDefault();

    var addUserFingerPrintFormData = new FormData(this);

    var user_passoword = document.getElementById('password').value;  
      if(user_passoword.length > 8){
        Swal.fire({
              icon: "warning",
              title: "Password must be equal or less than 8 characters",
            });
        return false;
      }

      var machine_user_id = document.getElementById('machine_user_id').value;  
      if(machine_user_id.length > 9){
        Swal.fire({
              icon: "warning",
              title: "User ID must be equal or less than 9 characters",
            });
        return false;
      }


      var card_no = document.getElementById('card_no').value;  
      if(card_no.length > 10){
        Swal.fire({
              icon: "warning",
              title: "Card Number must be equal or less than 10 characters",
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


axios.get('sanctum/csrf-cookie').then(response=>{
axios.post('/user_fingerprint_data_store ',addUserFingerPrintFormData).then(response=>{
  console.log(response);
 window.location.reload();
  Swal.fire({
              icon: "success",
              title: ''+ response.data.message,
            });
        return false;
        
  }).catch(error => Swal.fire({
              icon: "error",
              title: error.response.data.message,
              }))
 });

});

</script>
@endpush
