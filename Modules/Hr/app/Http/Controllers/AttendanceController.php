<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    
   public function give_attendance(){
    
        $user_id = Auth::user()->id;

        //get profile picture
        $personalDetails = DB::table('hr_employees')
                            ->select('profile_pic')
                            ->where('user_id',$user_id)
                            ->first();

        // Get user designation
        $designation = DB::table('hr_employees')
                        ->leftJoin('hr_designations', 'hr_employees.designation_id', '=', 'hr_designations.id')
                        ->select('hr_designations.designation_name as designation_name')
                        ->where('hr_employees.user_id', $user_id)
                        ->first();

        $branch_details = DB::table('hr_employees')
                        ->leftJoin('hr_branches','hr_employees.branch_id','=','hr_branches.id')
                        ->select('hr_branches.br_name as branch_name','hr_branches.longitude as branch_longitude','hr_branches.latitude as branch_latitude')
                        ->where('hr_employees.user_id', $user_id)
                        ->first();

        // Get the last attendance record
        $attendances = DB::table('hr_attendances')
                        ->select('user_id', 'attendance_date', 'created_at')
                        ->where('user_id', $user_id)
                        ->orderBy('created_at', 'desc')
                        ->first();

        $canAttend = true; // Default value
        // Check if the user has attended within the last 24 hours
        if ($attendances) {
        $lastAttendanceTime = \Carbon\Carbon::parse($attendances->created_at);
        $hoursSinceLastAttendance = \Carbon\Carbon::now()->diffInHours($lastAttendanceTime);

        if ($hoursSinceLastAttendance < 24) {
            $canAttend = false;
        }
        }

        return view('hr::attendances.create', compact('designation', 'branch_details', 'canAttend','personalDetails'));       
   }

   public function submit_attendance(Request $request){
        
        $user_id = Auth::user()->id;
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        $attendance = DB::table('hr_attendances')
        ->insertGetId([
        'user_id'=>$user_id,
        'attendance_date' =>$currentDate,
        'entry_time'=>$currentTime
        ]);

        $response = [
            'success' => true,
            'attendance_id' => $attendance,
            'message' => 'Check-in successfully'
        ];

        return response()->json($response,200);
   }

    public function index(Request $request)
    {
        if ($request->ajax()) {

        $user_company_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->role_id;

        if(($user_role_id == 2) || ($user_role_id == 3)){
        $attendances = DB::table('hr_attendances')
                            ->leftJoin('users','hr_attendances.user_id','=','users.id')
                            ->select('hr_attendances.id',
                                     'hr_attendances.attendance_date',
                                     DB::raw("DATE_FORMAT(hr_attendances.entry_time, '%h:%i %p') as entry_time"),
                                     DB::raw("DATE_FORMAT(hr_attendances.exit_time, '%h:%i %p') as exit_time"),
                                    'users.name as member_name'
                                    )
                            ->where('users.company_id',$user_company_id)
                            ->orderBy('hr_attendances.id', 'DESC')
                            ->get();
        }else{

            $attendances = DB::table('hr_attendances')
                            ->leftJoin('users','hr_attendances.user_id','=','users.id')
                            ->select('hr_attendances.id',
                                     'hr_attendances.attendance_date',
                                     DB::raw("DATE_FORMAT(hr_attendances.entry_time, '%h:%i %p') as entry_time"),
                                     DB::raw("DATE_FORMAT(hr_attendances.exit_time, '%h:%i %p') as exit_time"),
                                    'users.name as member_name'
                                    )
                                ->where('users.id',$user_id)
                                ->orderBy('hr_attendances.id', 'DESC')
                                ->get();    
                                
        }

        return DataTables::of($attendances)->addIndexColumn()->make(true);
    }
        
        
        return view('hr::attendances.index');
    }



    public function exit_attendance(){

        $user_id = Auth::user()->id;

        //get profile picture
        $personalDetails = DB::table('hr_employees')
                            ->select('profile_pic')
                            ->where('user_id',$user_id)
                            ->first();

        // Get user designation
        $designation = DB::table('hr_employees')
                        ->leftJoin('hr_designations', 'hr_employees.designation_id', '=', 'hr_designations.id')
                        ->select('hr_designations.designation_name as designation_name')
                        ->where('hr_employees.user_id', $user_id)
                        ->first();

        $branch_details = DB::table('hr_employees')
                        ->leftJoin('hr_branches','hr_employees.branch_id','=','hr_branches.id')
                        ->select('hr_branches.br_name as branch_name','hr_branches.longitude as branch_longitude','hr_branches.latitude as branch_latitude')
                        ->where('hr_employees.user_id', $user_id)
                        ->first();

        // Get the last attendance record
        $attendance = DB::table('hr_attendances')
                        ->whereDate('created_at', '=', \Carbon\Carbon::today())
                        ->where('user_id', $user_id)
                        ->first();

        return view('hr::attendances.exit', compact('personalDetails', 'designation', 'branch_details', 'attendance'));
    }



    public function submit_exit_time(Request $request, $id){

        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        $attendance = DB::table('hr_attendances')
                         ->where('id',$id)
                         ->update(['exit_time' => $currentTime]);

        $response = [
            'success' => true,
            'message' => 'Check-out successfully'
        ];

        return response()->json($response,200);

    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hr::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('hr::show');
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
