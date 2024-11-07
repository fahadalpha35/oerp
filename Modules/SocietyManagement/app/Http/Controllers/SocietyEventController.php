<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SocietyEventController extends Controller
{
    use ValidatesRequests;
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
      
            $user_company_id = Auth::user()->company_id;

            $events = DB::table('society_events')
                          ->leftJoin('society_committees','society_events.committee_id','society_committees.id')
                        ->select(
                            'society_events.id',
                            'society_events.event_name',
                            'society_events.event_budget',
                            'society_events.event_start_date',
                            'society_events.event_end_date',
                            'society_events.event_loaction',
                            'society_events.event_status',
                            'society_committees.name as organized_by'
                            )
                        ->where('society_events.company_id', $user_company_id)
                        ->get();

        
        return DataTables::of($events)
        ->addIndexColumn()
        ->addColumn('event_status_label', function ($row) {
            if($row->event_status == 1){
                return 'Upcoming';
            }elseif($row->event_status == 2){
                return 'Ongoing';
            }else{
                return 'Completed' ;
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('society_events.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('society_events.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        
        
        return view('societymanagement::society_events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_company_id = Auth::user()->company_id;
        $committees = DB::table('society_committees')
                         ->where('company_id',$user_company_id)
                         ->where('active_status',1)
                         ->get();
        
        return view('societymanagement::society_events.create',compact('committees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'event_name' => 'required|string',
            'event_budget' => 'required|numeric',
            'committee_id' => 'required|numeric',
            'event_start_date' => 'required|date',
            'event_start_time' => 'required',
            'event_loaction' => 'required|string|max:255',
            'event_status' => 'required|numeric'
        ];

        $customMessages = [
            'event_name.required' => 'Event Name is required',
            'event_budget.required' => 'Event Budget is required',
            'committee_id.required' => 'Committee is required',
            'event_start_date.required' => 'Event Starting Date is required',
            'event_start_time.required' => 'Event Starting Time is required',
            'event_loaction.required' => 'Event Location is required',
            'event_status.required' => 'Event Status is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;
        $event_budget = number_format($request->event_budget, 2, '.', '');
        $startTime = \Carbon\Carbon::createFromFormat('h:i A', $request->event_start_time)->format('H:i:s');
        $endTime = \Carbon\Carbon::createFromFormat('h:i A', $request->event_end_time)->format('H:i:s');

        $event = DB::table('society_events')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'committee_id'=>$request->committee_id,
                            'event_name'=>$request->event_name,
                            'event_budget'=>$event_budget,
                            'event_start_date'=>$request->event_start_date,
                            'event_end_date'=>$request->event_end_date,
                            'event_start_time'=>$startTime,
                            'event_end_time'=>$endTime,
                            'event_description'=>$request->event_description,
                            'event_loaction'=>$request->event_loaction,
                            'event_status'=>$request->event_status
                            ]);

        return redirect()->route('society_events.index')->with('success_message', 'Events is added successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('societymanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user_company_id = Auth::user()->company_id;
        $event = DB::table('society_events')
                    ->leftJoin('society_committees','society_events.committee_id','society_committees.id')
                    ->select('society_committees.name as committee_name','society_events.*')
                    ->where('society_events.id',$id)
                    ->first();

        $committees = DB::table('society_committees')
                        ->where('company_id',$user_company_id)
                        ->where('active_status',1)
                        ->get();
                        
        
        return view('societymanagement::society_events.edit',compact('event','committees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $rules = [
            'event_name' => 'required|string',
            'event_budget' => 'required|numeric',
            'committee_id' => 'required|numeric',
            'event_start_date' => 'required|date',
            'event_start_time' => 'required',
            'event_loaction' => 'required|string|max:255',
            'event_status' => 'required|numeric'
        ];

        $customMessages = [
            'event_name.required' => 'Event Name is required',
            'event_budget.required' => 'Event Budget is required',
            'committee_id.required' => 'Committee is required',
            'event_start_date.required' => 'Event Starting Date is required',
            'event_start_time.required' => 'Event Starting Time is required',
            'event_loaction.required' => 'Event Location is required',
            'event_status.required' => 'Event Status is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data = array();
        $data['committee_id'] = $request->committee_id;
        $data['event_name'] = $request->event_name;
        $data['event_budget'] = $request->event_budget;
        $data['event_start_date'] = $request->event_start_date;
        $data['event_end_date'] = $request->event_end_date;
        $data['event_start_time'] = $request->event_start_time;
        $data['event_end_time'] = $request->event_end_time;
        $data['event_description'] = $request->event_description;
        $data['event_loaction'] = $request->event_loaction;
        $data['event_status'] = $request->event_status;
        // $data['member_image'] = $imageFile;

        $updated = DB::table('society_events')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Event Information is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Event Information failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $event = DB::table('society_events')->where('id', $id)->first();
            if (!$event) {
                return response()->json(['success' => false, 'message' => 'Event not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_events')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Event has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Event.']);
        }
    }
}
