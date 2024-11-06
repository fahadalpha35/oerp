<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommitteeMemberController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        if ($request->ajax()){
      
            $user_company_id = Auth::user()->company_id;

            $members = DB::table('society_committee_members')
                         ->leftJoin('society_members','society_committee_members.member_id','society_members.id')
                         ->leftJoin('society_committees','society_committee_members.committee_id','society_committees.id')
                        ->select(
                            'society_committee_members.id',
                            'society_members.member_unique_id as member_unique_id',
                            'society_members.name as member_name',
                            'society_committee_members.committee_member_designation as member_designation',
                            'society_committees.name as committee_name'
                            )
                        ->where('society_committees.company_id', $user_company_id)
                        ->get();

        
        return DataTables::of($members)
        ->addIndexColumn()

        ->addColumn('action', function($row){
            $btn = '<a href="'.route('committee_members.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('committee_members.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        
        return view('societymanagement::committee_members.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_company_id = Auth::user()->company_id;

        $society_members = DB::table('society_members')
                              ->where('company_id',$user_company_id)
                              ->where('active_status',1)
                              ->get();
        $committees = DB::table('society_committees')
                        ->where('company_id',$user_company_id)
                        ->where('active_status',1)
                        ->get();
                      
        return view('societymanagement::committee_members.create',compact('society_members','committees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'committee_id' => 'required|numeric',
            'member_id' => 'required|numeric',
            'committee_member_designation' => 'required|string',
        ];

        $customMessages = [
            'committee_id.required' => 'Committee is required',
            'member_id.required' => 'Member is required',
            'committee_member_designation.required' => 'Designation is required',
        ];

        $this->validate($request, $rules, $customMessages);

        
        $committee_member = DB::table('society_committee_members')
                            ->insertGetId([
                            'member_id'=>$request->member_id,
                            'committee_id'=>$request->committee_id,
                            'committee_member_designation'=>$request->committee_member_designation
                            ]);

        return redirect()->route('committee_members.index')->with('success_message', 'Committee Member is added successfully!');
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
        $committee_member = DB::table('society_committee_members')
                                ->leftJoin('society_members','society_committee_members.member_id','society_members.id')
                                ->leftJoin('society_committees','society_committee_members.committee_id','society_committees.id')
                                ->select(
                                    'society_committee_members.*',
                                    'society_members.member_unique_id as member_unique_id',
                                    'society_members.name as member_name',
                                    'society_committees.name as committee_name')
                                ->where('society_committee_members.id',$id)
                                ->first();

        $user_company_id = Auth::user()->company_id;

        // $society_members = DB::table('society_members')
        //                     ->where('company_id',$user_company_id)
        //                     ->where('active_status',1)
        //                     ->get();
        $committees = DB::table('society_committees')
                        ->where('company_id',$user_company_id)
                        ->where('active_status',1)
                        ->get();
        
        return view('societymanagement::committee_members.edit',compact('committee_member','committees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'committee_id' => 'required|numeric',
            'committee_member_designation' => 'required|string',
        ];

        $customMessages = [
            'committee_id.required' => 'Committee is required',
            'committee_member_designation.required' => 'Designation is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $data = array();
        $data['committee_id'] = $request->committee_id;
        $data['committee_member_designation'] = $request->committee_member_designation;
       
        $updated = DB::table('society_committee_members')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Information is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Information failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $member = DB::table('society_committee_members')->where('id', $id)->first();

            if (!$member) {
                return response()->json(['success' => false, 'message' => 'Member not found.'], 404);
            }

            // Delete the branch using Query Builder
            DB::table('society_committee_members')->where('id', $id)->delete();

            // Return a success response
            return response()->json(['success' => true, 'message' => 'Committee Member has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Committee Member.']);
        }
    }
}
