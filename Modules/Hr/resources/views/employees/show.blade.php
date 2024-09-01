{{-- @extends('layouts.app') --}}
@extends('backend.layout.layout')

@section('content')
<div class="container">
    <h2>Employee Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>First Name:</strong> {{ $employee->first_name }}</p>
            <p><strong>Last Name:</strong> {{ $employee->last_name }}</p>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
            <p><strong>Phone Number:</strong> {{ $employee->phone_number }}</p>
            <p><strong>Hire Date:</strong> {{ $employee->hire_date }}</p>
            <p><strong>Job Title:</strong> {{ $employee->job_title }}</p>
            <p><strong>Department:</strong> {{ $employee->department }}</p>
            <p><strong>Salary:</strong> {{ $employee->salary }}</p>
            <p><strong>Manager:</strong> 
                {{ $employee->manager ? $employee->manager->first_name . ' ' . $employee->manager->last_name : 'N/A' }}
            </p>
            <p><strong>Status:</strong> {{ $employee->status }}</p>
        </div>
    </div>
    <a href="{{ route('employees.index') }}" class="btn btn-primary mt-3">Back to Employee List</a>
</div>
@endsection
