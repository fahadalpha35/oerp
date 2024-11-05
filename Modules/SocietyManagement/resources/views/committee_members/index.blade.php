@extends('backend.layout.layout')

@section('content')
    <div class="content-wrapper">

        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('committee_members.create') }}" class="btn btn-success btn-sm">Add Committee Member</a>

                <div class="col-md-12 col-sm-12">
                    <h3 class="mt-2 text-center">Committee Member List</h3>
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
                            <div class="">
                                <table id="exampleTable" class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Member ID</th>
                                            <th>Member Name</th>
                                            <th>Designation in Committee</th>
                                            <th>Committee Name</th>
                                            <th>Action</th> <!-- Added Action column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
    this.loadDataTable('exampleTable', '{{ route('committee_members.index') }}',
        [
            {data: 'member_unique_id', name: 'member_unique_id'},
            {data: 'member_name', name: 'member_name'},
            {data: 'member_designation', name: 'member_designation'},
            {data: 'committee_name', name: 'committee_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
);

</script>
@endpush
