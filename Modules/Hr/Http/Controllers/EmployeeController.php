<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Hr\App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Hash;
use Auth;
use DB;
// use App\Models\Admin;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class EmployeeController extends Controller
{
    
    use ValidatesRequests;
    
    public function index()
    {
        
        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        if($user_role_id == 1){

            $employees = DB::table('hr_employees')
                            ->leftJoin('users','hr_employees.user_id','users.id')
                            ->leftJoin('companies','users.company_id','companies.id')
                            ->leftJoin('hr_designations','hr_employees.designation_id','hr_designations.id')
                            ->leftJoin('hr_branches','hr_employees.branch_id','hr_branches.id')
                            ->leftJoin('hr_departments','hr_employees.department_id','hr_departments.id')
                            ->select(
                                'users.name as as employee_name',
                                'companies.company_name as employee_company',
                                'users.email as as employee_email',                                
                                'hr_designations.designation_name as employee_designation',
                                'hr_branches.br_name as employee_branch',
                                'hr_departments.dept_name as employee_department',
                                'hr_employees.*'
                                )
                            ->get();

            return view('hr::employees.index',compact('employees'));
  
        }else{

            $employees = DB::table('hr_employees')
                            ->leftJoin('users','hr_employees.user_id','users.id')
                            ->leftJoin('companies','users.company_id','companies.id')
                            ->leftJoin('hr_designations','hr_employees.designation_id','hr_designations.id')
                            ->leftJoin('hr_branches','hr_employees.branch_id','hr_branches.id')
                            ->leftJoin('hr_departments','hr_employees.department_id','hr_departments.id')
                            ->select(
                                'users.name as employee_name',
                                'companies.company_name as employee_company',
                                'users.email as employee_email',                                
                                'hr_designations.designation_name as employee_designation',
                                'hr_branches.br_name as employee_branch',
                                'hr_departments.dept_name as employee_department',
                                'hr_employees.*'
                                )
                            ->where('users.company_id',$user_company_id)
                            ->get();

            // dd($employees);
            return view('hr::employees.index',compact('employees'));

        }
    }


    //level and designation depandancy
    public function level_designation_dependancy(Request $request){
        $selectedLevel = $request->input('data');
        $user_company_id = Auth::user()->company_id;

        $designations = DB::table('hr_designations')
                        ->where('level',$selectedLevel)
                        ->where('company_id',$user_company_id)
                        ->get();
  
        $str="<option value=''>-- Select --</option>";
        foreach ($designations as $designation) {
            $str .= "<option value='$designation->id'> $designation->designation_name </option>";
            
        }
        echo $str;
    }

    //branch and department depandancy
    public function branch_dpartment_dependancy(Request $request){
        $selectedBranch = $request->input('data');
        $user_company_id = Auth::user()->company_id;

        $departments = DB::table('hr_departments')
                        ->where('branch_id',$selectedBranch)
                        ->where('company_id',$user_company_id)
                        ->get();
  
        $str="<option value=''>-- Select --</option>";
        foreach ($departments as $department) {
            $str .= "<option value='$department->id'> $department->dept_name </option>";
            
        }
        echo $str;
    }

    public function create()
    {
        
        $user_company_id = Auth::user()->company_id;
        $branches = DB::table('hr_branches')
                    ->where('hr_branches.company_id',$user_company_id)
                    ->where('br_status',1)
                    ->get();

        return view('hr::employees.create',compact('branches'));
    }

    public function store(Request $request)
    {
     
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:8|confirmed',
            'joining_date' => 'required|date',
            'monthly_salary' => 'required|numeric',
            'designation_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'department_id' => 'required|numeric',
        ];

        $customMessages = [
            'name.required' => 'Full Name is required',
            'designation_id.required' => 'Designation is required',
            'branch_id.required' => 'Branch Name is required',
            'department_id.required' => 'Department Name is required',
        ];

        $this->validate($request, $rules, $customMessages);


        $company_id = Auth::user()->company_id;
        $company_business_type = Auth::user()->company_business_type;
        $user = new User();
        $user->name = $request->name;
        $user->role_id = 4;
        $user->company_id = $company_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->active_status = '1';
        $user->company_business_type = $company_business_type;
        $user->registration_date = Carbon::now()->toDateString();       
        $user->save();


        $employee = DB::table('hr_employees')
                    ->insertGetId([
                    'user_id'=>$user->id,
                    'designation_id'=>$request->designation_id,
                    'branch_id'=>$request->branch_id,
                    'department_id'=>$request->department_id,
                    'joining_date'=>$request->joining_date,
                    'monthly_salary' => $request->monthly_salary
                    ]); 

        return redirect()->route('employees.index')->with('success', 'Employee is added successfully.');
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
