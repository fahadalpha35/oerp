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


    public function show($id)
    {
       
        $employee = DB::table('hr_employees')
                        ->leftJoin('users','hr_employees.user_id','users.id')
                        ->leftJoin('companies','users.company_id','companies.id')
                        ->leftJoin('hr_designations','hr_employees.designation_id','hr_designations.id')
                        ->leftJoin('hr_branches','hr_employees.branch_id','hr_branches.id')
                        ->leftJoin('hr_departments','hr_employees.department_id','hr_departments.id')
                        ->select(
                            'users.name as full_name',
                            'companies.company_name as company_name',
                            'users.email as email',                                
                            'hr_designations.designation_name as designation',
                            'hr_branches.br_name as branch',
                            'hr_departments.dept_name as department',
                            'hr_employees.*'
                            )
                        ->where('hr_employees.id',$id)
                        ->first();


        return view('hr::employees.show', compact('employee'));
    }


    public function edit($id)
    {
        
        $employee = DB::table('hr_employees')
                        ->leftJoin('users','hr_employees.user_id','users.id')
                        ->leftJoin('companies','users.company_id','companies.id')
                        ->leftJoin('hr_designations','hr_employees.designation_id','hr_designations.id')
                        ->leftJoin('hr_branches','hr_employees.branch_id','hr_branches.id')
                        ->leftJoin('hr_departments','hr_employees.department_id','hr_departments.id')
                        ->select(
                            'users.name as full_name',
                            'companies.company_name as company_name',
                            'users.email as email',                                
                            'hr_designations.designation_name as designation',
                            'hr_branches.br_name as branch',
                            'hr_departments.dept_name as department',
                            'hr_employees.*'
                            )
                        ->where('hr_employees.id',$id)
                        ->first();


        $user_company_id = Auth::user()->company_id;
        $branches = DB::table('hr_branches')
                    ->where('hr_branches.company_id',$user_company_id)
                    ->where('br_status',1)
                    ->get();

        return view('hr::employees.edit', compact('employee','branches'));
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'monthly_salary' => 'required|numeric',
            'designation_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'department_id' => 'required|numeric',
        ];

        $customMessages = [
            'monthly_salary.required' => 'Monthly Salary is required',
            'designation_id.required' => 'Designation is required',
            'branch_id.required' => 'Branch Name is required',
            'department_id.required' => 'Department Name is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;

        $data = array();
        $data['monthly_salary'] = $request->input('monthly_salary');
        $data['designation_id'] = $request->input('designation_id');
        $data['branch_id'] = $request->input('branch_id');
        $data['department_id'] = $request->input('department_id');

        $updated = DB::table('hr_employees')
                        ->where('id', $id)
                        ->update($data);

         // Check if the update was successful
         if ($updated) {
            // Return a success response
            return redirect()->back()->with('success_message', 'Employee Information is updated successfully!');
        } else {
            // Return a failure response
            return redirect()->back()->with('error_message', 'Employee Information update failed or no changes were made');
        }
    }

    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $department = DB::table('hr_employees')->where('id', $id)->first();
    
            if (!$department) {
                return response()->json(['success' => false, 'message' => 'Employee not found.'], 404);
            }
    
            // Delete the branch using Query Builder
            DB::table('hr_employees')->where('id', $id)->delete();
    
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Employee has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Employee.']);
        }

    }

   
}
