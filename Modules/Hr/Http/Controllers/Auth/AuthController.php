<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\NoticeBoard;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestStatus\Notice;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }
    public function Submitlogin(Request $request)
    {
        $request->validate([
            'Emp_Id' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('Emp_Id', $request->Emp_Id)->first();
        if (!$user) {
            return back()->with('error', 'Invalid Credentials');
        }
        if ($user->is_active == false) {
            return back()->with('error', 'your account is deacivated');
        }
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid Credentials');
        }
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'login successfully!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'logout successfully!');
    }
    public function dashboard()
    {
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest()->first();
        $notices = NoticeBoard::whereDate('date', Carbon::today())->get();
        return view('dashboard', compact('attendance', 'notices'));
    }
}
