<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Admin;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    use ValidatesRequests;

    public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function updateAdminPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully!');
                } else {
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password do not match!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current password is incorrect!');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('backend.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateAdminDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
                'admin_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.regex' => 'Valid Name is required',
                'admin_mobile.required' => 'Mobile Number is required',
                'admin_mobile.numeric' => 'Valid Mobile Number is required',
                'admin_image.image' => 'Valid Image is required',
                'admin_image.mimes' => 'Allowed image types: jpeg, png, jpg, gif, svg',
                'admin_image.max' => 'Image size should not exceed 2MB',
            ];
            $this->validate($request, $rules, $customMessages);

            // Upload Admin Photo
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'backend/images/profile/' . $imageName;
                    // Upload the image
                    Image::make($image_tmp)->resize(300, 300)->save($imagePath);
                }
            } else if (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = "";
            }

            // Update Admin Details
            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name' => $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image' => $imageName
            ]);

            return redirect()->back()->with('success_message', 'Admin details updated successfully!');
        }

        $adminDetails = Auth::guard('admin')->user()->toArray();
        return view('backend.settings.update_admin_details')->with(compact('adminDetails'));
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('backend/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }
        return view('backend.login');
    }

    public function register()
    {
        return view('backend.register');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('backend/login');
    }
}
