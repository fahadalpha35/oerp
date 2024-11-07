<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class FundCollectionController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        if ($request->ajax()){
      
            $user_company_id = Auth::user()->company_id;

            $fund_collections = DB::table('society_fund_collections')
                          ->leftJoin('society_events','society_fund_collections.event_id','society_events.id')
                          ->leftJoin('society_members','society_fund_collections.society_member_id','society_members.id')
                        ->select(
                            'society_fund_collections.id',
                            'society_events.event_name',
                            'society_fund_collections.description',
                            'society_members.name as member_name',                          
                            'society_fund_collections.fund_amount',
                            'society_fund_collections.fund_collection_date',
                            'society_fund_collections.fund_collection_status'
                            )
                        ->where('society_fund_collections.company_id', $user_company_id)
                        ->get();

        
        return DataTables::of($fund_collections)
        ->addIndexColumn()
        ->addColumn('fund_collection_status_label', function ($row) {
            if($row->fund_collection_status == 1){
                return '<span style = "color : #2b0d99;">Pending</span>';
            }else{
                return '<span style = "color : green;">Collected</span>' ;
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('fund_collections.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('fund_collections.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['fund_collection_status_label','action'])
        ->make(true);
        }
        
        return view('societymanagement::fund_collections.index');
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

        $members = DB::table('society_members')
                    ->where('company_id',$user_company_id)
                    ->where('active_status',1)
                    ->get();

        
        
        return view('societymanagement::fund_collections.create',compact('events','members'));
    }

   
    public function store(Request $request)
    {
        $rules = [
            'purpose' => 'required|numeric',
            'society_member_id' => 'required|numeric',
            'fund_amount' => 'required|numeric',
            'fund_collection_date' => 'required|date',
            'fund_collection_status' => 'required|numeric'
        ];

        $customMessages = [
            'purpose.required' => 'Fund Collection Type is required',
            'society_member_id.required' => 'Member is required',
            'fund_amount.required' => 'Fund Amount is required',
            'fund_collection_date.required' => 'Fund Collection Date is required',
            'fund_collection_status.required' => 'Fund Collection Status is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;

        $fund_collection = DB::table('society_fund_collections')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'event_id'=>$request->event_id,
                            'society_member_id'=>$request->society_member_id,
                            'purpose'=>$request->purpose,
                            'description'=>$request->description,
                            'fund_amount'=>$request->fund_amount,
                            'fund_collection_date'=>$request->fund_collection_date,
                            'fund_collection_status'=>$request->fund_collection_status
                            ]);

        return redirect()->route('fund_collections.index')->with('success_message', 'Fund is collected successfully!');

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

        $members = DB::table('society_members')
                    ->where('company_id',$user_company_id)
                    ->where('active_status',1)
                    ->get();

        $fund_collection = DB::table('society_fund_collections')
                    ->leftJoin('society_events','society_fund_collections.event_id','society_events.id')
                    ->leftJoin('society_members','society_fund_collections.society_member_id','society_members.id')
                  ->select(
                      'society_fund_collections.id',
                      'society_fund_collections.event_id',
                      'society_events.event_name',
                      'society_fund_collections.description',
                      'society_fund_collections.society_member_id as society_member_id',                          
                      'society_members.name as member_name',                         
                      'society_fund_collections.fund_amount',
                      'society_fund_collections.fund_collection_date',
                      'society_fund_collections.fund_collection_status'
                      )
                  ->where('society_fund_collections.id', $id)
                  ->first();

        
        return view('societymanagement::fund_collections.edit',compact('members','events','fund_collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'society_member_id' => 'required|numeric',
            'fund_amount' => 'required|numeric',
            'fund_collection_date' => 'required|date',
            'fund_collection_status' => 'required|numeric'
        ];

        $customMessages = [
            'society_member_id.required' => 'Member is required',
            'fund_amount.required' => 'Fund Amount is required',
            'fund_collection_date.required' => 'Fund Collection Date is required',
            'fund_collection_status.required' => 'Fund Collection Status is required'
        ];
        $this->validate($request, $rules, $customMessages);

        $data = array();    
        $data['event_id'] = $request->event_id;
        $data['society_member_id'] = $request->society_member_id;
        $data['description'] = $request->description;
        $data['fund_amount'] = $request->fund_amount;
        $data['fund_collection_date'] = $request->fund_collection_date;
        $data['fund_collection_status'] = $request->fund_collection_status;
        
        $updated = DB::table('society_fund_collections')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Collected Fund Information is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Collected Fund Information failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $event = DB::table('society_fund_collections')->where('id', $id)->first();
            if (!$event) {
                return response()->json(['success' => false, 'message' => 'Fund not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_fund_collections')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Collected Fund has been deleted successfully!']);
            } catch (\Exception $e) {
                // If an error occurs, return an error response
                return response()->json(['success' => false, 'message' => 'Error deleting Collected Fund.']);
            }
    }
}
