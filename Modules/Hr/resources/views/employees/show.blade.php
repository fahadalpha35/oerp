{{-- @extends('layouts.app') --}}
@extends('backend.layout.layout')

@section('content')
<div class="main-panel"> 
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h2>Employee Details</h2>

                    <div class="col-12">
                        <a class="btn btn-outline-info float-right" href="{{route('employees.index')}}">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>  
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Full Name:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Designation:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Joining Date:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Monthly Salary:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Email:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Contact Number:</strong> {{ $employee->full_name }}</p> 
                                <p><strong>Branch:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Department:</strong> {{ $employee->full_name }}</p>

                                <p><strong>Father Name:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Mother Name:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Religion:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Gender:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Marital Status:</strong> {{ $employee->full_name }}</p>
                                <p><strong>NID Number:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Date of Birth:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Blood Group:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Nationality:</strong> {{ $employee->full_name }}</p>
                                <p><strong>Present Address:</strong> {{ $employee->last_name }}</p>
                                <p><strong>Permanent Address:</strong> {{ $employee->email }}</p>
                               
                            </div>
                        </div>
                </div>
            </div>
        </div>
   
</div>
@endsection
