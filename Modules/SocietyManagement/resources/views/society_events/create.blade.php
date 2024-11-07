@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('society_events.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Event</h3>
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
                            <form action="{{route('society_events.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="row">
                            
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Event Name <small style="color: red">*</small></label>
                                        <input type="text" required placeholder="Event Name" id="event_name" name="event_name" value="{{old('event_name')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Budget (BDT) <small style="color: red">*</small></label>
                                        <input type="number" step="0.01" required id="event_budget" name="event_budget" value="{{old('event_budget')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Organized By <small style="color: red">*</small></label>
                                        <select  class="form-control select2" id="committee_id" name="committee_id" style="width: 100%;">
                                          <option value="">Select Committee</option>
                                          @foreach($committees as $committee)
                                          <option value="{{$committee->id}}">{{$committee->name}}</option>
                                          @endforeach
                                      </select>
                                      </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div  class="form-group mb-4">
                                                <label>Event Start Date <small style="color: red">*</small></label>
                                                <input type="date" required id="event_start_date" name="event_start_date" value="{{old('event_start_date')}}" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div  class="form-group mb-4">
                                                <label>Event Start Time <small style="color: red">*</small></label>
                                                <input type="time" required id="event_start_time" name="event_start_time" value="{{old('event_start_time')}}" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div  class="form-group mb-4">
                                                <label>Event End Date</label>
                                                <input type="date" placeholder="" id="event_end_date" name="event_end_date" value="{{old('event_end_date')}}" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div  class="form-group mb-4">
                                                <label>Event End Time</label>
                                                <input type="time" placeholder="" id="event_end_time" name="event_end_time" value="{{old('event_end_time')}}" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Event Location <small style="color: red">*</small></label>
                                        <textarea name="event_loaction" id="event_loaction" class="form-control">{{old('event_loaction')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Event Description </label>
                                        <textarea name="event_description" id="event_description" class="form-control">{{old('event_description')}}</textarea>
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Status <small style="color: red">*</small></label>
                                        <select  class="form-control select2" required id="event_status" name="event_status" style="width: 100%;">
                                          <option value="1">Upcoming</option>
                                          <option value="2">Ongoing</option>
                                          <option value="3">Completed</option>
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
    flatpickr("#event_start_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K",  // 24-hour format, you can change to "h:i K" for 12-hour format with AM/PM
            time_24hr: false     // Set to false for AM/PM format
        });

    flatpickr("#event_end_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K",  // 12-hour format with AM/PM
            time_24hr: false       // Set to false for AM/PM format
});
})
</script>
@endpush
