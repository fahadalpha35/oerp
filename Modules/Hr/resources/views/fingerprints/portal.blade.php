@extends('backend.layout.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <br>  
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">FingerPrint Device Settings</h3>
              </div>
              <div class="card-body">
                <div class="col-md-12 col-sm-12 grid-margin transparent">                 
                  <div class="row">
                      <div class="col-md-6 col-sm-12 mb-4 mb-lg-0 stretch-card transparent">
                          <div class="card card-tale" style="background-color: #bf79ff">
                              <div class="card-body">
                                  <p class="mb-4"><i class="fa-solid fa-pen-to-square fa-2x"></i></p>
                                  <h3 class="mb-2">Set IP</h3>
                                  <br>
                                  <a href="{{route('set_fingerprint_device_ip')}}" class="small-box-footer" style="color: white">Click here</a>
                                  
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-12 stretch-card transparent">
                          <div class="card card-light-danger" style="background-color: #7fff87">
                              <div class="card-body">
                                  <p class="mb-4"><i class="fa-solid fa-user fa-2x"></i></p>
                                  <h3 class="mb-2">Add User</h3>
                                  <br>
                                  <a href="{{route('add_fingerprint_user')}}" class="small-box-footer" style="color: white">Click here</a>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-sm-12 mt-2 stretch-card transparent">
                        <div class="card card-light-danger" style="background-color: #87affd">
                            <div class="card-body">
                                <p class="mb-4"><i class="fa-solid fa-calendar-week fa-2x"></i></p>
                                <h3 class="mb-2">Today Attendances</h3>
                                <br>
                                <a href="{{route('system_fingerprint_attendances_today')}}" class="small-box-footer" style="color: white">Click here</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 mt-2 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4"><i class="fa-solid fa-list fa-2x"></i></p>
                                <h3 class="mb-2">Attendance List</h3>
                                <br>
                                <a href="{{route('system_attendances')}}" class="small-box-footer" style="color: white">Click here</a>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              
              </div>
        </div>    
          
     
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>

@endsection
