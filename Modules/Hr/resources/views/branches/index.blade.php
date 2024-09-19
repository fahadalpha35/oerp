@extends('backend.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ route('branches.create') }}" class="btn btn-success">Add Branch</a><br><br>
                {{-- <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="button-toolbar">
                        <a href="{{ route('export.excel') }}" class="btn">Excel</a>
                        <a href="{{ route('export.csv') }}" class="btn">CSV</a>
                        <button onclick="window.print();" class="btn">Print</button>
                    </div>
                </div> --}}
                <div class="col-md-12 col-sm-12">
                    <h2 class="mb-2 text-center">Branch List</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <table id="exampleTable" class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Company</th>
                                            <th>Branch Type</th>
                                            <th>Branch</th>
                                            <th>Status</th>
                                            <th>Action</th> <!-- Added Action column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($branches as $branch)
                                            <tr>
                                                <td>{{ $branch->id }}</td>
                                                <td>{{ $branch->company_id }}</td>
                                                <td>{{ $branch->br_type }}</td>
                                                <td>{{ $branch->br_name }}</td>
                                                <td>{{ $branch->br_status }}</td>
                                                <td>
                                                    <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
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
    </div>
    @include('backend.layout.footer')
</div>
@endsection


@push('masterScripts')
<script>
   $(document).ready(function() {
        $('#exampleTable').DataTable({
            responsive: true// Enable responsive functionality
        });
    });
    </script>
@endpush
