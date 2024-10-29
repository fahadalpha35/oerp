@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('branches.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Branch</h3>
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
                          <form action="{{route('branches.store')}}" method="POST">
                            @csrf
                          <div class="row">
                              <div class="col-md-12 col-sm-12">
                                  <div  class="form-group mb-4">
                                      <label>Branch Name <small style="color: red">*</small></label>
                                      <input type="text" required placeholder="Branch Name" id="br_name" name="br_name" class="form-control form-control-lg" />
                                  </div>
                              </div>

                              <div class="col-md-12 col-sm-12">
                              <div  class="form-group mb-4">
                                  <label>Branch Address <small style="color: red">*</small></label>
                                  <textarea name="br_address" required id="br_address"  class="form-control form-control-lg summernote"></textarea>
                              </div>
                              </div>

                              <div class="col-md-12 col-sm-12">
                              <div  class="form-group mb-4">
                                  <label for="password">Branch Type <small style="color: red">*</small></label>
                                  <select class="form-control select2" required id="br_type" name="br_type" style="width: 100%;">
                                      <option selected="selected" value="1">Head Office</option>
                                      <option value="2">Single Branch</option>
                                  </select>
                              </div>
                              </div>

                              <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Branch Status <small style="color: red">*</small></label>
                                    <select required class="form-control select2" id="br_status" name="br_status" style="width: 100%;">
                                      <option value="1">Active</option>
                                      <option value="2">Inactive</option>
                                  </select>
                                  </div>
                                </div>
                            </div>

                            <br>
                          <h4>Set Office Geolocation</h4>
                          <div class="row" id="locationDisplay">
                              <div class="col-md-5 col-sm-12">
                                <div class="form-group ">
                                  <label>Latitude <small style="color: red">*</small></label>
                                  <input readonly required type="text" id="currentLat" name="latitude" class="form-control">
                                </div> 
                              </div>

                              <div class="col-md-5 col-sm-12">
                                <div class="form-group ">
                                  <label>Longitude <small style="color: red">*</small></label>
                                  <input readonly required type="text" id="currentLon" name="longitude" class="form-control">
                                </div> 
                              </div>
                              
                              <div class="col-md-2 col-sm-12">
                                <div class="form-group mb-4">
                              <button type="button" id="getLocationBtn" class="btn btn-primary mt-4">Get Current Location</button>
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
$.noConflict(); // Ensures jQuery does not conflict with other libraries
jQuery(document).ready(function($) {
    $('.select2').select2();
})

document.getElementById('getLocationBtn').addEventListener('click', function() {

if (navigator.geolocation) {
  // alert('hi');
  navigator.geolocation.getCurrentPosition(function(position) {
    let latitude = position.coords.latitude;
    let longitude = position.coords.longitude;

    // Update the span content with latitude and longitude
    // document.getElementById('currentLat').textContent = "Latitude: " + latitude;
    // document.getElementById('currentLon').textContent = "Longitude: " + longitude;

    document.getElementById('currentLat').value = latitude;
    document.getElementById('currentLon').value = longitude;

}, function(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
});
} else {
alert("Geolocation is not supported by this browser.");
}

});

</script>
@endpush
