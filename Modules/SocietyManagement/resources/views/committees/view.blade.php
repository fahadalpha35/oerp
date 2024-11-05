@extends('backend.layout.layout')
@section('content')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-outline-info float-right" href="{{route('society_committees.index')}}">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                        <div class="col-12">
                            <br>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mt-2 text-center">Committee Details</h3>
                            <br>
                                <h4 class="text-muted text-center">{{ $committee->name }}</h4>
                                <h4 class="text-muted text-center">
                                    @if($committee->active_status == 1)
                                    Status: <span style="color: rgb(42, 236, 42)">Active</span>
                                    @else
                                    Status: <span style="color: red">Inactive</span>
                                    @endif
                                </h4>
                                <br>
                                <h3 class="mb-4 text-center">Member Details</h3>
                                <div class="row">
                                    @foreach($committee_members as $committee_member)
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Member Name:</label>
                                        <h5 style="color: #0098ef">{{ $committee_member->member_name }}</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <label>Designation:</label>
                                        <h5 style="color: #0098ef">{{ $committee_member->committee_member_designation }}</h5>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        </div>
                        </div>

                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->
        </div>
@endsection