@extends('backend.layout.layout')
@push('css')
<style>
    /* Optional: Hide the print button when printing */
    @media print {
        #print-button {
            display: none;
        }
    }
</style>
@endpush
@section('content')
    <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
             
              <div class="col-12">
                <h3 class="mt-2 text-center">Budget v/s Collected Fund</h3>
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
                            <div class="row">
                                <select required  class="form-control select2" id="event_id" name="event_id" style="width: 100%;">
                                    <option value="">Select Event</option>
                                    @foreach($events as $event)
                                     <option value="{{$event->id}}">{{$event->event_name}}</option>
                                     @endforeach
                                 </select>
                            </div>
                            <br>

                            
                            <!-- print section (start) -->
                            <div id="print-section">
                                <h4 style="text-align: center">Budget v/s Collected Fund Report</h4>
                                <div class="row"> 
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                    <h6 style="color: green"><strong>Report Generation Date:</strong> {{ \Carbon\Carbon::now()->format('F j, Y') }}</h6>
                                    </div>
                                </div>
                              
                                    <div class="col-md-12 col-sm-12">
                                        <div  class="form-group mb-4">
                                            <label>Event Name:</label>&nbsp;<span id="event_name" style="color: blue"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div  class="form-group mb-4">
                                            <label>Budget (BDT):</label>&nbsp;<span id="budget" style="color: blue"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div  class="form-group mb-4">
                                            <label>Collected Fund (BDT):</label>&nbsp;<span id="collected_fund" style="color: blue"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div  class="form-group mb-4">
                                            <label>Remaining Amount (BDT):</label>&nbsp;<span id="remaining_amount" style="color: blue"></span>
                                        </div>
                                    </div>
                                </div>
                         </div>
                        <!-- print section (end) -->
                    
                     <br>
                <!-- Print Button -->
                <button id="print-button" class="btn btn-danger float-right">Print Report</button>
                <br>                             
                              
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

    //event dependancy dropdown logic start
    $('#event_id').on('change',function(event){
        event.preventDefault();
        var selectedEvent = $('#event_id').val();

        if (selectedEvent == '') {
                $('#budget').html('');
                $('#collected_fund').html('');
                $('#remaining_amount').html('');
                return false;
            }
        // Function to get CSRF token from meta tag
        function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
        // Set up Axios defaults
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

        axios.post('/budget.fund.dependancy',{
                        data: selectedEvent
                    }).then(response=>{
                        $('#event_name').html(response.data.event_name);
                        $('#budget').html(response.data.event_budget);
                        $('#collected_fund').html(response.data.collected_fund);
                        $('#remaining_amount').html(response.data.remaining_amount);
                        console.log(response.data);
                    });

        });
    //event dependancy dropdown logic end


    $('#print-button').click(function(){
    // Trigger print for the specified section
    var printContents = $('#print-section').html();
    var originalContents = $('body').html();

    $('body').html(printContents);
    window.print();
    $('body').html(originalContents);
    });


})

</script>
@endpush
