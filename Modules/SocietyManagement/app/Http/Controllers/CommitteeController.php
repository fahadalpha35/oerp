<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommitteeController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        if($user_role_id == 1){

            $committees = DB::table('society_committees')
                            ->leftJoin('companies','society_committees.company_id','companies.id')
                            ->select('society_committees.*','companies.company_name as company_name')
                            ->get();

            return view('societymanagement::committees.index',compact('committees'));

        }else{
            $committees = DB::table('society_committees')
                            ->leftJoin('companies','society_committees.company_id','companies.id')
                            ->select('society_committees.*','companies.company_name as company_name')
                            ->where('society_committees.company_id',$user_company_id)
                            ->get();
            return view('societymanagement::committees.index',compact('committees'));
        }
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('societymanagement::committees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'start_date' => 'required|date',
            'active_status' => 'required|numeric',
        ];

        $customMessages = [
            'name.required' => 'Committee Name is required',
            'start_date.required' => 'Committee Starting Date is required',
            'active_status.required' => 'Activation Status is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;

        $committee = DB::table('society_committees')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'name'=>$request->name,
                            'description'=>$request->description,
                            'start_date'=>$request->start_date,
                            'end_date'=>$request->end_date,
                            'active_status'=>$request->active_status
                            ]);

        return redirect()->route('society_committees.index')->with('success_message', 'Committee is added successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        
        $committee = DB::table('society_committees')
                        ->select('id','name','active_status')
                        ->where('id',$id)
                        ->first();

        $committee_id = $committee->id;
                        
        $committee_members = DB::table('society_committee_members') 
                                ->leftJoin('society_members','society_committee_members.member_id','society_members.id')
                                ->select(
                                    'society_committee_members.committee_member_designation',
                                    'society_members.name as member_name'
                                    )
                                ->where('society_committee_members.committee_id',$committee_id)
                                ->get();
        
        return view('societymanagement::committees.view',compact('committee','committee_members'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $committee = DB::table('society_committees')->where('id',$id)->first();

        
        return view('societymanagement::committees.edit',compact('committee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'start_date' => 'required|date',
            'active_status' => 'required|numeric',
        ];

        $customMessages = [
            'name.required' => 'Committee Name is required',
            'start_date.required' => 'Committee Starting Date is required',
            'active_status.required' => 'Activation Status is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $data = array();
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['active_status'] = $request->active_status;
        // $data['member_image'] = $imageFile;

        $updated = DB::table('society_committees')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Committee Information is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Committee Information failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $department = DB::table('society_committees')->where('id', $id)->first();
            if (!$department) {
                return response()->json(['success' => false, 'message' => 'Committee not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_committees')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Committee has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Committee.']);
        }
    }
}
