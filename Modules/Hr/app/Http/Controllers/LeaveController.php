<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Hash;
use Auth;
use DB;
// use App\Models\Admin;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LeaveController extends Controller
{
    use ValidatesRequests;
   
    //-------- **** Leave Type (start) **** -----------
    public function index()
    {
        
        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        if($user_role_id == 1){
            $leave_types = DB::table('hr_leave_types')->get();
            return view('hr::leave_types.index',compact('leave_types'));

        }else{
           $leave_types = DB::table('hr_leave_types')->where('company_id',$user_company_id)->get();
            return view('hr::leave_types.index',compact('leave_types'));
        }
    }

   
    public function create()
    {
        return view('hr::leave_types.create');
    }


    public function store(Request $request)
    {
        $user_company_id = Auth::user()->company_id;
        $leave_type = DB::table('hr_leave_types')
                        ->insertGetId([
                        'company_id'=>$user_company_id,
                        'type_name'=>$request->type_name   
                        ]);

        return redirect()->route('leave_types.index')->with('success_message', 'Leave Type is added successfully!');
    }

   
    public function edit($id)
    {
        $leave_type = DB::table('hr_leave_types')->where('id',$id)->first();
        return view('hr::leave_types.edit',compact('leave_type'));
    }

   
    public function update(Request $request, $id)
    {
        $data = array();
        $data['type_name'] = $request->type_name;

        $updated = DB::table('hr_leave_types')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
        if ($updated){
            // Return a success response
            return redirect()->back()->with('success_message', 'Leave Type is updated successfully!');
        } else {
            // Return a failure response
            return redirect()->back()->with('error_message', 'Leave Type update failed or no changes were made');
        }
    }

  
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $leave_type = DB::table('hr_leave_types')->where('id', $id)->first();

            if (!$leave_type) {
                return response()->json(['success' => false, 'message' => 'Leave Type not found.'], 404);
            }

            // Delete the branch using Query Builder
            DB::table('hr_leave_types')->where('id', $id)->delete();

            // Return a success response
            return response()->json(['success' => true, 'message' => 'Leave Type has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Leave Type.']);
        }
    }
    //-------- **** Leave Type (end) **** -----------


    //-------- **** Leave Application Submission Ways (start) **** -----------

    public function apply_leave(){

        return view('hr::leave_applications.leave_submission_ways');

    }
    //-------- **** Leave Application Submission Ways (end) **** -----------


    //------- apply for leave (file attachment) start -----------
    public function leave_application_file_attachment(){

        $user_company_id = Auth::user()->company_id;
        $leave_types = DB::table('hr_leave_types')
                       ->where('company_id',$user_company_id)
                       ->get();   
        return view('hr::leave_applications.file_attachment_form', compact('leave_types'));
    }


    public function leave_application_attach_file_store(Request $request){

        $user_id = Auth::user()->id;


        // $employee = DB::table('hr_employees')
        //                 ->leftJoin('users','hr_employees.user_id','users.id')
        //                 ->select('hr_employees.id as emp_id')
        //                 ->where('hr_employees.user_id',$user_id)
        //                 ->first();
        // $employee_id = $employee->emp_id;

        
        $user_company_id = Auth::user()->company_id;
        
        $applicationFile = $request->file('attach_leave_application');

        $applicationFileName = date('Ymd') . time() . '.' . $applicationFile->getClientOriginalExtension();
        $directory = 'backend/images/application_files/';
        $appFile = 'leave_applications/' . $applicationFileName;



            // Ensure the directory exists
        if (!file_exists(public_path($directory))) {
            mkdir(public_path($directory), 0755, true);
        }

        // Move the file to the desired directory
        $applicationFile->move(public_path($directory), $applicationFileName);

        $leave_application = DB::table('hr_leave_applications')
                            ->insertGetId([
                            'user_id' => $user_id,
                            'company_id' => $user_company_id,
                            'application_type' => 1,
                            'application_file' => $appFile,
                            'leave_type_id' => $request->leave_type,
                            'application_date' => Carbon::now()->toDateString(),
                            'application_from' => $request->application_from,
                            'application_to' => $request->application_to,
                            'duration' => $request->duration,
                            'application_status' => '1'
                            ]);

            $response = [
            'success' => true,
            'message' => 'Leave Application is submitted successfully'
            ];

            return response()->json($response,200);
    }
    //------- apply for leave (file attachment) end -----------


    //------- apply for leave (form fillup) start -----------

    public function leave_application_form_fillup(){

        $user_company_id = Auth::user()->company_id;
        $leave_types = DB::table('hr_leave_types')
                       ->where('company_id',$user_company_id)
                       ->get();
       
        return view('hr::leave_applications.add_leave_application', compact('leave_types'));
    }


    public function leave_application_form_fillup_store(Request $request)
    {

        $user_id = Auth::user()->id;
        $user_company_id = Auth::user()->company_id;

        $leave_application = DB::table('hr_leave_applications')
                            ->insertGetId([
                            'user_id' => $user_id,
                            'company_id' => $user_company_id,
                            'application_type' => 2,
                            'leave_type_id' => $request->leave_type,
                            'application_msg' => $request->application_msg,
                            'application_date' => Carbon::now()->toDateString(),
                            'application_from' => $request->application_from,
                            'application_to' => $request->application_to,
                            'duration' => $request->duration,
                            'application_status' => '1'
                            ]);

        $response = [
            'success' => true,
            'message' => 'Leave Application is submitted successfully'
            ];
                    
        return response()->json($response,200);

    }
    //------- apply for leave (form fillup) end -----------


    //------- leave application list (start) -----------
    public function leave_applications()
    {
        
        $user_company_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->role_id;

        if($user_role_id == 1){
           $leaveApplications = DB::table('hr_leave_applications')
                                   ->leftJoin('users','hr_leave_applications.user_id','users.id')
                                   ->leftJoin('companies','hr_leave_applications.company_id','companies.id')
                                   ->leftJoin('hr_leave_types','hr_leave_applications.leave_type_id','hr_leave_types.id')
                                   ->select('hr_leave_applications.*',
                                   'users.name as name',
                                   'companies.company_name as company_name',
                                   'hr_leave_types.type_name as leave_type_name',
                                   )
                                   ->orderBy('hr_leave_applications.id','DESC')
                                   ->get();

            return view('hr::leave_applications.index', compact('leaveApplications'));
           
        }elseif(($user_role_id == 2) || ($user_role_id == 3)){
         
                    $leaveApplications = DB::table('hr_leave_applications')
                    ->leftJoin('users','hr_leave_applications.user_id','users.id')
                    ->leftJoin('companies','hr_leave_applications.company_id','companies.id')
                    ->leftJoin('hr_leave_types','hr_leave_applications.leave_type_id','hr_leave_types.id')
                    ->select('hr_leave_applications.*',
                    'users.name as name',
                    'companies.company_name as company_name',
                    'hr_leave_types.type_name as leave_type_name',
                    )
                    ->where('hr_leave_applications.company_id',$user_company_id)
                    ->orderBy('hr_leave_applications.id','DESC')
                    ->get();
        
        return view('hr::leave_applications.index', compact('leaveApplications'));
           
        }else{

        $leaveApplications = DB::table('hr_leave_applications')
                            ->leftJoin('users','hr_leave_applications.user_id','users.id')
                            ->leftJoin('companies','hr_leave_applications.company_id','companies.id')
                            ->leftJoin('hr_leave_types','hr_leave_applications.leave_type_id','hr_leave_types.id')
                            ->select('hr_leave_applications.*',
                            'users.name as name',
                            'companies.company_name as company_name',
                            'hr_leave_types.type_name as leave_type_name',
                            )
                            ->where('leave_applications.user_id',$user_id)
                            ->orderBy('hr_leave_applications.id','DESC')
                            ->get();
                                                      
        return view('hr::leave_applications.index', compact('leaveApplications'));

        }

    }
    //------- leave application list (end) -----------
}
