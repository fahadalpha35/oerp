<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     use ValidatesRequests;
    public function index()
    {
        
        $user_company_id = Auth::user()->company_id;
        $user_role_id = Auth::user()->role_id;

        if($user_role_id == 1){
            $designations = DB::table('hr_designations')->get();
            return view('hr::designations.index',compact('designations'));
        }else{
            $designations = DB::table('hr_designations')
                            ->where('company_id',$user_company_id)
                            ->get();
            return view('hr::designations.index',compact('designations'));
        }
        
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hr::designations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'level' => 'required|numeric',
            'designation_name' => 'required|string',
        ];

        $customMessages = [
            'level.required' => 'Level is required',
            'designation_name.required' => 'Designation is required',
        ];

        $this->validate($request, $rules, $customMessages);
        
        $user_company_id = Auth::user()->company_id;

        $designation = DB::table('hr_designations')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'level'=>$request->level,
                'designation_name'=>$request->designation_name
                ]);

        return redirect()->route('designations.index')->with('success_message', 'Designation is added successfully!');
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
        $designation = DB::table('hr_designations')
                        ->where('id',$id)
                        ->first();    
        return view('hr::designations.edit',compact('designation'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $data = array();
        $data['level'] = $request->input('level');
        $data['designation_name'] = $request->input('designation_name');

        $updated = DB::table('hr_designations')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
        if ($updated) {
            // Return a success response
            return redirect()->back()->with('success_message', 'Designation is updated successfully!');
        } else {
            // Return a failure response
            return redirect()->back()->with('error_message', 'Designation update failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $designation = DB::table('hr_designations')->where('id', $id)->first();
    
            if (!$designation) {
                return response()->json(['success' => false, 'message' => 'Designation not found.'], 404);
            }
    
            // Delete the branch using Query Builder
            DB::table('hr_designations')->where('id', $id)->delete();
    
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Designation has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Designation.']);
        }
    }
}
