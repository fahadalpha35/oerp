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
    /**
     * Display a listing of the resource.
     */
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
