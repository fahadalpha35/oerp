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
                <h3 class="card-title">Application Submission Types</h3>
              </div>
              <div class="card-body">
                <div class="col-md-12 col-sm-12 grid-margin transparent">                 
                  <div class="row">
                      <div class="col-md-6 col-sm-12 mb-4 mb-lg-0 stretch-card transparent">
                          <div class="card card-tale">
                              <div class="card-body">
                                  <p class="mb-4"><i class="fa-solid fa-paperclip fa-2x"></i></p>
                                  <p class="fs-30 mb-2">File Attachment</p>
                                  <br>
                                  <a href="{{route('leave_application_file_attachment')}}" class="small-box-footer" style="color: white">Click here</a>
                                  
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-12 stretch-card transparent">
                          <div class="card card-light-danger">
                              <div class="card-body">
                                  <p class="mb-4"><i class="fa-solid fa-pen-to-square fa-2x"></i></p>
                                  <p class="fs-30 mb-2">Application Form Fillup</p>
                                  <br>
                                  <a href="{{route('leave_application_form_fillup')}}" class="small-box-footer" style="color: white">Click here</a>
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
