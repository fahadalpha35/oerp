@extends('backend.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">

            <div class="col-12">
              <a class="btn btn-outline-info float-right" href="{{route('leave_types.index')}}">
                  <i class="fas fa-arrow-left"></i> Back
              </a>
            </div>
               
            <div class="col-12">
              <h3 class="mt-2 text-center">Add Leave Type</h3>
              <br>
                <div class="card">
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
                        <form action="{{route('leave_types.store')}}" method="POST">
                          @csrf                            
                            <div class="form-group mb-4">
                              <label >Type Name</label>
                              <input type="text" required class="form-control" id="type_name" name="type_name" >
                            </div> 
                          <button type="submit" class="btn btn-info float-right mr-4">Submit</button>
                        </form>
                    </div>
                  </div>
            </div>           
        </div>      
        <br>
         
      </div>
    </div>
  </div>

@endsection
