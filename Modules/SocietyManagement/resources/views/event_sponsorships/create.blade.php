@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-outline-info float-right" href="{{route('event_sponsorships.index')}}">
                      <i class="fas fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-12">
                <h3 class="mt-2 text-center">Collect Sponsorship</h3>
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
                            <form action="{{route('event_sponsorships.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="row">


                                <div class="col-md-12 col-sm-12" >
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
                                        <label>Sponsor Name <small style="color: red">*</small></label>
                                        <input type="text" required id="sponsor_name" name="sponsor_name" value="{{old('sponsor_name')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Contact Number <small style="color: red">*</small></label>
                                        <input type="text" required id="contact_number" name="contact_number" value="{{old('contact_number')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Contribution Amount (BDT) <small style="color: red">*</small></label>
                                        <input type="number" step="0.01" required id="contribution_amount" name="contribution_amount" value="{{old('contribution_amount')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Amount Collection Date <small style="color: red">*</small></label>
                                        <input type="date" required id="money_collection_date" name="money_collection_date" value="{{old('money_collection_date')}}" class="form-control form-control-lg" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Payment Status <small style="color: red">*</small></label>
                                        <select required class="form-control select2" id="payment_status" name="payment_status" style="width: 100%;">
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
})
</script>
@endpush
