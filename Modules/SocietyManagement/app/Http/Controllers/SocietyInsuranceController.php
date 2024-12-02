<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SocietyInsuranceController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        if ($request->ajax()){
      
            $user_company_id = Auth::user()->company_id;

            $society_insurances = DB::table('society_insurances')
                          ->leftJoin('society_members','society_insurances.member_id','society_members.id')
                        ->select(
                            'society_insurances.id',
                            'society_insurances.policy_number',
                            'society_insurances.provider',
                            'society_insurances.start_date',
                            'society_insurances.end_date',
                            'society_insurances.premium_amount',
                            'society_insurances.status as insurance_status',
                            'society_members.name as member_name'
                            )
                        ->where('society_insurances.company_id', $user_company_id)
                        ->get();

        
        return DataTables::of($society_insurances)
        ->addIndexColumn()
        ->addColumn('status_label', function ($row) {
            if($row->insurance_status == 1){
                return '<span style = "color : green;">Active</span>';
            }else{
                return '<span style = "color : red;">Expired</span>' ;
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('society_insurances.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('society_insurances.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['status_label','action'])
        ->make(true);
        }

        return view('societymanagement::insurances.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $user_company_id = Auth::user()->company_id;

        $members = DB::table('society_members')
                    ->where('company_id',$user_company_id)
                    ->where('active_status',1)
                    ->get();
        
        return view('societymanagement::insurances.create',compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'member_id' => 'required|numeric',
            'policy_number' => 'required|unique:society_insurances',
            'provider' => 'required|string',        
            'start_date' => 'required|date',
            'premium_amount' => 'required|numeric',
            'status' => 'required|numeric'
        ];

        $customMessages = [
            'member_id.required' => 'Member Name is required',
            'policy_number.required' => 'Policy Number is required',
            'provider.required' => 'Provider Name is required',
            'start_date.required' => 'Insurance Start Date is required',
            'premium_amount.required' => 'Insurance Amount is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;

        $insurance = DB::table('society_insurances')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'member_id'=>$request->member_id,
                            'policy_number'=>$request->policy_number,
                            'provider'=>$request->provider,
                            'start_date'=>$request->start_date,
                            'end_date'=>$request->end_date,
                            'premium_amount'=>$request->premium_amount,
                            'coverage_details'=>$request->coverage_details,
                            'status'=>$request->status
                            ]);

        return redirect()->route('society_insurances.index')->with('success_message', 'Insurance details are stored successfully!');
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
        $insurance = DB::table('society_insurances')
                        ->where('id',$id)
                        ->first();
        
        $user_company_id = Auth::user()->company_id;
        $members = DB::table('society_members')
                    ->where('company_id',$user_company_id)
                    ->where('active_status',1)
                    ->get();

        return view('societymanagement::insurances.edit', compact('insurance','members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        

        $data = array();
        $data['member_id'] = $request->member_id;
        $data['policy_number'] = $request->policy_number;
        $data['provider'] = $request->provider;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['premium_amount'] = $request->premium_amount;
        $data['coverage_details'] = $request->coverage_details;
        $data['status'] = $request->status;

        
        $updated = DB::table('society_insurances')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Insurance details is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Insurance details failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $event = DB::table('society_insurances')->where('id', $id)->first();
            if (!$event) {
                return response()->json(['success' => false, 'message' => 'Insurance details are not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_insurances')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Insurance details has been deleted successfully!']);
            } catch (\Exception $e) {
                // If an error occurs, return an error response
                return response()->json(['success' => false, 'message' => 'Error deleting Insurance details.']);
            }
    }
}
