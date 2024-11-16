<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SocietyEventSponsorshipController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        if ($request->ajax()){
      
            $user_company_id = Auth::user()->company_id;

            $event_sponsorships = DB::table('society_event_sponsorships')
                          ->leftJoin('society_events','society_event_sponsorships.event_id','society_events.id')
                        ->select(
                            'society_events.event_name',
                            'society_event_sponsorships.id',
                            'society_event_sponsorships.sponsor_name',
                            'society_event_sponsorships.contact_number',
                            'society_event_sponsorships.contribution_amount',
                            'society_event_sponsorships.money_collection_date',
                            'society_event_sponsorships.payment_status'                           
                            )
                        ->where('society_event_sponsorships.company_id', $user_company_id)
                        ->get();

        
        return DataTables::of($event_sponsorships)
        ->addIndexColumn()
        ->addColumn('payment_status_label', function ($row) {
            if($row->payment_status == 1){
                return '<span style = "color : #2b0d99;">Pending</span>';
            }else{
                return '<span style = "color : green;">Collected</span>' ;
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('event_sponsorships.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('event_sponsorships.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['payment_status_label','action'])
        ->make(true);
        }
        return view('societymanagement::event_sponsorships.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_company_id = Auth::user()->company_id;

        $events = DB::table('society_events')
                    ->where('company_id',$user_company_id)
                    ->where('event_status','<>',3)
                    ->get();

        return view('societymanagement::event_sponsorships.create',compact('events',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'event_id' => 'required|numeric',
            'sponsor_name' => 'required|string',
            'contact_number' => 'required|string',
            'contribution_amount' => 'required|numeric',
            'money_collection_date' => 'required|date',
            'payment_status' => 'required|numeric'
        ];

        $customMessages = [
            'event_id.required' => 'Event Name is required',
            'sponsor_name.required' => 'Sponsor Name is required',
            'contact_number.required' => 'Sponsor Contact Number is required',
            'contribution_amount.required' => 'Sponsor Contribution Amount is required',
            'money_collection_date.required' => 'Amount Collection Date is required',
            'payment_status.required' => 'Payment Status is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;

        $event_sponsorship = DB::table('society_event_sponsorships')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'event_id'=>$request->event_id,
                            'sponsor_name'=>$request->sponsor_name,
                            'contact_number'=>$request->contact_number,
                            'contribution_amount'=>$request->contribution_amount,
                            'money_collection_date'=>$request->money_collection_date,
                            'contribution_amount'=>$request->contribution_amount,
                            'payment_status'=>$request->payment_status
                            ]);

        return redirect()->route('event_sponsorships.index')->with('success_message', 'Sponsorship information is collected successfully!');
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

        $events = DB::table('society_events')
                    ->where('company_id',$user_company_id)
                    ->where('event_status','<>',3)
                    ->get();

        $event_sponsorship = DB::table('society_event_sponsorships')
                    ->leftJoin('society_events','society_event_sponsorships.event_id','society_events.id')
                  ->select(
                      'society_events.event_name',
                      'society_event_sponsorships.id',
                      'society_event_sponsorships.event_id',
                      'society_event_sponsorships.sponsor_name',
                      'society_event_sponsorships.contact_number',
                      'society_event_sponsorships.contribution_amount',
                      'society_event_sponsorships.money_collection_date',
                      'society_event_sponsorships.payment_status'
                      )
                  ->where('society_event_sponsorships.id', $id)
                  ->first();

        return view('societymanagement::event_sponsorships.edit',compact('events','event_sponsorship'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'event_id' => 'required|numeric',
            'sponsor_name' => 'required|string',
            'contact_number' => 'required|string',
            'contribution_amount' => 'required|numeric',
            'money_collection_date' => 'required|date',
            'payment_status' => 'required|numeric'
        ];

        $customMessages = [
            'event_id.required' => 'Event Name is required',
            'sponsor_name.required' => 'Sponsor Name is required',
            'contact_number.required' => 'Sponsor Contact Number is required',
            'contribution_amount.required' => 'Sponsor Contribution Amount is required',
            'money_collection_date.required' => 'Amount Collection Date is required',
            'payment_status.required' => 'Payment Status is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data = array();
        $data['event_id'] = $request->event_id;
        $data['sponsor_name'] = $request->sponsor_name;
        $data['contact_number'] = $request->contact_number;
        $data['contribution_amount'] = $request->contribution_amount;
        $data['money_collection_date'] = $request->money_collection_date;
        $data['payment_status'] = $request->payment_status;

        // return response()->json($data);
        
        $updated = DB::table('society_event_sponsorships')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Sponsorship Information is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Sponsorship Information failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $event_sponsorship = DB::table('society_event_sponsorships')->where('id', $id)->first();
            if (!$event_sponsorship) {
                return response()->json(['success' => false, 'message' => 'Event Sponsorship not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_event_sponsorships')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Event Sponsorship has been deleted successfully!']);
            } catch (\Exception $e) {
                // If an error occurs, return an error response
                return response()->json(['success' => false, 'message' => 'Error deleting Event Sponsorship.']);
            }
    }
}
