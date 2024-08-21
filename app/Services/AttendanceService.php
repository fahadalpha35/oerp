<?php

namespace App\Services;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceService
{
    public function CheckIn()
    {
        try {
            $user = Auth::user();
            $today = Carbon::today();

            $attendance = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', $today)
                ->first();

            if ($attendance) {
                $attendance->update([
                    'check_in' => now(),
                    'status' => 1
                ]);
            } else {
                Attendance::create([
                    'user_id' => $user->id,
                    'check_in' => now(),
                    'check_out' => null,
                    'status' => 1
                ]);
            }
            return back()->with('success', 'Attendance marked successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to mark attendance!');
        }
    }
    public function CheckOut()
    {
        try {
            $attendance = Attendance::where('user_id', Auth::user()->id)->latest();
            $attendance->update([
                'check_out' => now()
            ]);
            return back()->with('success', 'Attendance mark successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Attendance not  mark !');
        }
    }   

}
