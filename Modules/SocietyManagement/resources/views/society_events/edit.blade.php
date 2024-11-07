@extends('backend.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('society_events.index')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <br>
                    <h3 class="mt-2 text-center">Edit Committee Member</h3>
                    <br>
                    <div class="card">
                        <div class="card-body">
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
                            <br>
                                 
                    <form action="{{route('society_events.update',$event->id)}}" method="POST">
                        @csrf
                        @method('PUT')            
                        <div class="row">

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Event Name <small style="color: red">*</small></label>
                                    <input type="text" required id="event_name" name="event_name" value="{{$event->event_name}}" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Budget (BDT) <small style="color: red">*</small></label>
                                    <input type="number" step="0.01" required id="event_budget" name="event_budget" value="{{$event->event_budget}}" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Organized By <small style="color: red">*</small></label>
                                    <select required class="form-control select2" id="committee_id" name="committee_id" style="width: 100%;">
                                     <option value="{{$event->committee_id}}">{{$event->committee_name}}</option>
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
                                            <input type="date" required id="event_start_date" name="event_start_date" value="{{$event->event_start_date}}" class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div  class="form-group mb-4">
                                            <label>Event Start Time <small style="color: red">*</small></label>
                                            <input type="time" required id="event_start_time" name="event_start_time" value="{{$event->event_start_time}}" class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                </div>                                   
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div  class="form-group mb-4">
                                                <label>Event End Date</label>
                                                <input type="date" id="event_end_date" name="event_end_date" value="{{$event->event_end_date}}" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div  class="form-group mb-4">
                                                <label>Event End Time</label>
                                                <input type="time" id="event_end_time" name="event_end_time" value="{{$event->event_end_time}}" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Event Location <small style="color: red">*</small></label>
                                        <textarea name="event_loaction" id="event_loaction" class="form-control">{{$event->event_loaction}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Event Description </label>
                                        <textarea name="event_description" id="event_description" class="form-control">{{$event->event_description}}</textarea>
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Status <small style="color: red">*</small></label>
                                        <select  class="form-control select2" required id="event_status" name="event_status" style="width: 100%;">
                                         <option value="{{$event->event_status}}">
                                            @if($event->event_status == 1)
                                            Upcoming
                                            @elseif($event->event_status == 2)
                                            Ongoing
                                            @else
                                            Completed
                                            @endif
                                         </option>
                                          <option value="1">Upcoming</option>
                                          <option value="2">Ongoing</option>
                                          <option value="3">Completed</option>
                                      </select>
                                      </div>
                                </div>
                          </div>        
                        <button type="submit" class="btn btn-primary float-right">Update</button><br><br><br>
                    </form>
                        </div>
                    </div>
               
                </div>
            </div>
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
