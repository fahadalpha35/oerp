@extends('backend.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5 row" style="padding: 25px;">
            <a href="{{ url('employees/create') }}" class="btn btn-success float-left">Add Employee</a><br><br>
                {{-- <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="button-toolbar">
                        <a href="{{ route('export.excel') }}" class="btn">Excel</a>
                        <a href="{{ route('export.csv') }}" class="btn">CSV</a>
                        <button onclick="window.print();" class="btn">Print</button>
                    </div>
                </div> --}}
                <div class="col-md-12 col-sm-12">
                    <h2 class="mt-2 text-center">Employee List</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <table id="exampleTable" class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Level</th>
                                            <th>Designation</th>
                                            <th>Action</th> <!-- Added Action column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->id }}</td>
                                                <td>{{ $employee->level }}</td>
                                                <td>{{ $employee->designation_name }}</td>
                                                <td>
                                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-lg">View</a>
                                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
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
