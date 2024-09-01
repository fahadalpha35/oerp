<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Hr\App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Auth;
use App\Models\Admin;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(5); // Paginate with 10 items per page
        return view('hr::employees.index', compact('employees'));
    }

    public function create()
    {
        $managers = Employee::whereNotNull('manager_id')->get();
        return view('hr::employees.create', compact('managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'email' => 'required|email|max:100|unique:employees',
            'phone_number' => 'nullable|string|max:20',
            'hire_date' => 'nullable|date',
            'job_title' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'salary' => 'nullable|numeric',
            'manager_id' => 'nullable|exists:employees,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $managers = Employee::whereNotNull('manager_id')->get();
        return view('hr::employees.edit', compact('employee', 'managers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'email' => 'required|email|max:100|unique:employees,email,' . $id,
            'phone_number' => 'nullable|string|max:20',
            'hire_date' => 'nullable|date',
            'job_title' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'salary' => 'nullable|numeric',
            'manager_id' => 'nullable|exists:employees,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('hr::employees.show', compact('employee'));
    }
}
