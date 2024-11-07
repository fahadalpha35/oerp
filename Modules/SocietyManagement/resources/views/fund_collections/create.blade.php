@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('fund_collections.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Collect Fund</h3>
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
                            <form action="{{route('fund_collections.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Fund Collection For <small style="color: red">*</small></label>
                                        <select  class="form-control select2" required id="purpose" name="purpose" style="width: 100%;">
                                          <option value="">Select</option>
                                          <option value="1">Event</option>
                                          <option value="2">Others</option>
                                      </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12" id="event-container" style="display: none;">
                                    <div  class="form-group mb-4">
                                      <label>Event Name</label>
                                        <select class="form-control select2" id="event_id" name="event_id" style="width: 100%;">
                                            <option value="">Select Event</option>
                                            @foreach($events as $event)
                                            <option value="{{$event->id}}">{{$event->event_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                      <label>Member <small style="color: red">*</small></label>
                                        <select  class="form-control select2" id="society_member_id" name="society_member_id" style="width: 100%;">
                                            <option value="">Select Member</option>
                                            @foreach($members as $member)
                                            <option value="{{$member->id}}">{{$member->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12" id="description-container" style="display: none;">
                                    <div  class="form-group mb-4">
                                        <label>Fund Collection Reason</label>
                                        <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Fund Amount (BDT) <small style="color: red">*</small></label>
                                        <input type="number" step="0.01" required id="fund_amount" name="fund_amount" value="{{old('fund_amount')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Fund Collection Date <small style="color: red">*</small></label>
                                        <input type="date" required id="fund_collection_date" name="fund_collection_date" value="{{old('fund_collection_date')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Status <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="fund_collection_status" name="fund_collection_status" style="width: 100%;">
                                          <option value="1">Pending</option>
                                          <option value="2">Collected</option>
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

        // When the 'purpose' dropdown changes
        $('#purpose').change(function() {
            var purpose = $(this).val(); // Get selected value

             // Debugging: Log the selected purpose value
            console.log('Selected Purpose: ' + purpose);
    
            // If 'Event' is selected, show Event Name and Description fields
            if (purpose == '1') {
                $('#event-container').show();
                $('#description-container').hide();
                $('#description').val(''); // Clear the description text area
                $('#event_id').val('').trigger('change');
            } else {
                // Otherwise, hide them
                $('#event-container').hide();
                $('#event_id').val('').trigger('change');
                $('#description-container').show();
            }
        });
})


</script>
@endpush
