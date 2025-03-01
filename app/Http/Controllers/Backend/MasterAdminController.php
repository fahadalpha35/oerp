<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Illuminate\Support\Facades\Validator;
// use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Intervention\Image\Facades\Image;
use DB;
use Carbon\Carbon;

// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;


class MasterAdminController extends Controller
{
    use ValidatesRequests;

    public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
          
             $user = Auth::user();
            $validator = \Validator::make($request->all(),[
                    'current_password' => 'required',
                    'new_password' => [
                        'required',
                        'string',
                        'min:7',
                        
                        function ($attribute, $value, $fail) use ($user) {
                            if (Hash::check($value, $user->password)) {
                                $fail('The new password must be different from the current password.');
                            }
                        },
                    ],
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json(['error' => 'Current password is incorrect'], 422);
                }

                $user->password = Hash::make($request->new_password);
                $user->save();

                Auth::guard('web')->logout();

                return response()->json(['message' => 'Password is changed successfully!']);

        }

        $user_email = Auth::user()->email;
        // $adminDetails = User::where('email', Auth::user()->email)->first()->toArray();
        // return view('backend.settings.update_admin_password')->with(compact('adminDetails'));
        return view('backend.settings.update_password',compact('user_email'));
    }




    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updatePersonalDetails(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                // 'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile_number' => 'required|numeric',
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20048',
            ];

            $customMessages = [
                'mobile_number.required' => 'Mobile Number is required',
                'mobile_number.numeric' => 'Valid Mobile Number is required',
                'profile_pic.image' => 'Valid Image is required',
                'profile_pic.mimes' => 'Allowed image types: jpeg, png, jpg, gif, svg',
                'profile_pic.max' => 'Image size should not exceed 2MB',
            ];

            $this->validate($request, $rules, $customMessages);

            $user_id = Auth::user()->id;
            $user_role = Auth::user()->role_id;
            
    
            //super admin (ossl)
            if($user_role == 1){
                $member = DB::table('super_admins')
                        ->where('user_id',$user_id)
                        ->first();
                              
                $member_name = $request->input('full_name');
                $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);
    
    
                $getPicFromDb = $member->profile_pic;
                $super_admin_new_image = $request->file('profile_pic');
                
                
                    if(!empty($super_admin_new_image)){
    
                        if(!empty($getPicFromDb)){
                        $filePath = public_path('backend/images/' . $getPicFromDb);
                            unlink($filePath);
                        }
    
                  
                    $imageName = date('Ymd') . time() . '.' . $super_admin_new_image->getClientOriginalExtension();
                    $imagePath = public_path('backend/images/profile/' . $imageName);
                    Image::make($super_admin_new_image)->resize(300, 300)->save($imagePath);
                    $super_admin_image = 'profile/' . $imageName;
                    
                    $data = array();
                    $data['full_name'] = $request->full_name;
                    $data['father_name'] = $request->father_name;
                    $data['mother_name'] = $request->mother_name;
                    $data['mobile_number'] = $request->mobile_number;
                    $data['nid_number'] = $request->nid_number;
                    $data['present_address'] = $request->present_address;
                    $data['permanent_address'] = $request->permanent_address;
                    $data['birth_date'] = $request->birth_date;
                    $data['blood_group'] = $request->blood_group;
                    $data['nationality'] = $request->nationality;
                    $data['marital_status'] = $request->marital_status;
                    $data['religion'] = $request->religion;
                    $data['gender'] = $request->gender;
                    $data['profile_pic'] = $super_admin_image;

                    $data['emergency_contact_name_one'] = $request->emergency_contact_name_one;
                    $data['emergency_contact_number_one'] = $request->emergency_contact_number_one;
                    $data['emergency_contact_relation_one'] = $request->emergency_contact_relation_one;

                    $data['emergency_contact_name_two'] = $request->emergency_contact_name_two;
                    $data['emergency_contact_number_two'] = $request->emergency_contact_number_two;
                    $data['emergency_contact_relation_two'] = $request->emergency_contact_relation_two;

                    $data['emergency_contact_name_three'] = $request->emergency_contact_name_three;
                    $data['emergency_contact_number_three'] = $request->emergency_contact_number_three;
                    $data['emergency_contact_relation_three'] = $request->emergency_contact_relation_three;
    
                    $updated = DB::table('super_admins')
                              ->where('user_id', $user_id)
                              ->update($data);
    
                    if(($updated == true) || ($update_user_data == true)){
                        return redirect()->back()->with('success_message', 'Personal details updated successfully!');
                    }else{
                        return redirect()->back()->with('error_message', 'Personal details update failed or no changes were made');
                    }
    
                    }else{
    
                        $data = array();
                        $data['full_name'] = $request->full_name;
                        $data['father_name'] = $request->father_name;
                        $data['mother_name'] = $request->mother_name;
                        $data['mobile_number'] = $request->mobile_number;
                        $data['nid_number'] = $request->nid_number;
                        $data['present_address'] = $request->present_address;
                        $data['permanent_address'] = $request->permanent_address;
                        $data['birth_date'] = $request->birth_date;
                        $data['blood_group'] = $request->blood_group;
                        $data['nationality'] = $request->nationality;
                        $data['marital_status'] = $request->marital_status;
                        $data['religion'] = $request->religion;
                        $data['gender'] = $request->gender;
                        // $data['profile_pic'] = $admin_image;
                        $data['emergency_contact_name_one'] = $request->emergency_contact_name_one;
                        $data['emergency_contact_number_one'] = $request->emergency_contact_number_one;
                        $data['emergency_contact_relation_one'] = $request->emergency_contact_relation_one;

                        $data['emergency_contact_name_two'] = $request->emergency_contact_name_two;
                        $data['emergency_contact_number_two'] = $request->emergency_contact_number_two;
                        $data['emergency_contact_relation_two'] = $request->emergency_contact_relation_two;

                        $data['emergency_contact_name_three'] = $request->emergency_contact_name_three;
                        $data['emergency_contact_number_three'] = $request->emergency_contact_number_three;
                        $data['emergency_contact_relation_three'] = $request->emergency_contact_relation_three;
        
                        $updated = DB::table('super_admins')
                                  ->where('user_id', $user_id)
                                  ->update($data);
    
                        if(($updated == true) || ($update_user_data == true)){
                            return redirect()->back()->with('success_message', 'Personal details updated successfully!');
                        }else{
                            return redirect()->back()->with('error_message', 'Personal details update failed or no changes were made');
                        }
                    }   
           
    
             //master_admins   
            }elseif($user_role == 2){

                $member = DB::table('master_admins')
                        ->where('user_id',$user_id)
                        ->first();
                              
                $member_name = $request->input('full_name');
                $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);
    
    
                $getPicFromDb = $member->profile_pic;
                $master_admin_new_image = $request->file('profile_pic');
                
                    if(!empty($master_admin_new_image)){
    
                        if(!empty($getPicFromDb)){
                        $filePath = public_path('backend/images/' . $getPicFromDb);
                            unlink($filePath);
                        }
                    
                    // Generate New Image Name
                    $imageName = date('Ymd') . time() . '.' . $master_admin_new_image->getClientOriginalExtension();
                    $imagePath = public_path('backend/images/profile/' . $imageName);
                    Image::make($master_admin_new_image)->resize(300, 300)->save($imagePath);
                    $master_admin_image = 'profile/' . $imageName;  
                    
                    $data = array();
                    $data['full_name'] = $request->full_name;
                    $data['father_name'] = $request->father_name;
                    $data['mother_name'] = $request->mother_name;
                    $data['mobile_number'] = $request->mobile_number;
                    $data['nid_number'] = $request->nid_number;
                    $data['present_address'] = $request->present_address;
                    $data['permanent_address'] = $request->permanent_address;
                    $data['birth_date'] = $request->birth_date;
                    $data['blood_group'] = $request->blood_group;
                    $data['nationality'] = $request->nationality;
                    $data['marital_status'] = $request->marital_status;
                    $data['religion'] = $request->religion;
                    $data['gender'] = $request->gender;
                    $data['profile_pic'] = $master_admin_image;
                    $data['emergency_contact_name_one'] = $request->emergency_contact_name_one;
                    $data['emergency_contact_number_one'] = $request->emergency_contact_number_one;
                    $data['emergency_contact_relation_one'] = $request->emergency_contact_relation_one;

                    $data['emergency_contact_name_two'] = $request->emergency_contact_name_two;
                    $data['emergency_contact_number_two'] = $request->emergency_contact_number_two;
                    $data['emergency_contact_relation_two'] = $request->emergency_contact_relation_two;

                    $data['emergency_contact_name_three'] = $request->emergency_contact_name_three;
                    $data['emergency_contact_number_three'] = $request->emergency_contact_number_three;
                    $data['emergency_contact_relation_three'] = $request->emergency_contact_relation_three;
    
                    $updated = DB::table('master_admins')
                              ->where('user_id', $user_id)
                              ->update($data);
    
                    if(($updated == true) || ($update_user_data == true)){
                        return redirect()->back()->with('success_message', 'Personal details updated successfully!');
                    }else{
                        return redirect()->back()->with('error_message', 'Personal details update failed or no changes were made');
                    }
    
                    }else{
    
                        $data = array();
                        $data['full_name'] = $request->full_name;
                        $data['father_name'] = $request->father_name;
                        $data['mother_name'] = $request->mother_name;
                        $data['mobile_number'] = $request->mobile_number;
                        $data['nid_number'] = $request->nid_number;
                        $data['present_address'] = $request->present_address;
                        $data['permanent_address'] = $request->permanent_address;
                        $data['birth_date'] = $request->birth_date;
                        $data['blood_group'] = $request->blood_group;
                        $data['nationality'] = $request->nationality;
                        $data['marital_status'] = $request->marital_status;
                        $data['religion'] = $request->religion;
                        $data['gender'] = $request->gender;
                        // $data['profile_pic'] = $admin_image;
                        $data['emergency_contact_name_one'] = $request->emergency_contact_name_one;
                        $data['emergency_contact_number_one'] = $request->emergency_contact_number_one;
                        $data['emergency_contact_relation_one'] = $request->emergency_contact_relation_one;

                        $data['emergency_contact_name_two'] = $request->emergency_contact_name_two;
                        $data['emergency_contact_number_two'] = $request->emergency_contact_number_two;
                        $data['emergency_contact_relation_two'] = $request->emergency_contact_relation_two;

                        $data['emergency_contact_name_three'] = $request->emergency_contact_name_three;
                        $data['emergency_contact_number_three'] = $request->emergency_contact_number_three;
                        $data['emergency_contact_relation_three'] = $request->emergency_contact_relation_three;
        
                        $updated = DB::table('master_admins')
                                  ->where('user_id', $user_id)
                                  ->update($data);
    
                        if(($updated == true) || ($update_user_data == true)){
                            return redirect()->back()->with('success_message', 'Personal details updated successfully!');
                        }else{
                            return redirect()->back()->with('error_message', 'Personal details update failed or no changes were made');
                        }
                    }

            //admin, employee
            }else{
                
                $member = DB::table('hr_employees')
                        ->where('user_id',$user_id)
                        ->first();
                              
                $member_name = $request->input('full_name');
                $update_user_data = DB::table('users')
                                    ->where('id', $user_id)
                                    ->update(['name' => $member_name]);
    
    
                $getPicFromDb = $member->profile_pic;
                $employee_new_image = $request->file('profile_pic');
                
                    if(!empty($employee_new_image)){
    
                        if(!empty($getPicFromDb)){
                        $filePath = public_path('backend/images/' . $getPicFromDb);
                            unlink($filePath);
                        }
                    
                    // Generate New Image Name
                    $imageName = date('Ymd') . time() . '.' . $employee_new_image->getClientOriginalExtension();
                    $imagePath = public_path('backend/images/profile/' . $imageName);
                    Image::make($employee_new_image)->resize(300, 300)->save($imagePath);
                    $employee_image = 'profile/' . $imageName;  
                    
                    $data = array();
                    $data['full_name'] = $request->full_name;
                    $data['father_name'] = $request->father_name;
                    $data['mother_name'] = $request->mother_name;
                    $data['mobile_number'] = $request->mobile_number;
                    $data['nid_number'] = $request->nid_number;
                    $data['present_address'] = $request->present_address;
                    $data['permanent_address'] = $request->permanent_address;
                    $data['birth_date'] = $request->birth_date;
                    $data['blood_group'] = $request->blood_group;
                    $data['nationality'] = $request->nationality;
                    $data['marital_status'] = $request->marital_status;
                    $data['religion'] = $request->religion;
                    $data['gender'] = $request->gender;
                    $data['profile_pic'] = $employee_image;
                    $data['emergency_contact_name_one'] = $request->emergency_contact_name_one;
                    $data['emergency_contact_number_one'] = $request->emergency_contact_number_one;
                    $data['emergency_contact_relation_one'] = $request->emergency_contact_relation_one;

                    $data['emergency_contact_name_two'] = $request->emergency_contact_name_two;
                    $data['emergency_contact_number_two'] = $request->emergency_contact_number_two;
                    $data['emergency_contact_relation_two'] = $request->emergency_contact_relation_two;

                    $data['emergency_contact_name_three'] = $request->emergency_contact_name_three;
                    $data['emergency_contact_number_three'] = $request->emergency_contact_number_three;
                    $data['emergency_contact_relation_three'] = $request->emergency_contact_relation_three;
    
                    $updated = DB::table('hr_employees')
                              ->where('user_id', $user_id)
                              ->update($data);
    
                    if(($updated == true) || ($update_user_data == true)){
                        return redirect()->back()->with('success_message', 'Personal details updated successfully!');
                    }else{
                        return redirect()->back()->with('error_message', 'Personal details update failed or no changes were made');
                    }
    
                    }else{
    
                        $data = array();
                        $data['full_name'] = $request->full_name;
                        $data['father_name'] = $request->father_name;
                        $data['mother_name'] = $request->mother_name;
                        $data['mobile_number'] = $request->mobile_number;
                        $data['nid_number'] = $request->nid_number;
                        $data['present_address'] = $request->present_address;
                        $data['permanent_address'] = $request->permanent_address;
                        $data['birth_date'] = $request->birth_date;
                        $data['blood_group'] = $request->blood_group;
                        $data['nationality'] = $request->nationality;
                        $data['marital_status'] = $request->marital_status;
                        $data['religion'] = $request->religion;
                        $data['gender'] = $request->gender;
                        // $data['profile_pic'] = $admin_image;
                        $data['emergency_contact_name_one'] = $request->emergency_contact_name_one;
                        $data['emergency_contact_number_one'] = $request->emergency_contact_number_one;
                        $data['emergency_contact_relation_one'] = $request->emergency_contact_relation_one;

                        $data['emergency_contact_name_two'] = $request->emergency_contact_name_two;
                        $data['emergency_contact_number_two'] = $request->emergency_contact_number_two;
                        $data['emergency_contact_relation_two'] = $request->emergency_contact_relation_two;

                        $data['emergency_contact_name_three'] = $request->emergency_contact_name_three;
                        $data['emergency_contact_number_three'] = $request->emergency_contact_number_three;
                        $data['emergency_contact_relation_three'] = $request->emergency_contact_relation_three;
        
                        $updated = DB::table('hr_employees')
                                  ->where('user_id', $user_id)
                                  ->update($data);
    
                        if(($updated == true) || ($update_user_data == true)){
                            return redirect()->back()->with('success_message', 'Personal details updated successfully!');
                        }else{
                            return redirect()->back()->with('error_message', 'Personal details update failed or no changes were made');
                        }
                    }
            }
        }

        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->role_id;

        //super admin (ossl)
        if($user_role_id == 1){

            $personalDetails = DB::table('super_admins')
                               ->leftJoin('users','super_admins.user_id','users.id')
                               ->select('super_admins.*', 'users.name as user_full_name')
                               ->where('super_admins.user_id',$user_id)
                               ->first();


            return view('backend.settings.update_personal_details')->with(compact('personalDetails'));
           
        //master admin
        }elseif($user_role_id == 2){

            $personalDetails = DB::table('master_admins')
                               ->leftJoin('users','master_admins.user_id','users.id')
                               ->select('master_admins.*', 'users.name as user_full_name')
                               ->where('master_admins.user_id',$user_id)
                               ->first();

            return view('backend.settings.update_personal_details')->with(compact('personalDetails'));

        //admin, employee
        }else{

            $personalDetails = DB::table('hr_employees')
            ->leftJoin('users','hr_employees.user_id','users.id')
            ->select('hr_employees.*', 'users.name as user_full_name')
            ->where('hr_employees.user_id',$user_id)
            ->first();

            return view('backend.settings.update_personal_details')->with(compact('personalDetails'));
        }
        
    }

    public function login(Request $request)
    {
        // Check if the admin is already logged in
        if (Auth::check()) {
            return redirect('/dashboard'); // Redirect to dashboard if already logged in
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'active_status' => 1])) {
                return redirect('/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }
        return view('backend.login');
    }

    public function register(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $data = $request->all();

            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|min:8',
            ]);

            $company = DB::table('companies')
                        ->insertGetId([
                            'company_name' => $request->company_name,
                            // 'company_email' => $request->company_email,
                            'contact_no' => $request->contact_no,
                            'trade_license_no' => $request->trade_license_no,
                            'bin_no' => $request->bin_no,
                            'tin_no' => $request->tin_no,
                            'company_address' => $request->company_address,
                            'division_id' => $request->division,
                            'district_id' => $request->district,
                            'country' => $request->country
                        ]);

            $business_type = DB::table('business_types')
                            ->insertGetId([
                            'business_type' => $request->business_type,
                            'business_status' => 1
                            ]);


            $user = new User();
            $user->name = $request->name;
            $user->role_id = 2;
            $user->company_id = $company;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->active_status = '1';
            $user->company_business_type = $business_type;
            $user->registration_date = Carbon::now()->toDateString();       
            $user->save();

            $master_admin = DB::table('master_admins')
                        ->insertGetId([
                        'user_id'=>$user->id
                        ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }
        
        
        $divisions = DB::table('divisions')->get(); 
        return view('backend.register',compact('divisions'));
    }

    public function division(Request $request){

        $selectedDivision = $request->input('data');
        $districts = DB::table('districts')
                    ->where('division_id',$selectedDivision)
                    ->get();
  
      $str="<option value=''>-- Select --</option>";
      foreach ($districts as $district) {
         $str .= "<option value='$district->id'> $district->name </option>";
         
      }
      echo $str;
      }

    public function logout()
    {
        // Auth::logout();
        Auth::logout();
        return redirect('/login');
    }

    
}
