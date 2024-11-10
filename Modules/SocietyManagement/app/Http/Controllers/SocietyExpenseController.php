<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SocietyExpenseController extends Controller
{
    use ValidatesRequests;

    //----- **** expense type (start) ****** ------
    public function society_expense_type_list(){

        $user_company_id = Auth::user()->company_id;
        $society_expenses = DB::table('society_expense_types')
                               ->where('company_id',$user_company_id)
                               ->get();
    return view('societymanagement::expense_types.index',compact('society_expenses'));
    }

    public function create_society_expense_type(){
        return view('societymanagement::expense_types.create');
    
    }

    public function store_society_expense_type(Request $request){

        $rules = [
            'type_name' => 'required|string',
            'active_status' => 'required|numeric'
        ];

        $customMessages = [
            'type_name.required' => 'Expense Type Name is required',
            'active_status.required' => 'Status is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;
        $society_expense = DB::table('society_expense_types')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'type_name'=>$request->type_name,
                            'active_status'=>$request->active_status
                            ]);

        return redirect()->route('society_expense_type_list')->with('success_message', 'Expense Type is added successfully!');

    }

    public function edit_society_expense_type($id){
        $society_expense = DB::table('society_expense_types')
                              ->where('id',$id)
                              ->first();

        return view('societymanagement::expense_types.edit',compact('society_expense'));
    }


    public function update_society_expense_type(Request $request, $id){
        $rules = [
            'type_name' => 'required|string',
            'active_status' => 'required|numeric'
        ];

        $customMessages = [
            'type_name.required' => 'Expense Type Name is required',
            'active_status.required' => 'Status is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data = array();    
        $data['type_name'] = $request->type_name;
        $data['active_status'] = $request->active_status;
        
        
        $updated = DB::table('society_expense_types')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Society Expense Type is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Society Expense Type failed or no changes were made');
        }
    }

    public function destroy_society_expense_type($id){
        try {
            // Check if the branch exists using Query Builder
            $society_expense_type = DB::table('society_expense_types')->where('id', $id)->first();
            if (!$society_expense_type) {
                return response()->json(['success' => false, 'message' => 'Society Expense Type is not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_expense_types')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Society Expense Type has been deleted successfully!']);
            } catch (\Exception $e) {
                // If an error occurs, return an error response
                return response()->json(['success' => false, 'message' => 'Error deleting Society Expense Type.']);
            }
            
    }

    //----- **** expense type (end) ****** ------
    
    
    
    public function index(Request $request)
    {
        if ($request->ajax()){
      
            $user_company_id = Auth::user()->company_id;

            $society_expenses = DB::table('society_expenses')
                          ->leftJoin('society_expense_types','society_expenses.expense_type_id','society_expense_types.id')
                        ->select(
                            'society_expenses.id',
                            'society_expenses.expense_name',
                            'society_expenses.expense_date',
                            'society_expenses.description',
                            'society_expenses.expense_amount',
                            'society_expense_types.type_name'                           
                            )
                        ->where('society_expenses.company_id', $user_company_id)
                        ->get();

        
        return DataTables::of($society_expenses)
        ->addIndexColumn()    
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('society_expenses.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('society_expenses.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        
        return view('societymanagement::expenses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('societymanagement::create');
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
        return view('societymanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('societymanagement::edit');
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
