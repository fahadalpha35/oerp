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
                                'society_member_loans.loan_number',
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
            if($row->status == 1){
            $btn = '<a href="'.route('society_member_loans.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a><br>';
            $btn .= '<a href="'.route('loan_approval', $row->id).'" class="edit btn btn-success btn-sm">Approve</a>';
            }else{
                $btn = '<a href="" disabled class="edit btn btn-secondary btn-sm">Approved</a>'; 
            }
            
            return $btn;
        })
        ->rawColumns(['status_label','action'])
        ->make(true);
        }
        
        return view('societymanagement::member_loans.index');
    }



    public function create()
    {
        
        $user_company_id = Auth::user()->company_id;
        $members = DB::table('society_members')
                    ->where('company_id',$user_company_id)
                    ->where('active_status',1)
                    ->get();
        
        return view('societymanagement::member_loans.create',compact('members'));
        
    }

    
    public function store(Request $request)
    {
        $rules = [
            'member_id' => 'required|numeric',
            'loan_start_date' => 'required|date',
            'loan_amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',        
            'repayment_term' => 'required|numeric'
        ];

        $customMessages = [
            'member_id.required' => 'Member Name is required',
            'loan_start_date.required' => 'Loan Start Date is required',
            'loan_amount.required' => 'Loan Amount is required',
            'interest_rate.required' => 'Interest Rate is required',
            'repayment_term.required' => 'Repayment Term is required'
        ];

        $this->validate($request, $rules, $customMessages);
        
        $memberId = $request->input('member_id');
        $loanAmount = $request->input('loan_amount');
        $loanNumber = 'LN-' . $memberId . '-' . now()->format('YmdHis'); // Example: LN-101-20241211093045

        $interestRate = $request->input('interest_rate');
        $repaymentTerm = $request->input('repayment_term');

        $loanStartDate = Carbon::parse($request->loan_start_date);
        $loanEndDate = $loanStartDate->copy()->addMonths(intval($repaymentTerm));

        // Calculate total amount due with interest
        $totalInterest = ($loanAmount * $interestRate * $repaymentTerm) / (100 * 12);
        $totalAmountDue = $loanAmount + $totalInterest;

        $user_company_id = Auth::user()->company_id;

        // Insert loan record
        $member_loan = DB::table('society_member_loans')
                            ->insertGetId([
                            'company_id'=> $user_company_id,
                            'member_id' => $memberId,
                            'loan_number' => $loanNumber,
                            'loan_amount' => $loanAmount,
                            'interest_rate' => $interestRate,
                            'total_amount_due' => $totalAmountDue,
                            'repayment_term' => $repaymentTerm,
                            // 'loan_start_date' => Carbon::now(),
                            'loan_start_date' => $loanStartDate,
                            // 'loan_end_date' => Carbon::now()->addMonths(intval($repaymentTerm)),
                            'loan_end_date' => $loanEndDate,
                            'status' => 1
                        ]);

        // $totalInstallments = $repaymentTerm;
        // $amountPerInstallment = $loanAmount / $totalInstallments;

        
        // for ($i = 1; $i <= $totalInstallments; $i++) {
        //     $dueDate = $loanStartDate->copy()->addMonths($i);

        //     DB::table('society_loan_repayments')->insert([
        //         'loan_id' => $member_loan,
        //         'due_date' => $dueDate,
        //         'amount_due' => $amountPerInstallment,
        //         'amount_paid' => 0,
        //         'repayment_status' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        return redirect()->route('society_member_loans.index')->with('success_message', 'Loan details are stored successfully!');

    }


        //loan approval
        public function loan_approval($loanId){

            $loan_details = DB::table('society_member_loans')->where('id', $loanId)->first();
            
            $loanStartDate = Carbon::parse($loan_details->loan_start_date);
            $repaymentTerm = $loan_details->repayment_term;
            $loanEndDate = $loanStartDate->copy()->addMonths(intval($repaymentTerm));
            $loanAmount = $loan_details->loan_amount;


            $totalInstallments = $repaymentTerm;
            $amountPerInstallment = $loanAmount / $totalInstallments;
    
            
            for ($i = 1; $i <= $totalInstallments; $i++) {
                $dueDate = $loanStartDate->copy()->addMonths($i);
    
                DB::table('society_loan_repayments')->insert([
                    'loan_id' => $loanId,
                    'due_date' => $dueDate,
                    'amount_due' => $amountPerInstallment,
                    'amount_paid' => 0,
                    'repayment_status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
                
            
            DB::table('society_member_loans')
                ->where('id', $loanId)
                ->update([
                    'status' => 2,
                    'updated_at' => now()
                ]);
    
            return redirect()->back()->with('success_message', 'Loan is approved!');
        }

    

    public function loan_repayment_list(Request $request){

        if ($request->ajax()) {
      
            $user_company_id = Auth::user()->company_id;

            $repayments = DB::table('society_loan_repayments')
                          ->leftJoin('society_member_loans','society_loan_repayments.loan_id','society_member_loans.id')
                            ->select(
                                'society_loan_repayments.id',
                                'society_member_loans.loan_number',
                                'society_loan_repayments.due_date',
                                'society_loan_repayments.amount_due',
                                'society_loan_repayments.amount_paid',
                                'society_loan_repayments.repayment_status',                              
                                )
                            ->where('society_member_loans.company_id', $user_company_id)
                            ->get();


        
        return DataTables::of($repayments)
        ->addIndexColumn()
        ->addColumn('status_label', function ($row) {
            if($row->repayment_status == 1){
                return '<span style = "color : orange;">Unpaid</span>';
            }elseif($row->repayment_status == 2){
                return '<span style = "color : blue;">Partially Paid</span>';
            }else{
                return '<span style = "color : green;">Paid</span>';
            }
        })
        ->addColumn('action', function($row){
            if ($row->repayment_status != 3) {
                $btn = '<form action="'.route('repay_loan', $row->id).'" method="POST" style="display:inline-block;">
                            '.csrf_field().'
                            <div class="mb-3">
                                <label for="amount_'.$row->id.'" class="form-label">Amount</label>
                                <input type="number" step="0.01" name="amount" id="amount_'.$row->id.'" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Pay</button>
                        </form>';
                return $btn;
            }
            return '';
        })
        
        ->rawColumns(['status_label','action'])
        ->make(true);
        }
        
        return view('societymanagement::loan_repayments.index');
    }


    public function repay_loan(Request $request, $repaymentId){

        $amount = $request->input('amount');

        // dd($amount);

        // Retrieve repayment record
        $repayment = DB::table('society_loan_repayments')->where('id', $repaymentId)->first();

        if (!$repayment || $repayment->repayment_status == 'Paid') {
            return redirect()->back()->with('error', 'Invalid repayment record!');
        }

        // Update repayment
        $newAmountPaid = $repayment->amount_paid + $amount;

        // $status = $newAmountPaid >= $repayment->amount_due ? 'Paid' : 'Partially Paid';
        $status = $newAmountPaid >= $repayment->amount_due ? '3' : '2';

        DB::table('society_loan_repayments')
            ->where('id', $repaymentId)
            ->update([
                'amount_paid' => $newAmountPaid,
                'repayment_status' => $status,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success_message', 'Repayment successful!');
    }

    //  public function show($id)
    // {
    //     return view('societymanagement::show');
    // }

   
    public function edit($id)
    {
        $loan = DB::table('society_member_loans')->where('id', $id)->first();

        $user_company_id = Auth::user()->company_id;
        $members = DB::table('society_members')
                    ->where('company_id',$user_company_id)
                    ->where('active_status',1)
                    ->get();
        
        return view('societymanagement::member_loans.edit',compact('loan','members'));
    }

   
    public function update(Request $request, $id)
    {
        
        $memberId = $request->input('member_id');
        $loanAmount = $request->input('loan_amount');

        $interestRate = $request->input('interest_rate');
        $repaymentTerm = $request->input('repayment_term');

        $loanStartDate = Carbon::parse($request->loan_start_date);
        $loanEndDate = $loanStartDate->copy()->addMonths(intval($repaymentTerm));

        // Calculate total amount due with interest
        $totalInterest = ($loanAmount * $interestRate * $repaymentTerm) / (100 * 12);
        $totalAmountDue = $loanAmount + $totalInterest;
        
        $data = array();
        $data['member_id'] = $memberId;
        $data['loan_amount'] = $loanAmount;
        $data['interest_rate'] = $interestRate;
        $data['total_amount_due'] = $totalAmountDue;
        $data['repayment_term'] = $repaymentTerm;
        $data['loan_start_date'] = $loanStartDate;
        $data['loan_end_date'] = $loanEndDate;

        
        $updated = DB::table('society_member_loans')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Loan details is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Loan details failed or no changes were made');
        }
    }
   
    // public function destroy($id)
    // {
        
    // }
}
