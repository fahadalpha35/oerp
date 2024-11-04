@extends('backend.layout.layout')

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('society_members.index')}}">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="col-12">
            <h3 class="mt-2 text-center">Edit Member Details</h3>
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
            <br>
            <form action="{{route('society_members.update',$member->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-12 col-sm-12">
                <div class="mb-3 form-group">
                  <img src="{{asset('/backend/images/'. $member->member_image)}}" alt="&nbsp;no preview&nbsp;" height="auto" width="150px" style="border: 2px solid #000;">
                </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Image </label>
                  <input type="file" class="form-control" id="member_image" name="member_image">
                </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                    <div  class="form-group mb-4">
                        <label>Full Name <small style="color: red">*</small></label>
                        <input type="text" required placeholder="Full Name" id="name" name="name" value="{{$member->name}}" class="form-control form-control-lg" />
                    </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                    <div  class="form-group mb-4">
                        <label>Designation <small style="color: red">*</small></label>
                        <input type="text" required placeholder="Example : General Secretary" id="designation" name="designation" value="{{$member->designation}}" class="form-control form-control-lg" />
                    </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                    <div  class="form-group mb-4">
                        <label>Email</label>
                        <input type="email" placeholder="" id="email" name="email" value="{{$member->email}}"  class="form-control form-control-lg" />
                    </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                    <div  class="form-group mb-4">
                        <label>Contact Number <small style="color: red">*</small></label>
                        <input type="text" required placeholder="ex. 01513470120" id="contact_number" name="contact_number" value="{{$member->contact_number}}" class="form-control form-control-lg" />
                    </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                    <div  class="form-group mb-4">
                        <label>Present Address <small style="color: red">*</small></label>
                        <textarea name="address" id="address" class="form-control">{{$member->address}}</textarea>
                    </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                    <div  class="form-group mb-4">
                        <label>Permanent Address <small style="color: red">*</small></label>
                        <textarea name="permanent_address" id="permanent_address" class="form-control">{{$member->permanent_address}}</textarea>
                    </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                    <div  class="form-group mb-4">
                        <label>Joining Date <small style="color: red">*</small></label>
                        <input type="date" required  id="joining_date" name="joining_date" value="{{$member->joining_date}}" class="form-control form-control-lg" />
                    </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                    <div  class="form-group mb-4">
                        <label>Expiration Date </label>
                        <input type="date"  id="expiration_date" name="expiration_date" value="{{$member->expiration_date}}" class="form-control form-control-lg" />
                    </div>
                </div>
        
                <div class="col-md-12 col-sm-12">
                    <div  class="form-group mb-4">
                        <label>Membership Fee </label>
                        <input type="number" id="membership_fee" name="membership_fee" value="{{$member->membership_fee}}" class="form-control form-control-lg" />
                    </div>
                </div>
        
        
                <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-4">
                        <label>Membership Type <small style="color: red">*</small></label>
                        <select  class="form-control select2" id="membership_type" name="membership_type" style="width: 100%;">
                        <option value="{{$member->membership_type}}">
                            @if($member->membership_type == 1)
                            Regular
                            @elseif($member->membership_type == 2)
                            Premium
                            @else
                            Honorary
                            @endif
                        </option>
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
                            <option value="{{$member->active_status}}">
                                @if($member->active_status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </option>
                          <option value="1">Active</option>
                          <option value="2">Inactive</option>
                      </select>
                      </div>
                </div>
        
        
                <button type="submit" class="btn btn-primary float-right">Update</button><br><br><br>
            </form>
        </div>
    </div>
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
