@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('committee_members.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Committee Member</h3>
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
                            <form action="{{route('committee_members.store')}}" method="POST">
                                @csrf
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Committee Name <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="committee_id" name="committee_id" style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($committees as $committee)
                                            <option value="{{$committee->id}}">{{$committee->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Member <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="member_id" name="member_id" style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($society_members as $society_member)
                                            <option value="{{$society_member->id}}">{{$society_member->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                              
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Designation <small style="color: red">*</small></label>
                                        <input type="text" required  id="committee_member_designation" name="committee_member_designation" value="{{old('committee_member_designation')}}" class="form-control form-control-lg" />
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
