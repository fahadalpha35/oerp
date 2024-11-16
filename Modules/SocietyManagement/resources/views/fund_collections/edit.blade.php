@extends('backend.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('fund_collections.index')}}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <br>
                    <h3 class="mt-2 text-center">Edit Fund Information</h3>
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
                                 
                    <form action="{{route('fund_collections.update',$fund_collection->id)}}" method="POST">
                        @csrf
                        @method('PUT')            
                        <div class="row">
                           
                            @if($fund_collection->event_id != '')
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                  <label>Event Name</label>
                                    <select class="form-control select2" id="event_id" name="event_id" style="width: 100%;">
                                        <option value="{{$fund_collection->event_id}}">{{$fund_collection->event_name}}</option>
                                        @foreach($events as $event)
                                        <option value="{{$event->id}}">{{$event->event_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                  <label>Member <small style="color: red">*</small></label>
                                    <select  class="form-control select2" id="society_member_id" name="society_member_id" style="width: 100%;">
                                        <option value="{{$fund_collection->society_member_id}}">{{$fund_collection->member_name}}</option>
                                        @foreach($members as $member)
                                        <option value="{{$member->id}}">{{$member->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if($fund_collection->description != '')
                            <div class="col-md-12 col-sm-12" id="description-container">
                                <div  class="form-group mb-4">
                                    <label>Fund Collection Reason</label>
                                    <textarea name="description" id="description" class="form-control">{{$fund_collection->description}}</textarea>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Fund Amount (BDT) <small style="color: red">*</small></label>
                                    <input type="number" step="0.01" required id="fund_amount" name="fund_amount" value="{{$fund_collection->fund_amount}}" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Fund Collection Date <small style="color: red">*</small></label>
                                    <input type="date" required id="fund_collection_date" name="fund_collection_date" value="{{$fund_collection->fund_collection_date}}" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Status <small style="color: red">*</small></label>
                                    <select  class="form-control select2" required id="fund_collection_status" name="fund_collection_status" style="width: 100%;">
                                     <option value="{{$fund_collection->fund_collection_status}}">
                                        @if($fund_collection->fund_collection_status == 1)
                                        Pending
                                        @else
                                        Collected
                                        @endif
                                     </option>
                                      <option value="1">Pending</option>
                                      <option value="2">Collected</option>
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
