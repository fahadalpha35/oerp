<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RenewalFeeController extends Controller
{
    

    //scheduler for auto-generate renewal records

    public function generateRenewalFees()
    {
        $today = Carbon::now();
        $members = DB::table('society_members')
                        ->where('expiration_date', '<=', $today->copy()->addDays(30))
                        ->where('active_status', 1)
                        ->get();

        foreach ($members as $member) {
            // Check if a renewal record already exists for this due date
            $existingFee = DB::table('society_renewal_fees')
                            ->where('member_id', $member->id)
                            ->where('due_date', $member->expiration_date)
                            ->exists();

            if (!$existingFee) {
                
                $renewal_fee = DB::table('society_renewal_fees')
                                ->insert([
                                    'member_id' => $member->id,
                                    'amount' => $member->membership_fee,
                                    'due_date' => $member->expiration_date,
                                    'status' => 'Unpaid',
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
            }
        }

        return response()->json(['message' => 'Renewal fees generated successfully']);
    }


    //scheduler for auto-change member status after 
    public function updateMemberStatus()
    {
        $gracePeriod = Carbon::now()->subDays(30); // 30 days past expiration

        $expiredMembers = DB::table('society_members')
            ->where('expiration_date', '<', $gracePeriod)
            ->where('active_status', 1)
            ->get();

        foreach ($expiredMembers as $member) {
            $hasUnpaidFees = DB::table('society_renewal_fees')
                                ->where('member_id', $member->id)
                                ->where('status', 'Unpaid')
                                ->exists();

            if ($hasUnpaidFees) {
                DB::table('society_members')
                    ->where('id', $member->id)
                    ->update([
                        'active_status' => 2, // Inactive
                        'updated_at' => now(),
                    ]);
            }
        }

        return response()->json(['message' => 'Membership statuses updated successfully']);
    }


    public function index()
    {
        $renewalFees = DB::table('society_renewal_fees')
                            ->join('society_members', 'society_renewal_fees.member_id', '=', 'society_members.id')
                            ->select('society_renewal_fees.*', 'society_members.name', 'society_members.email', 'society_members.contact_number')
                            ->orderBy('society_renewal_fees.due_date', 'asc')
                            ->get(); // Paginate results
           
        return view('societymanagement::renewal_fees.index',compact('renewalFees'));
    }

   
    public function create()
    {
            
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $renewalFeeId = $request->input('renewal_fee_id');
            $renewalFee = DB::table('society_renewal_fees')->find($renewalFeeId);

            if (!$renewalFee || $renewalFee->status === 'Paid') {
                return redirect()->back()->with('error_message', 'Invalid or already paid renewal fee');
            }

         // Mark the fee as paid
          $update_renewal_fee =  DB::table('society_renewal_fees')
                                    ->where('id', $renewalFeeId)
                                    ->update([
                                        'status' => 'Paid',
                                        'payment_date' => Carbon::now(),
                                        'updated_at' => now(),
                                        ]);

            // Extend the member's expiration date
            $member = DB::table('society_members')->find($renewalFee->member_id);
            $newExpirationDate = Carbon::parse($member->expiration_date)->addYear(); // Add one year

            $update_member_details = DB::table('society_members')
                                        ->where('id', $member->id)
                                        ->update([
                                            'expiration_date' => $newExpirationDate,
                                            'updated_at' => now(),
                                         ]);
        return redirect()->route('renewal_fees.index')->with('success_message', 'Payment recorded successfully!');
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
