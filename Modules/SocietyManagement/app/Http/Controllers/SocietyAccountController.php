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

        dd($expenses);
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
