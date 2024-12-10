<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SocietyLoanController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        if ($request->ajax()) {
      
            $user_company_id = Auth::user()->company_id;

            $member_loans = DB::table('society_member_loans')
                          ->leftJoin('society_members','society_member_loans.member_id','society_members.id')
                        ->select(
                            'society_member_loans.id',
                            'society_member_loans.loan_amount',
                            'society_member_loans.interest_rate',
                            'society_member_loans.total_amount_due',
                            'society_member_loans.repayment_term',
                            'society_member_loans.loan_start_date',
                            'society_member_loans.loan_end_date',
                            'society_member_loans.status',                        
                            'society_members.name as member_name'
                            )
                        ->where('society_member_loans.company_id', $user_company_id)
                        ->get();


        
        return DataTables::of($member_loans)
        ->addIndexColumn()
        ->addColumn('status_label', function ($row) {
            if($row->status == 1){
                return '<span style = "color : orange;">Pending</span>';
            }elseif($row->status == 2){
                return '<span style = "color : blue;">Approved</span>';
            }elseif($row->status == 3){
                return '<span style = "color : red;">Rejected</span>';
            }else{
                return '<span style = "color : green;">Completed</span>';
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('society_insurances.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            return $btn;
        })
        ->rawColumns(['status_label','action'])
        ->make(true);
        }
        
        return view('societymanagement::member_loans.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $user_company_id = Auth::user()->company_id;
        $members = DB::table('society_members')
                    ->where('company_id',$user_company_id)
                    ->where('active_status',1)
                    ->get();
        
        return view('societymanagement::member_loans.create',compact('members'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'member_id' => 'required|numeric',
            'loan_amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',        
            'repayment_term' => 'required|numeric'
        ];

        $customMessages = [
            'member_id.required' => 'Member Name is required',
            'loan_amount.required' => 'Loan Amount is required',
            'interest_rate.required' => 'Interest Rate is required',
            'repayment_term.required' => 'Repayment Term is required'
        ];

        $this->validate($request, $rules, $customMessages);
        
        $memberId = $request->input('member_id');
        $loanAmount = $request->input('loan_amount');
        $interestRate = $request->input('interest_rate');
        $repaymentTerm = $request->input('repayment_term');

        // Calculate total amount due with interest
        $totalInterest = ($loanAmount * $interestRate * $repaymentTerm) / (100 * 12);
        $totalAmountDue = $loanAmount + $totalInterest;

        $user_company_id = Auth::user()->company_id;

        // Insert loan record
        DB::table('society_member_loans')
            ->insert([
            'company_id'=> $user_company_id,
            'member_id' => $memberId,
            'loan_amount' => $loanAmount,
            'interest_rate' => $interestRate,
            'total_amount_due' => $totalAmountDue,
            'repayment_term' => $repaymentTerm,
            'loan_start_date' => Carbon::now(),
            'loan_end_date' => Carbon::now()->addMonths(intval($repaymentTerm)),
            'status' => 1
        ]);

        return redirect()->route('society_member_loans.index')->with('success_message', 'Loan details are stored successfully!');

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
