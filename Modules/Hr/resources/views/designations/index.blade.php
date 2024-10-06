@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('designations.create') }}" class="btn btn-success btn-sm">Add Designation</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Designation List</h3>
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
                              <th>Level</th>
                              <th>Designation Name</th>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <th>Action</th>
                              @endif
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($designations as $designation)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>
                                @if($designation->level == 1)
                                Managing Level
                                @elseif($designation->level == 2)
                                Operational Level
                                @else
                                Support Level
                                @endif
                              </td>
                              <td>{{$designation->designation_name}}</td>

                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <td>
                                <a href="{{route('designations.edit',$designation->id)}}" style="color: white"><button class="btn btn-warning">Edit</button></a>
                                <a onclick="deleteOperationWithoutYajra('{{ route('designations.destroy', ':id') }}', {{$designation->id}})" style="color: white"><button class="btn btn-danger"> Delete</button></a>
                              </td>
                              @endif
                            </tr>
                            @endforeach

                            </tfoot>
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
