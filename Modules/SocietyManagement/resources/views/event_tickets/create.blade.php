@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('event_tickets.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Add Event Ticket</h3>
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
                            <form action="{{route('event_tickets.store')}}" method="POST">
                                @csrf
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Event <small style="color: red">*</small></label>
                                        <select required  class="form-control select2" id="event_id" name="event_id" style="width: 100%;">
                                         @foreach($events as $event)
                                          <option value="{{$event->id}}">{{$event->event_name}}</option>
                                          @endforeach
                                      </select>
                                      </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Ticket Type <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="ticket_type" name="ticket_type" style="width: 100%;">
                                          <option value="1">Regular</option>
                                          <option value="2">VIP</option>
                                      </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Ticket Price (BDT) <small style="color: red">*</small></label>
                                        <input type="number" step="0.01" required id="ticket_price" name="ticket_price" value="{{old('ticket_price')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Ticket Quantity <small style="color: red">*</small></label>
                                        <input type="number" required id="ticket_quantity" name="ticket_quantity" value="{{old('ticket_quantity')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Ticket Status <small style="color: red">*</small></label>
                                        <select required  class="form-control select2" id="ticket_status" name="ticket_status" style="width: 100%;">
                                          <option value="1">Available</option>
                                          <option value="2">Not Available</option>
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
