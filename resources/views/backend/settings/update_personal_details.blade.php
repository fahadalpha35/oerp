@extends('backend.layout.layout')

@section('content')
<div class="container">
    <br><br><br>
    <h2>Personal Details</h2>
    <br>
    <form action="" method="POST">
        @csrf
        <div class="mb-3 form-group">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $personalDetails->user_full_name }}">
        </div>

        <div class="mb-3 form-group">
            <label for="father_name" class="form-label">Father Name</label>
            <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name') }}">
        </div>

        <div class="mb-3 form-group">
            <label for="mother_name" class="form-label">Mother Name</label>
            <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{ old('mother_name') }}">
        </div>

        <div class="mb-3 form-group">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}">
        </div>

        <div class="mb-3 form-group">
            <label for="nid_number" class="form-label">NID Number</label>
            <input type="text" class="form-control" id="nid_number" name="nid_number" value="{{ old('nid_number') }}">
        </div>

        <div class="mb-3 form-group">
            <label for="present_address" class="form-label">Present Address</label>
            <textarea class="form-control" id="present_address" name="present_address">{{ old('present_address') }}</textarea>
        </div>

        <div class="mb-3 form-group">
            <label for="permanent_address" class="form-label">Permanent Address</label>
            <textarea class="form-control" id="permanent_address" name="permanent_address">{{ old('permanent_address') }}</textarea>
        </div>

        <div class="mb-3 form-group">
            <label for="birth_date" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
        </div>

        <div class="form-group">
            <label for="blood_group" class="form-label">Blood Group</label>
            <select class="form-control select2" id="blood_group" name="blood_group" style="width: 100%;">
                <option value="A+">A+</option>
                <option value="B+">B+</option>                                
                <option value="AB+">AB+</option>                                
                <option value="O+">O+</option>                            
                <option value="A-">A-</option>
                <option value="B-">B-</option>                                
                <option value="AB-">AB-</option>                                
                <option value="O-">O-</option>   
            </select>
        </div>
        
        <div class="mb-3 form-group">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality') }}">
        </div>

        <div class="form-group">
            <label for="marital_status" class="form-label">Marital Status</label>
            <select class="form-control select2" id="marital_status" name="marital_status" style="width: 100%;">
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>  
            </select>
        </div>

        <div class="mb-3 form-group">
            <label for="religion" class="form-label">Religion</label>
            <input type="text" class="form-control" id="religion" name="religion" value="{{ old('religion') }}">
        </div>


        <div class="form-group">
            <label for="marital_status" class="form-label">Gender</label>
            <select class="form-control select2" id="gender" name="gender" style="width: 100%;">
                <option value="Male"> Male</option>
                <option value="Female">Female</option>   
            </select>
        </div>

       
        <div class="card">
            <div class="card-header">
              Emergency Contact Person Information
            </div>
          <div class="card-body">
            <div class="row">
              <h2>1.</h2>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Name <small style="color: red">*</small></label>
                  <input type="text" required  class="form-control" id="emergency_contact_name_one" name="emergency_contact_name_one" value="{{old('emergency_contact_name_one')}}">
                </div>
              </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label>Number <small style="color: red">*</small></label>
                <input type="text" required class="form-control" id="emergency_contact_number_one" name="emergency_contact_number_one" value="{{old('emergency_contact_number_one')}}">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label>Relation <small style="color: red">*</small></label>
                <input type="text" required class="form-control" id="emergency_contact_relation_one" name="emergency_contact_relation_one" value="{{old('emergency_contact_relation_one')}}">
              </div>
            </div>
           </div>
           <div class="row">
            <h2>2.</h2>
          </div>
           <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label>Name <small style="color: red">*</small></label>
                <input type="text" required  class="form-control" id="emergency_contact_name_two" name="emergency_contact_name_two" value="{{old('emergency_contact_name_two')}}">
              </div>
            </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Number <small style="color: red">*</small></label>
              <input type="text" required class="form-control" id="emergency_contact_number_two" name="emergency_contact_number_two" value="{{old('emergency_contact_number_two')}}">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Relation <small style="color: red">*</small></label>
              <input type="text" required class="form-control" id="emergency_contact_relation_two" name="emergency_contact_relation_two" value="{{old('emergency_contact_relation_two')}}">
            </div>
          </div>
         </div>
         <div class="row">
          <h2>3.</h2>
        </div>
         <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" id="emergency_contact_name_three" name="emergency_contact_name_three" value="{{old('emergency_contact_name_three')}}">
            </div>
          </div>
        <div class="col-md-4 col-sm-12">
          <div class="form-group">
            <label>Number</label>
            <input type="text" class="form-control" id="emergency_contact_number_three" name="emergency_contact_number_three" value="{{old('emergency_contact_number_three')}}">
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="form-group">
            <label>Relation</label>
            <input type="text" class="form-control" id="emergency_contact_relation_three" name="emergency_contact_relation_three" value="{{old('emergency_contact_relation_three')}}">
          </div>
        </div>
       </div>

          </div>
          </div>

        <button type="submit" class="btn btn-primary">Create</button><br><br><br>
    </form>
</div>
@endsection
