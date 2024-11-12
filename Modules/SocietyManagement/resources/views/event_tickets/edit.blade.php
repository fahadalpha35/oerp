@extends('backend.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('event_tickets.index')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <br>
                    <h3 class="mt-2 text-center">Edit Ticket Details</h3>
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
                                 
                    <form action="{{route('event_tickets.update',$ticket->id)}}" method="POST">
                        @csrf
                        @method('PUT')            
                        <div class="row">

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Event <small style="color: red">*</small></label>
                                    <select required class="form-control select2" id="event_id" name="event_id" style="width: 100%;">
                                     <option value="{{$ticket->event_id}}">{{$ticket->society_event_name}}</option>
                                     @foreach($events as $event)
                                      <option value="{{$event->id}}">{{$event->event_name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Ticket Type <small style="color: red">*</small></label>
                                    <select required class="form-control select2" id="ticket_type" name="ticket_type" style="width: 100%;">
                                        <option value="{{$ticket->ticket_type}}">
                                            @if($ticket->ticket_type == 1)
                                            Regular
                                            @else
                                            VIP
                                            @endif
                                        </option>
                                        <option value="1">Regular</option>
                                        <option value="2">VIP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Ticket Price (BDT) <small style="color: red">*</small></label>
                                    <input type="number" step="0.01" required id="ticket_price" name="ticket_price" value="{{$ticket->ticket_price}}" class="form-control form-control-lg" />
                                </div>
                            </div> 
                            
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Ticket Quantity <small style="color: red">*</small></label>
                                    <input type="number" required id="ticket_quantity" name="ticket_quantity" value="{{$ticket->ticket_quantity}}" class="form-control form-control-lg" />
                                </div>
                            </div>  

                            
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Ticket Status <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="ticket_status" name="ticket_status" style="width: 100%;">
                                            <option value="{{$ticket->ticket_status}}">
                                                @if($ticket->ticket_status == 1)
                                                Available
                                                @else
                                                Not Available
                                                @endif
                                            </option>
                                            <option value="1">Available</option>
                                            <option value="2">Not Available</option>
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
