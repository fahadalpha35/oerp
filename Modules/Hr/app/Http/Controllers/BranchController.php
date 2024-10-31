<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     use ValidatesRequests;

    public function index(Request $request)
    {

        $user_company_id = Auth::user()->company_id;
        $user_role = Auth::user()->role_id;


        if ($request->ajax()) {

        if($user_role == 1){
            $branches = DB::table('hr_branches')
                            ->leftJoin('companies','hr_branches.company_id','companies.id')
                            ->select('hr_branches.*','companies.company_name as company_name')
                            ->get();

        return DataTables::of($branches)
            ->addColumn('branch_type_label', function ($row) {
                return $row->br_type == 1 ? 'Head Office' : 'Single Branch';
            })
            ->addColumn('branch_status_label', function ($row) {
                return $row->br_status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('branches.edit', $row->id) . '" class="btn btn-warning">Edit</a>
                    <a onclick="deleteBranch(' . $row->id . ')" class="btn btn-danger">Delete</a>
                ';
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->search['value']) {
                    $searchTerm = $request->search['value'];

                    // Check for Head Office/Single Branch search
                    $branchType = null;
                    if (strtolower($searchTerm) === 'head office') {
                        $branchType = 1; // Head Office
                    } elseif (strtolower($searchTerm) === 'single branch') {
                        $branchType = 2; // Single Branch
                    }

                    // Check for Active/Inactive search
                    $searchStatus = null;
                    if (strtolower($searchTerm) === 'active') {
                        $searchStatus = 1; // Active
                    } elseif (strtolower($searchTerm) === 'inactive') {
                        $searchStatus = 2; // Inactive
                    }

                    // Perform the search
                    $query->where(function ($q) use ($searchTerm, $branchType, $searchStatus) {
                        $q->where('hr_branches.br_name', 'like', "%{$searchTerm}%")
                          ->orWhere('companies.company_name', 'like', "%{$searchTerm}%");

                        // If it's a search for Head Office/Single Branch, add type condition
                        if (!is_null($branchType)) {
                            $q->orWhere('hr_branches.br_type', 'like', "%{$branchType}%");
                        }

                        // If it's a search for Active/Inactive, add status condition
                        if (!is_null($searchStatus)) {
                            $q->orWhere('hr_branches.br_status', 'like', "%{$searchStatus}%");
                        }
                    });
                }
            })
            ->make(true);

        }else{
            $branches = DB::table('hr_branches')
            ->leftJoin('companies', 'hr_branches.company_id', 'companies.id')
            ->select('hr_branches.*', 'companies.company_name as company_name')
            ->where('hr_branches.company_id', $user_company_id);

        return DataTables::of($branches)
            ->addColumn('branch_type_label', function ($row) {
                return $row->br_type == 1 ? 'Head Office' : 'Single Branch';
            })
            ->addColumn('branch_status_label', function ($row) {
                return $row->br_status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('branches.edit', $row->id) . '" class="btn btn-warning"> Edit</a>
                    <a onclick="deleteOperation(\''.route('branches.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')" class="btn btn-danger"> Delete</a>
                ';
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->search['value']) {
                    $searchTerm = $request->search['value'];

                    // Check for Head Office/Single Branch search
                    $branchType = null;
                    if (strtolower($searchTerm) === 'head office') {
                        $branchType = 1; // Head Office
                    } elseif (strtolower($searchTerm) === 'single branch') {
                        $branchType = 2; // Single Branch
                    }

                    // Check for Active/Inactive search
                    $searchStatus = null;
                    if (strtolower($searchTerm) === 'active') {
                        $searchStatus = 1; // Active
                    } elseif (strtolower($searchTerm) === 'inactive') {
                        $searchStatus = 2; // Inactive
                    }

                    // Perform the search
                    $query->where(function ($q) use ($searchTerm, $branchType, $searchStatus) {
                        $q->where('hr_branches.br_name', 'like', "%{$searchTerm}%")
                          ->orWhere('companies.company_name', 'like', "%{$searchTerm}%");

                        // If it's a search for Head Office/Single Branch, add type condition
                        if (!is_null($branchType)) {
                            $q->orWhere('hr_branches.br_type', 'like', "%{$branchType}%");
                        }

                        // If it's a search for Active/Inactive, add status condition
                        if (!is_null($searchStatus)) {
                            $q->orWhere('hr_branches.br_status', 'like', "%{$searchStatus}%");
                        }
                    });
                }
            })
            ->make(true);
        }

    }

    return view('hr::branches.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hr::branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $rules = [
            'br_name' => 'required|string',
            'br_address' => 'required|string',
            'br_type' => 'required|numeric',
            'br_status' => 'required|numeric',
        ];

        $customMessages = [
            'br_name.required' => 'Branch Name is required',
            'br_address.required' => 'Branch Address is required',
            'br_type.required' => 'Branch Type is required',
            'br_status.required' => 'Branch Status is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;

        $branch = DB::table('hr_branches')
        ->insertGetId([
        'company_id'=>$user_company_id,
        'br_name'=>$request->br_name,
        'br_address'=>$request->br_address,
        'br_type'=>$request->br_type,
        'br_status'=>$request->br_status,
        'longitude'=>$request->longitude,
        'latitude'=>$request->latitude
        ]);

        return redirect()->route('branches.index')->with('success_message', 'Branch is added successfully!');

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

        $branch = DB::table('hr_branches')
                  ->where('id',$id)
                  ->first();

        return view('hr::branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $user_company_id = Auth::user()->company_id;

        $data = array();
        $data['company_id'] = $user_company_id;
        $data['br_name'] = $request->input('br_name');
        $data['br_address'] = $request->input('br_address');
        $data['br_type'] = $request->input('br_type');
        $data['br_status'] = $request->input('br_status');
        $data['longitude'] = $request->input('longitude');
        $data['latitude'] = $request->input('latitude');

        $updated = DB::table('hr_branches')
                        ->where('id', $id)
                        ->update($data);

         // Check if the update was successful
         if ($updated) {
            // Return a success response
            return redirect()->back()->with('success_message', 'Branch is updated successfully!');
        } else {
            // Return a failure response
            return redirect()->back()->with('error_message', 'Branch update failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $branch = DB::table('hr_branches')->where('id', $id)->first();

            if (!$branch) {
                return response()->json(['success' => false, 'message' => 'Branch not found.'], 404);
            }

            // Delete the branch using Query Builder
            DB::table('hr_branches')->where('id', $id)->delete();

            // Return a success response
            return response()->json(['success' => true, 'message' => 'Branch has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting branch.']);
        }
    }
}
