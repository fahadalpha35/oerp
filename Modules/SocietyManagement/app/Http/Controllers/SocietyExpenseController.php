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
            return redirect()->back()->with('success_message', 'Expense Type is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Expense Type failed or no changes were made');
        }
    }

    public function destroy_society_expense_type($id){
        try {
            // Check if the branch exists using Query Builder
            $society_expense_type = DB::table('society_expense_types')->where('id', $id)->first();
            if (!$society_expense_type) {
                return response()->json(['success' => false, 'message' => 'Expense Type is not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_expense_types')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Expense Type has been deleted successfully!']);
            } catch (\Exception $e) {
                // If an error occurs, return an error response
                return response()->json(['success' => false, 'message' => 'Error deleting Expense Type.']);
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
        $user_company_id = Auth::user()->company_id;
        
        $society_expense_types = DB::table('society_expense_types')
                                   ->select('id','company_id','type_name','active_status')
                                   ->where('active_status',1)
                                   ->where('company_id',$user_company_id)
                                   ->get();
        
        return view('societymanagement::expenses.create',compact('society_expense_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'expense_type_id' => 'required|numeric',
            'expense_name' => 'required|string',
            'expense_date' => 'required|date',
            'expense_amount' => 'required|numeric'
        ];

        $customMessages = [
            'expense_type_id.required' => 'Expense Type is required',
            'expense_name.required' => 'Expense Name is required',
            'expense_date.required' => 'Date of Expense is required',
            'expense_amount.required' => 'Expense Amount is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;
        $society_expense = DB::table('society_expenses')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'expense_type_id'=>$request->expense_type_id,
                            'expense_name'=>$request->expense_name,
                            'expense_date'=>$request->expense_date,
                            'description'=>$request->description,
                            'expense_amount'=>$request->expense_amount
                            ]);

        return redirect()->route('society_expenses.index')->with('success_message', 'Expense is added successfully!');
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
        $expense = DB::table('society_expenses')
                      ->leftJoin('society_expense_types','society_expenses.expense_type_id','society_expense_types.id')
                      ->select('society_expense_types.type_name as expense_type_name','society_expenses.*')
                      ->where('society_expenses.id',$id)
                      ->first();

        $user_company_id = Auth::user()->company_id;
        
        $society_expense_types = DB::table('society_expense_types')
                                    ->select('id','company_id','type_name','active_status')
                                    ->where('active_status',1)
                                    ->where('company_id',$user_company_id)
                                    ->get();
        
        return view('societymanagement::expenses.edit',compact('expense','society_expense_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'expense_type_id' => 'required|numeric',
            'expense_name' => 'required|string',
            'expense_date' => 'required|date',
            'expense_amount' => 'required|numeric'
        ];

        $customMessages = [
            'expense_type_id.required' => 'Expense Type is required',
            'expense_name.required' => 'Expense Name is required',
            'expense_date.required' => 'Date of Expense is required',
            'expense_amount.required' => 'Expense Amount is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data = array();
        $data['expense_type_id'] = $request->expense_type_id;
        $data['expense_name'] = $request->expense_name;
        $data['expense_date'] = $request->expense_date;
        $data['description'] = $request->description;
        $data['expense_amount'] = $request->expense_amount;
        
        $updated = DB::table('society_expenses')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Expense is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Expense failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $expense = DB::table('society_expenses')->where('id', $id)->first();
            if (!$expense) {
                return response()->json(['success' => false, 'message' => 'Expense not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_expenses')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Expense has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Expense.']);
        }
    }
}
