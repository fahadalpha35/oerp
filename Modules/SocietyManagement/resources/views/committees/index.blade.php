@extends('backend.layout.layout')
@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('society_committees.create') }}" class="btn btn-success btn-sm">Add Committee</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Committee List</h3>
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
                         <table id="exampleTableWithoutYajra" class="table table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                              <th>Serial No.</th>
                              {{-- <th>Company Name</th> --}}
                              <th>Committee Name</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Status</th>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2)|| (auth()->user()->role_id == 3))
                              <th>Action</th>
                              @endif
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($committees as $committee)
                            <tr>
                              <td>{{$i++}}</td>
                              {{-- <td>{{$committee->company_name}}</td> --}}
                              <td>{{$committee->name}}</td>
                              <td>{{$committee->start_date}}</td>
                              <td>{{$committee->end_date}}</td>
                              <td>
                                @if($committee->active_status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                              </td>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <td>
                                <a href="/society_committees/{{ $committee->id }}/" style="color: white"><button class="btn btn-success"> View</button></a>
                                <a href="{{route('society_committees.edit',$committee->id)}}" style="color: white"><button class="btn btn-warning"> Edit</button></a>
                                <a onclick="deleteOperationWithoutYajra('{{ route('society_committees.destroy', ':id') }}', {{$committee->id}})" style="color: white"><button class="btn btn-danger"> Delete</button></a>
                              </td>
                              @endif
                            </tr>
                            @endforeach

                            </tbody>
                          </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('masterScripts')
<script>
$(document).ready(function() {
    var table = $('#exampleTableWithoutYajra').DataTable({
        responsive: true,
    });
});
</script>
@endpush
