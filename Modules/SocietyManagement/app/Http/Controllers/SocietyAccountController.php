<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;


class SocietyAccountController extends Controller
{
   
    use ValidatesRequests;

    //profit and loss (start)
    public function profit_and_loss()
    {
        return view('societymanagement::accounts.profit_and_loss');
    }


    public function profit_and_loss_data(Request $request){

        $user_company_id = Auth::user()->company_id;

        $year = $request->input('year');
        $month = $request->input('month');


        $total_renewal_fee = DB::table('society_renewal_fees')
                               ->where('company_id',$user_company_id)
                               ->whereYear('payment_date', $year)
                               ->whereMonth('payment_date', $month)
                               ->sum('amount');

        $total_fund_collection = DB::table('society_fund_collections')
                                    ->where('company_id',$user_company_id)
                                    ->whereYear('fund_collection_date', $year)
                                    ->whereMonth('fund_collection_date', $month)
                                    ->sum('fund_amount');


        $total_member_loan_repayment = DB::table('society_loan_repayments')
                                          ->leftJoin('society_member_loans','society_loan_repayments.loan_id','society_member_loans.id')
                                          ->where('society_member_loans.company_id',$user_company_id)
                                          ->whereIn('society_loan_repayments.repayment_status', [2, 3])
                                          ->whereYear('society_loan_repayments.updated_at', $year)
                                          ->whereMonth('society_loan_repayments.updated_at', $month)
                                          ->sum('amount_paid');


        $total_event_ticket_sale = DB::table('society_sold_tickets')
                                        ->where('company_id',$user_company_id)
                                        ->whereYear('ticket_selling_date', $year)
                                        ->whereMonth('ticket_selling_date', $month)
                                        ->sum('total_revenue');


                                    
        $total_income = $total_renewal_fee + $total_fund_collection + $total_member_loan_repayment + $total_event_ticket_sale;

        $expenses = DB::table('society_expenses') 
            ->leftJoin('society_expense_types','society_expenses.expense_type_id','society_expense_types.id')
            ->select(
                'society_expenses.expense_type_id',
                'society_expense_types.type_name',
                DB::raw('SUM(society_expenses.expense_amount) as total_expense_amount')
                )            
            ->where('society_expenses.company_id',$user_company_id)
            ->whereYear('society_expenses.expense_date', $year)
            ->whereMonth('society_expenses.expense_date', $month)
            ->groupBy(
                'society_expenses.expense_type_id',
                'society_expense_types.type_name'
                    )
            ->get();

            $total_expense = $expenses->sum('total_expense_amount');


            if ($total_income >= $total_expense) {

                $profit = $total_income - $total_expense;
                $loss = 0;

                return view('societymanagement::accounts.profit_and_loss_data',compact(
                    'total_renewal_fee',
                    'total_fund_collection',
                    'total_member_loan_repayment',
                    'total_event_ticket_sale',
                    'total_income',
                    'expenses',
                    'total_expense',
                    'profit',
                    'loss',
                    'year',
                    'month'
                ));

            } else {
                $profit = 0; 
                $loss = $total_expense - $total_income;

                return view('societymanagement::accounts.profit_and_loss_data',compact(
                    'total_renewal_fee',
                    'total_fund_collection',
                    'total_member_loan_repayment',
                    'total_event_ticket_sale',
                    'total_income',
                    'expenses',
                    'total_expense',
                    'profit',
                    'loss',
                    'year',
                    'month'
                ));
            }         

    }
    //profit and loss (end)


    //Budget v/s Fund (start)

    public function budget_and_collected_fund(){
        
        $user_company_id = Auth::user()->company_id;

        $events = DB::table('society_events')
                    ->select('id','event_name')
                    ->where('company_id', $user_company_id)
                    ->get();

        return view('societymanagement::accounts.budget_and_collected_fund',compact('events'));
    }


     
     public function budget_and_collected_fund_dependancy(Request $request){

        $selectedEvent = $request->input('data');
        $user_company_id = Auth::user()->company_id;

        $event = DB::table('society_events')
                    ->select('event_name','event_budget')
                    ->where('id',$selectedEvent)
                    ->first();

        $event_name = $event->event_name;
        $event_budget = $event->event_budget;


        $collected_fund = DB::table('society_fund_collections')
                            ->where('event_id',$selectedEvent)
                            ->where('purpose',1)
                            ->where('fund_collection_status',2)
                            ->sum('fund_amount');


        $remaining_amount = $event_budget - $collected_fund;

       
        if ($event) {
            // Return ticket price and available quantity as JSON
            return response()->json([
                'event_name' => $event_name,
                'event_budget' => $event_budget,
                'collected_fund' => $collected_fund,
                'remaining_amount' => $remaining_amount
            ]);
        }
    
        // In case no ticket is found, return a default response
        return response()->json([
            'event_budget' => 0,
            'collected_fund' => 0,
            'remaining_amount' => 0
        ]);
    }
    //Budget v/s Fund (end)



    //account type (start)
    public function society_account_type_list(){

        $user_company_id = Auth::user()->company_id;

        $account_types = DB::table('society_accounts')
                            ->where('company_id',$user_company_id)
                            ->get();

        return view('societymanagement::account_types.index',compact('account_types'));
    }


    public function add_society_account_type(){
        return view('societymanagement::account_types.create');
    }


    public function store_society_account_type(Request $request){


        $rules = [
            'account_name' => 'required|string',
            'accounts_type' => 'required|regex:/^[A-Za-z]$/',
            'transaction_type' => 'required|numeric',
        ];

        $customMessages = [
            'account_name.required' => 'Account Name is required',
            'accounts_type.required' => 'Type is required',
            'transaction_type.required' => 'Transaction Type is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;
        
        $account_type = DB::table('society_accounts')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'account_name'=>$request->account_name,
                            'accounts_type'=>$request->accounts_type,
                            'transaction_type'=>$request->transaction_type
                            ]);

        return redirect()->route('society_account_type_list')->with('success_message', 'Account Type is added successfully!');
    }

    public function edit_society_account_type($id){

        $account_type = DB::table('society_accounts')->where('id',$id)->first();
 
        return view('societymanagement::account_types.edit',compact('account_type'));
    }



    public function update_society_account_type(Request $request, $id)
    {
        $rules = [
            'account_name' => 'required|string',
            'accounts_type' => 'required|regex:/^[A-Za-z]$/',
            'transaction_type' => 'required|numeric',
        ];

        $customMessages = [
            'account_name.required' => 'Account Name is required',
            'accounts_type.required' => 'Type is required',
            'transaction_type.required' => 'Transaction Type is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $data = array();
        $data['account_name'] = $request->account_name;
        $data['accounts_type'] = $request->accounts_type;
        $data['transaction_type'] = $request->transaction_type;

        $updated = DB::table('society_accounts')
                    ->where('id', $id)
                    ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Account Type is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Account Type failed or no changes were made');
        }
    }



    public function delete_society_account_type($id){
        try {
            // Check if the branch exists using Query Builder
            $account_type = DB::table('society_accounts')->where('id', $id)->first();
            if (!$account_type) {
                return response()->json(['success' => false, 'message' => 'Account Type is not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_accounts')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Account Type has been deleted successfully!']);
            } catch (\Exception $e) {
                // If an error occurs, return an error response
                return response()->json(['success' => false, 'message' => 'Error deleting Account Type.']);
            }
            
    }

    //account type (end)


    //transaction (start)
    public function society_transaction_list(Request $request){

        if ($request->ajax()){
      
            $user_company_id = Auth::user()->company_id;

            $society_transactions = DB::table('society_transactions')
                                        ->leftJoin('society_accounts','society_transactions.account_id','society_accounts.id')
                                        ->select(
                                            'society_transactions.id',
                                            'society_transactions.transaction_date',
                                            'society_transactions.transaction_name',
                                            'society_transactions.cost_less',
                                            'society_transactions.transaction_amount',
                                            'society_accounts.account_name'                                                 
                                            )
                                        ->where('society_transactions.company_id', $user_company_id)
                                        ->get();
       
        return DataTables::of($society_transactions)
        ->addIndexColumn()
        ->addColumn('cost_less_type', function ($row) {
            if($row->cost_less == 1){
                return '<span>Yes</span>';
            }else{
                return '<span>No</span>' ;
            }
        })  
        ->addColumn('action', function($row){
            // $btn = '<a href="'.route('edit_society_transaction', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn = '<a href="/edit_society_transaction/'.$row->id.'/" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('delete_society_transaction', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['cost_less_type','action'])
        ->make(true);
        }
        
        return view('societymanagement::transactions.index');
    }


    public function add_society_transaction(){

        $user_company_id = Auth::user()->company_id;

        $account_types = DB::table('society_accounts')
                            ->select('id','account_name')
                            ->where('company_id',$user_company_id)
                            ->get();

        return view('societymanagement::transactions.create',compact('account_types'));
    }


    public function store_society_transaction(Request $request){

        $user_company_id = Auth::user()->company_id;

        $account_ids = $request->account_id;
        $transaction_dates = $request->transaction_date;
        $transaction_names = $request->transaction_name;
        $cost_lesses = $request->cost_less;
        $transaction_amounts = $request->transaction_amount;   

        foreach ($account_ids as $key => $account_id) {
                $transaction_date = $transaction_dates[$key] ?? null;
                $transaction_name = $transaction_names[$key] ?? null;
                $cost_less = $cost_lesses[$key] ?? null; 
                $transaction_amount = $transaction_amounts[$key] ?? null;

            $society_transactions = DB::table('society_transactions')
                                    ->insertGetId([
                                    'company_id'=>$user_company_id,
                                    'account_id'=>$account_id,
                                    'transaction_date'=>$transaction_date,
                                    'transaction_name'=>$transaction_name,
                                    'cost_less'=>$cost_less,
                                    'transaction_amount'=>$transaction_amount
                                    ]);
        }

        return redirect()->route('society_transaction_list')->with('success_message', 'Transactions are added successfully!');
    }


    public function edit_society_transaction($id)
    {
        $society_transaction = DB::table('society_transactions')
                                ->where('society_transactions.id', $id)
                                ->first();

        $user_company_id = Auth::user()->company_id;
        
        $account_types = DB::table('society_accounts')
                            ->select('id','account_name')
                            ->where('company_id',$user_company_id)
                            ->get();
        
        return view('societymanagement::transactions.edit',compact('society_transaction','account_types'));
    }


    public function update_society_transaction(Request $request, $id){

        $rules = [
            'transaction_date' => 'required|date',
            'transaction_name' => 'required|string',
            'transaction_amount' => 'required|numeric',
        ];

        $customMessages = [
            'account_id.required' => 'Account Name is required',
            'transaction_date.required' => 'Transaction Date is required',
            'transaction_name.required' => 'Transaction Name is required',
            'cost_less.required' => 'Cost Less is required',
            'transaction_amount.required' => 'Transaction Name is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $data = array();
        $data['account_id'] = $request->account_id;
        $data['transaction_date'] = $request->transaction_date;
        $data['transaction_name'] = $request->transaction_name;
        $data['cost_less'] = $request->cost_less;
        $data['transaction_amount'] = $request->transaction_amount;
        
        $updated = DB::table('society_transactions')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Transaction is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Transaction failed or no changes were made');
        }
    }



    public function delete_society_transaction($id){
        try {
            // Check if the branch exists using Query Builder
            $society_transaction = DB::table('society_transactions')->where('id', $id)->first();
            if (!$society_transaction) {
                return response()->json(['success' => false, 'message' => 'Transaction is not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_transactions')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Transaction has been deleted successfully!']);
            } catch (\Exception $e) {
                // If an error occurs, return an error response
                return response()->json(['success' => false, 'message' => 'Error deleting Transaction.']);
            }
            
    }
    //transaction (end)


    //balance sheet (start)
    public function society_balance_sheet_report(){
        return view('societymanagement::accounts.balance_sheet'); 
    }

    public function society_balance_transaction_report_submit(Request $request){
        $year = $request->year;
        $user_company_id = Auth::user()->company_id;
       
        //----asset (start)----
        $assets = DB::table('society_accounts')
                    ->leftJoin('society_transactions', 'society_accounts.id', '=', 'society_transactions.account_id')
                    ->select(
                        'society_accounts.account_name',
                        'society_accounts.id as my_account_id',
                        DB::raw("
                            (SELECT SUM(transaction_amount) 
                            FROM society_transactions 
                            WHERE YEAR(transaction_date) = $year
                            AND company_id = $user_company_id
                            AND account_id = society_accounts.id 
                            AND cost_less = 2) as total_transaction_amount
                        ")
                    )
                    ->whereYear('society_transactions.transaction_date', $year)
                    ->where('society_accounts.company_id', $user_company_id)
                    ->where('society_accounts.accounts_type', 'A')
                    ->where('society_transactions.cost_less', 2)
                    ->groupBy('society_accounts.account_name', 'society_accounts.id') // Ensure unique rows
                    ->get();


        $total_asset_sum_amt = $assets->sum('total_transaction_amount');

        $asset_depriciations = DB::table('society_accounts')
                                ->leftJoin('society_transactions', 'society_accounts.id', '=', 'society_transactions.account_id')
                                ->select(
                                    'society_accounts.account_name',
                                    'society_accounts.id as my_account_id',
                                    DB::raw("
                                        (SELECT SUM(transaction_amount) 
                                        FROM society_transactions 
                                        WHERE YEAR(transaction_date) = $year
                                        AND company_id = $user_company_id
                                        AND account_id = society_accounts.id 
                                        AND cost_less = 1) as total_transaction_amount
                                    ")
                                )
                                ->whereYear('society_transactions.transaction_date', $year)
                                ->where('society_accounts.company_id', $user_company_id)
                                ->where('society_accounts.accounts_type', 'A')
                                ->where('society_transactions.cost_less', 1)
                                ->groupBy('society_accounts.account_name', 'society_accounts.id') // Ensure unique rows
                                ->get();


        $total_asset_depriciation_sum_amt = $asset_depriciations->sum('total_transaction_amount');

       //net total
        $net_total_asset_sum_amt = $total_asset_sum_amt - $total_asset_depriciation_sum_amt;

        //----asset (end)----


    }
    //balance sheet (end)
  
    

    public function index(){
        return view('societymanagement::accounts.my'); 
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
