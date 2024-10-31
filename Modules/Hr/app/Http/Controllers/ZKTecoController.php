<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Jmrashed\Zkteco\Lib\ZKTeco;

class ZKTecoController extends Controller
{
   
    public function index()
    {
        return view('hr::index');
    }

    public function fingerprint_portal(){
        return view('hr::fingerprints.portal');     
     }

     public function set_fingerprint_device_ip(){
        return view('hr::fingerprints.set_ip');     
     }

     public function store_ip(Request $request)
    {
        // Store the IP in the session (or use a database)
        Session::put('zkteco_ip', $request->input('device_ip'));
        return redirect()->back()->with('message', 'IP Address saved successfully.');
    }

    public function add_fingerprint_user(){

       
        $user_id = Auth::user()->id;
        $user_company_id = Auth::user()->company_id;

        $users = DB::table('users')
                    ->select('id','name')
                    ->where('company_id',$user_company_id)
                    ->get();

        return view('hr::fingerprints.create',compact('users'));
    }


    public function user_fingerprint_data_store(Request $request)
    {
        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        if(($user_role_id == 1) || ($user_role_id == 2)){
            $user_branch_id = 'N/A';
        }else{
            $user_branch_id = Auth::user()->branch_id;
        }


        $system_user_id = $request->system_user_id;
        $system_user_name = DB::table('users')
                               ->select('name')
                               ->where('id', $system_user_id)
                               ->first();
        $name = $system_user_name->name;
        
        $uid = $request->uid;
        $machine_user_id = $request->machine_user_id;
        $role_id = $request->role_id;
        $user_create_date = Carbon::now()->toDateString();
        $password = $request->password;
        $card_no = $request->card_no;
    
        $my_device_ip = Session::get('zkteco_ip');
        $zk = new ZKTeco($my_device_ip);
    
        if ($zk->connect()) {
            // Retrieve all users from the device
            $allUsers = $zk->getUser();
    
            // Initialize flags to check for uniqueness
            $uidExists = false;
            $userIdExists = false;
    
            // Check for both uid and machine_user_id
            foreach ($allUsers as $user) {
                if ($user['uid'] == $uid) {  // Replace 'uid' with the correct key if necessary
                    $uidExists = true;
                }
                if ($user['userid'] == $machine_user_id) {  // Replace 'userid' with the correct key if necessary
                    $userIdExists = true;
                }
                if ($uidExists || $userIdExists) break;
            }
    
            // Return errors if either UID or Machine User ID already exists
            if ($uidExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'UID already exists on the device. Please choose a different UID.'
                ], 400);
            }
            if ($userIdExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Machine User ID already exists on the device. Please choose a different Machine User ID.'
                ], 400);
            }
    
            // If both uid and machine_user_id are unique on the device, proceed to set the user
            $setUserToMachine = $zk->setUser($uid, $machine_user_id, $name, $password, $role_id, $card_no);
    
            // Store user data in the system database
            $setUserToSystem = DB::table('hr_attendance_users')
                                    ->insertGetId([
                                        'uid' => $uid,
                                        'system_user_id' => $system_user_id,
                                        'machine_user_id' => $machine_user_id,
                                        'role_id' => $role_id,
                                        'company_id' => $user_company_id,
                                        'branch_id' => $user_branch_id,
                                        'user_create_date' => $user_create_date,
                                        'password' => $password,
                                        'card_no' => $card_no
                                    ]);
    
            if ($setUserToSystem) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Fingerprint Data is submitted successfully'
                ], 200);
            }
    
            return response()->json([
                'success' => false,
                'message' => 'Failed to add user to the ZKTeco device.'
            ], 500);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Failed to connect to the ZKTeco device.'
        ], 500);
    }


    //fetch data from machine + shopnet software (current date)
    public function system_fingerprint_attendances_today(Request $request)
    {
        if ($request->ajax()) {
        $my_device_ip =  Session::get('zkteco_ip');
        $zk = new ZKTeco($my_device_ip);
        $connected = $zk->connect();
        $todayDate = Carbon::now()->toDateString();

        // Step 1: Retrieve attendance log
        $attendanceLog = $zk->getAttendance();
      
        $todayRecords = [];
           foreach ($attendanceLog as $record) {
            // Extract the date from the timestamp
            $recordDate = substr($record['timestamp'], 0, 10);
            // Check if the date matches today's date
            if ($recordDate === $todayDate) {

                $user = DB::table('hr_attendance_users')
                        ->join('users', 'hr_attendance_users.system_user_id', '=', 'users.id')
                        ->join('hr_employees', 'hr_attendance_users.system_user_id', '=', 'hr_employees.user_id')
                        ->join('hr_branches', 'hr_employees.branch_id', '=', 'hr_branches.id')
                        ->join('hr_designations', 'hr_employees.designation_id', '=', 'hr_designations.id')
                        ->select('hr_attendance_users.machine_user_id','hr_attendance_users.uid','users.name','users.id','hr_branches.br_name','hr_designations.designation_name')
                        ->where('hr_attendance_users.machine_user_id', $record['id'])
                        ->first();
    
                    if ($user){
                        // Store the required data in the $todayRecords array
                        
                        $todayRecords[] = [
                            'name' => $user->name,
                            'designation_name' => $user->designation_name,
                            'br_name' => $user->br_name,
                            'timestamp' => date('Y-m-d h:i:s A', strtotime($record['timestamp']))
                        ];
                    }
            }
        }
        return DataTables::of($todayRecords)->addIndexColumn()->make(true);
    }    
        return view('hr::fingerprints.today_attendances');
          
    }


    public function system_attendances(Request $request)
    {
        if ($request->ajax()) {
        $my_device_ip =  Session::get('zkteco_ip');
        $zk = new ZKTeco($my_device_ip);
        $connected = $zk->connect();
        $attendanceLog = $zk->getAttendance();

        $data = [];
        foreach ($attendanceLog as $record) {

            $user = DB::table('hr_attendance_users')
                        ->join('users', 'hr_attendance_users.system_user_id', '=', 'users.id')
                        ->join('hr_employees', 'hr_attendance_users.system_user_id', '=', 'hr_employees.user_id')
                        ->join('hr_branches', 'hr_employees.branch_id', '=', 'hr_branches.id')
                        ->join('hr_designations', 'hr_employees.designation_id', '=', 'hr_designations.id')
                        ->select('hr_attendance_users.machine_user_id','hr_attendance_users.uid','users.name','users.id','hr_branches.br_name','hr_designations.designation_name')
                        ->where('hr_attendance_users.machine_user_id', $record['id'])
                        ->first();

        if ($user) {
            $data[] = [
                'name' => $user->name,
                'designation_name' => $user->designation_name,
                'br_name' => $user->br_name,
                'timestamp' => date('Y-m-d h:i:s A', strtotime($record['timestamp']))
            ];
        }
        }
        return DataTables::of($data)->addIndexColumn()->make(true);
    }      
        return view('hr::fingerprints.index');
    }
}
