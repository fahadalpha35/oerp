@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('society_members.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Member</h3>
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
                            <form action="{{route('society_members.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Image </label>
                                        <input type="file" class="form-control" id="member_image" name="member_image">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Full Name <small style="color: red">*</small></label>
                                        <input type="text" required placeholder="Full Name" id="name" name="name" value="{{old('name')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Email</label>
                                        <input type="email" placeholder="" id="email" name="email"  class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Contact Number <small style="color: red">*</small></label>
                                        <input type="text" required placeholder="ex. 01513470120" id="contact_number" name="contact_number" value="{{old('contact_number')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Present Address <small style="color: red">*</small></label>
                                        <textarea name="address" id="address" class="form-control">{{old('address')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Permanent Address <small style="color: red">*</small></label>
                                        <textarea name="permanent_address" id="permanent_address" class="form-control">{{old('permanent_address')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Joining Date <small style="color: red">*</small></label>
                                        <input type="date" required  id="joining_date" name="joining_date" value="{{old('joining_date')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Expiration Date </label>
                                        <input type="date"  id="expiration_date" name="expiration_date" value="{{old('expiration_date')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Membership Fee </label>
                                        <input type="number" id="membership_fee" name="membership_fee" value="{{old('membership_fee')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Membership Type <small style="color: red">*</small></label>
                                        <select  class="form-control select2" id="membership_type" name="membership_type" style="width: 100%;">
                                          <option value="">Select Type</option>
                                          <option value="1">Regular</option>
                                          <option value="2">Premium</option>
                                          <option value="2">Honorary</option>
                                      </select>
                                      </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Active Status <small style="color: red">*</small></label>
                                        <select  class="form-control select2" id="active_status" name="active_status" style="width: 100%;">
                                          <option value="1">Active</option>
                                          <option value="2">Inactive</option>
                                      </select>
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
</script>
@endpush
