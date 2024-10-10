<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Carbon\Carbon;

class PayrollController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        
          
        $user_company_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->role_id;

        if(($user_role_id == 1) || ($user_role_id == 2) || ($user_role_id == 3)){

        if ($request->ajax()) {

            $payrolls = DB::table('hr_payrolls')
                           ->leftJoin('users','hr_payrolls.user_id','users.id')
                           ->select('hr_payrolls.*',
                           'users.name as member_name')
                           ->where('users.company_id',$user_company_id)                          
                            ->get();
                   
                return DataTables::of($payrolls)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return '
                            <a href="' . route('payroll_show_data', $row->id) . '" class="btn btn-warning">View</a>
                        ';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('hr::payrolls.index');
           
        }else{

            if ($request->ajax()) {

                $payrolls = DB::table('hr_payrolls')
                                ->leftJoin('users','hr_payrolls.user_id','users.id')
                                ->select('hr_payrolls.*',
                                'users.name as member_name')
                                ->where('users.id',$user_id)                          
                                ->get();


                    return DataTables::of($payrolls)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {
                            return '
                                <a href="' . route('payroll_show_data', $row->id) . '" class="btn btn-warning">View</a>
                            ';
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
    
                return view('hr::payrolls.index');
        }

    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_company_id = Auth::user()->company_id;

        $members = DB::table('users')
        ->select(
        'users.name as member_name',
        'users.id as member_id',
        'users.registration_date as member_joining_date')
        ->where('users.company_id', $user_company_id)
        ->where('users.role_id','!=',2)
        ->get();

        // dd($members);
        return view('hr::payrolls.create',compact('members'));
    }


    public function member_details_dependancy(Request $request){
        $selectedMemberId = $request->input('data');

        $employeeInfo = DB::table('users')
                            ->leftJoin('hr_employees','users.id','hr_employees.user_id')
                            ->leftJoin('hr_designations','hr_employees.designation_id','hr_designations.id')
                            ->select(
                                'users.*',
                            'hr_employees.monthly_salary as emp_monthly_salary',
                            'hr_designations.designation_name as member_designation'
                            )
                            ->where('users.id',$selectedMemberId)
                            ->first();

            $joining_date = $employeeInfo->registration_date;
            $member_designation = $employeeInfo->member_designation;
            $employee_monthly_salary = $employeeInfo->emp_monthly_salary;
            $joining_month = Carbon::parse($joining_date)->format('m');

            $per_day_salary = ceil($employee_monthly_salary / 26);


            $current_date = Carbon::now()->format('Y-m-d');
            $previous_month = Carbon::now()->subMonth()->format('Y-m-d');

            $leave = DB::table('hr_leave_applications')
                         ->where('user_id',$selectedMemberId)
                         ->whereMonth('application_date',Carbon::parse($previous_month)->month)
                         ->whereYear('application_date',Carbon::parse($previous_month)->year)
                         ->sum('approved_duration');


    
            $data = [
                'joining_date' => $joining_date,
                'member_designation' => $member_designation,
                'joining_month' => $joining_month,
                'employee_monthly_salary' => $employee_monthly_salary,
                'per_day_salary' => $per_day_salary,
                'total_leave_day' => $leave
            ];

            return $data;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payroll = DB::table('hr_payrolls')
        ->insertGetId([
        'user_id'=>$request->employee,
        'company_id'=>Auth::user()->company_id,
        'salary_date'=>$request->salary_date,
        // 'joining_date'=>$request->joining_date,
        'per_day_salary'=>$request->per_day_salary,
        // 'emp_total_bonus_day'=>$request->emp_total_bonus_day,
        // 'emp_total_bonus_amount'=>$request->emp_total_bonus_amount,     
        // 'bonus_eligible_month'=>$request->bonus_eligible_month,
        // 'bonus_pay_month'=>$request->bonus_pay_month,
        // 'bonus_pay_amount'=>$request->bonus_pay_amount,
        'total_working_day'=>$request->total_working_day,
        'total_leave'=>$request->total_leave,
        'total_number_of_pay_day'=>$request->total_number_of_pay_day,
        'monthly_salary'=>$request->monthly_salary,
        'monthly_bonus'=>$request->monthly_holiday_bonus,
        'total_daily_allowance'=>$request->total_daily_allowance,
        'total_travel_allowance'=>$request->total_travel_allowance,
        'rental_cost_allowance'=>$request->rental_cost_allowance,
        'hospital_bill_allowance'=>$request->hospital_bill_allowance,
        'insurance_allowance'=>$request->insurance_allowance,
        'sales_commission'=>$request->sales_commission,
        'retail_commission'=>$request->retail_commission,
        'total_others'=>$request->total_others,
        'total_salary'=>$request->total_salary,
        'yearly_bonus'=>$request->yearly_bonus,
        'gross_pay'=>$request->total_payable_salary,
        // 'advance_less'=>$request->advance_less,
        'deduction'=>$request->any_deduction,
        'net_pay'=>$request->final_pay_amount,
        'payment_status'=>2
        // 'loan_advance'=>$request->loan_advance
        ]);


        //  return redirect()->route('payroll_show_data');

        $response = [
            'success' => true,
            'message' => 'Payroll is added successfully',
            'payroll_id' => $payroll
        ];

         return response()->json($response,200);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
    }


    public function payroll_show_data($id){

        $member_payroll_info = DB::table('hr_payrolls')
        ->where('id',$id)
        ->first();

        $user_id = $member_payroll_info->user_id;
        $company_id = $member_payroll_info->company_id;

        $user_info = DB::table('users')
        ->where('id',$user_id)
        ->first();
        $employee_name = $user_info->name;

        $employee = DB::table('hr_employees')
        ->select('designation_id','branch_id','department_id')
        ->where('user_id',$user_id)
        ->first();


        $designation_id = $employee->designation_id;
        $branch_id = $employee->branch_id;
        $department_id = $employee->department_id;

        //designation
        $designation = DB::table('hr_designations')
        ->where('id',$designation_id)
        ->first();
        $designation_name = $designation->designation_name;

        //branch
        $branch = DB::table('hr_branches')
        ->where('id',$branch_id)
        ->first();
        $branch_name = $branch->br_name;

        //department
        $department = DB::table('hr_departments')
        ->where('id',$department_id)
        ->first();
        $department_name = $department->dept_name;

        //business
        $company = DB::table('companies')
        ->where('id',$company_id)
        ->first();
        $business_name = $company->company_name;


        return view('hr::payrolls.show_data',compact(
                                'member_payroll_info',
                                'employee_name',
                                'designation_name',
                                'business_name',
                                'branch_name',
                                'department_name',
                                'id'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('hr::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
