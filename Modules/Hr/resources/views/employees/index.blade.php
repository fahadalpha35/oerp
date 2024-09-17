@extends('backend.layout.layout')
@section('content')

<style>
.content-wrapper1 {
    padding-top: 0;
    min-height: calc(100vh - 75px);
}
.content-wrapper1 {
    background: #F5F7FF;
    width: 100%;
    /* padding: 2.375rem 2.375rem; */
    -webkit-flex-grow: 1;
    flex-grow: 1;
}
@media (max-width: 767px) {
    .content-wrapper1 {
        padding: 1.5rem 1.5rem;
    }
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem 0;
    list-style-type: none;
    margin: 0;
}

.pagination li {
    margin: 0 8px;
    display: flex;
    align-items: center;
}

.pagination li a, .pagination li span {
    padding: 8px 16px;
    text-decoration: none;
    color: #007bff;
    background-color: #fff;
    border: 2px solid #007bff;
    border-radius: 8px;
    font-size: 14px;
    transition: background-color 0.3s, color 0.3s;
}

.pagination li a:hover, .pagination li span:hover {
    background-color: #007bff;
    color: #fff;
}

.pagination .active span {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.pagination .disabled span {
    color: #6c757d;
    background-color: #fff;
    border-color: #ddd;
    cursor: not-allowed;
}

.pagination .disabled span:hover {
    background-color: #fff;
    color: #6c757d;
}

/* Button styles */
.button-toolbar {
    margin-bottom: 15px;
}

.button-toolbar .btn {
    margin-right: 10px;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    border: 2px solid #007bff;
    transition: background-color 0.3s, color 0.3s;
}

.button-toolbar .btn:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}
</style>

<div class="main-panel">
    <div class="content-wrapper1">
        <div style="background-color: #fff;border-radius: 20px;">
            <div class="mt-5" style="padding: 25px;">
            <a href="{{ url('employees/create') }}" class="btn btn-success">Add Employee</a><br><br>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="button-toolbar">
                        <a href="{{ route('export.excel') }}" class="btn">Excel</a>
                        <a href="{{ route('export.csv') }}" class="btn">CSV</a>
                        <button onclick="window.print();" class="btn">Print</button>
                    </div>
                    <input type="text" id="employeeSearch" class="form-control w-25" placeholder="Search Employee">
                </div>
                <h2 class="mb-4 text-center">Employee List</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                {{-- <th>Email</th>
                                <th>Phone Number</th>
                                <th>Hire Date</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Salary</th>
                                <th>Status</th> --}}
                                <th>Action</th> <!-- Added Action column -->
                            </tr>
                        </thead>
                        <tbody id="employeeTable">
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->level }}</td>
                                    <td>{{ $employee->designation_name }}</td>
                                    {{-- <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone_number }}</td>
                                    <td>{{ $employee->hire_date }}</td>
                                    <td>{{ $employee->job_title }}</td>
                                    <td>{{ $employee->department }}</td>
                                    <td>{{ $employee->salary }}</td>
                                    <td>{{ $employee->status }}</td> --}}
                                    <td>
                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td> <!-- Added Action buttons -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Custom Pagination Links -->
                {{-- <ul class="pagination">
                    @if ($employees->onFirstPage())
                        <li class="disabled"><span>&laquo; Previous</span></li>
                    @else
                        <li><a href="{{ $employees->previousPageUrl() }}" rel="prev">&laquo; Previous</a></li>
                    @endif

                    @foreach(range(1, $employees->lastPage()) as $page)
                        @if ($page == $employees->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $employees->url($page) }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($employees->hasMorePages())
                        <li><a href="{{ $employees->nextPageUrl() }}" rel="next">Next &raquo;</a></li>
                    @else
                        <li class="disabled"><span>Next &raquo;</span></li>
                    @endif
                </ul> --}}
            </div>
        </div>
    </div>
    @include('backend.layout.footer')
</div>

<script>
    document.getElementById('employeeSearch').addEventListener('keyup', function() {
        var value = this.value.toLowerCase();
        var rows = document.querySelectorAll('#employeeTable tr');
        rows.forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>

@endsection
