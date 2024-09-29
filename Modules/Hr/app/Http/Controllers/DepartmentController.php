<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class DepartmentController extends Controller
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

            $departments = DB::table('hr_departments')
                            ->leftJoin('companies','hr_departments.company_id','companies.id')
                            ->leftJoin('hr_branches','hr_departments.branch_id','hr_branches.id')
                            ->select('hr_departments.*','companies.company_name as company_name','hr_branches.br_name as branch_name')
                            ->get();

            return view('hr::departments.index',compact('departments'));

        }else{
            $departments = DB::table('hr_departments')
                            ->leftJoin('companies','hr_departments.company_id','companies.id')
                            ->leftJoin('hr_branches','hr_departments.branch_id','hr_branches.id')
                            ->select('hr_departments.*','companies.company_name as company_name','hr_branches.br_name as branch_name')
                            ->where('hr_departments.company_id',$user_company_id)
                            ->get();
            return view('hr::departments.index',compact('departments'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $user_company_id = Auth::user()->company_id;

        $branches = DB::table('hr_branches')
                    ->where('hr_branches.company_id',$user_company_id)
                    ->where('br_status',1)
                    ->get();

        return view('hr::departments.create',compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $rules = [
            'branch_id' => 'required|numeric',
            'dept_name' => 'required|string',
        ];

        $customMessages = [
            'branch_id.required' => 'Branch is required',
            'dept_name.required' => 'Department Name is required',
        ];

        $this->validate($request, $rules, $customMessages);


        $user_company_id = Auth::user()->company_id;

        $department = DB::table('hr_departments')
                ->insertGetId([
                'company_id'=>$user_company_id,
                'branch_id'=>$request->branch_id,
                'dept_name'=>$request->dept_name,
                'dept_status'=>1
                ]);

        return redirect()->route('departments.index')->with('success_message', 'Department is added successfully!');
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

        $user_company_id = Auth::user()->company_id;

        $branches = DB::table('hr_branches')
        ->where('hr_branches.company_id',$user_company_id)
        ->where('br_status',1)
        ->get();

        $dept = DB::table('hr_departments')
                    ->leftJoin('hr_branches','hr_departments.branch_id','hr_branches.id')
                    ->select('hr_departments.*','hr_branches.br_name as branch_name')
                    ->where('hr_departments.id',$id)
                    ->first();

        // dd($dept);
        return view('hr::departments.edit',compact('branches','dept'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $user_company_id = Auth::user()->company_id;

        $data = array();
        $data['dept_name'] = $request->input('dept_name');
        $data['branch_id'] = $request->input('branch_id');
        $data['dept_status'] = $request->input('dept_status');

        $updated = DB::table('hr_departments')
                        ->where('id', $id)
                        ->update($data);

         // Check if the update was successful
         if ($updated) {
            // Return a success response
            return redirect()->back()->with('success_message', 'Department is updated successfully!');
        } else {
            // Return a failure response
            return redirect()->back()->with('error_message', 'Department update failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $department = DB::table('hr_departments')->where('id', $id)->first();

            if (!$department) {
                return response()->json(['success' => false, 'message' => 'Department not found.'], 404);
            }

            // Delete the branch using Query Builder
            DB::table('hr_departments')->where('id', $id)->delete();

            // Return a success response
            return response()->json(['success' => true, 'message' => 'Department has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Department.']);
        }
    }
}
