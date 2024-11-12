@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('sold_event_tickets.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Event Ticket</h3>
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
                            <form action="{{route('sold_event_tickets.store')}}" method="POST">
                                @csrf
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Ticket Selling Date <small style="color: red">*</small></label>
                                        <input type="date" required id="ticket_selling_date" name="ticket_selling_date" value="{{old('ticket_selling_date')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Event <small style="color: red">*</small></label>
                                        <select required  class="form-control select2" id="event_id" name="event_id" style="width: 100%;">
                                         <option value="">Select Event</option>
                                         @foreach($events as $event)
                                          <option value="{{$event->id}}">{{$event->event_name}}</option>
                                          @endforeach
                                      </select>
                                      </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Ticket Type <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="ticket_id" name="ticket_id" style="width: 100%;">
                                            <option value="" >Select Ticket</option>
                                      </select>
                                    </div>
                                </div> 
                                
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Ticket Price (BDT):</label>&nbsp;<span id="selected_ticket_price" style="color: blue"></span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Available Ticket Quantity:</label>&nbsp;<span id="selected_ticket_available_quantity" style="color: green"></span>
                                    </div>
                                </div>
                                                             
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Ticket Quantity <small style="color: red">*</small></label>
                                        <input type="number" required id="sold_ticket_quantity" name="sold_ticket_quantity" value="{{old('sold_ticket_quantity')}}" class="form-control form-control-lg" />
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

      //event and ticket dependancy dropdown logic start
      $('#event_id').on('change',function(event){
        event.preventDefault();
        var selectedEvent = $('#event_id').val();

        if (selectedEvent == '') {
                $('#ticket_id').html('');
                return false;
            }
        // Function to get CSRF token from meta tag
        function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
        // Set up Axios defaults
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

        axios.post('/event.ticket.dependancy',{
                        data: selectedEvent
                    }).then(response=>{
                    $('#ticket_id').html(response.data);
                        console.log(response.data);
                    });

        });
    //event and ticket dependancy dropdown logic end


    //ticket type and ticket price dependancy dropdown logic start
    $('#ticket_id').on('change',function(event){
        event.preventDefault();
        var selectedTicket = $('#ticket_id').val();

        if (selectedTicket == '') {
                $('#selected_ticket_price').html('');
                $('#selected_ticket_available_quantity').html('');
                return false;
            }
        // Function to get CSRF token from meta tag
        function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
        // Set up Axios defaults
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

        axios.post('/ticket.price.dependancy',{
                        data: selectedTicket
                    }).then(response=>{
                        $('#selected_ticket_price').html(response.data.ticket_price);
                        $('#selected_ticket_available_quantity').html(response.data.ticket_available_quantity);
                        console.log(response.data);
                    });

        });
    //ticket Type and ticket price dependancy dropdown logic end

})

  
</script>
@endpush
