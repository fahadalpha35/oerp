<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Intervention\Image\Facades\Image;

class SocietyMemberController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        if ($request->ajax()) {
      
            $user_company_id = Auth::user()->company_id;

            $members = DB::table('society_members')
                        ->select(
                            'id',
                            'member_unique_id',
                            'name',
                            'designation',
                            'email',
                            'contact_number',
                            'joining_date',
                            'expiration_date',
                            'membership_type',
                            'membership_fee'
                            )
                        ->where('company_id', $user_company_id)
                        ->get();

        
        return DataTables::of($members)
        ->addIndexColumn()
        ->addColumn('membership_type_label', function ($row) {
            if($row->membership_type == 1){
                return 'Regular';
            }elseif($row->membership_type == 2){
                return 'Premium';
            }else{
                return 'Honorary' ;
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="/society_members/'.$row->id.'/" class="edit btn btn-success btn-sm">View</a>';   
            $btn .= '<a href="'.route('society_members.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('society_members.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
         
        return view('societymanagement::members.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('societymanagement::members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'member_image' => 'nullable|file|mimes:jpg,png', // Image file must be jpg or png
            'designation' => 'required|string',
            'email' => 'nullable|email|unique:society_members,email', // Email is optional but must be unique if provided
            'contact_number' => 'required|string|unique:society_members,contact_number',
            'address' => 'required|string',
            'permanent_address' => 'required|string',
            'joining_date' => 'required|date',
            'membership_type' => 'required|numeric',
            'active_status' => 'required|numeric',
        ];

        $customMessages = [
            'name.required' => 'Member Full Name is required',
            'member_image.mimes' => 'Member Image must be a file of type: jpg, png',
            'designation.required' => 'Member Designation is required',
            'contact_number.required' => 'Contact Number is required',
            'address.required' => 'Present Address is required',
            'permanent_address.required' => 'Permanent Address is required',
            'joining_date.required' => 'Joining Date is required',
            'membership_type.required' => 'Membership Type is required',
            'active_status.required' => 'Activation Status is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;
        $memberId = $this->generateMemberId();

        
        if($request->hasFile('member_image')){

            // Generate New Image Name
            $member_image = $request->file('member_image');

            $imageName = date('Ymd') . time() . '.' . $member_image->getClientOriginalExtension();
            $imagePath = public_path('backend/images/society_members/' . $imageName);
            Image::make($member_image)->resize(300, 300)->save($imagePath);
            $member_img = 'society_members/' . $imageName; 

            $member = DB::table('society_members')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'name'=>$request->name,
                            'designation'=>$request->designation,
                            'member_unique_id'=>$memberId,
                            'email'=>$request->email,
                            'contact_number'=>$request->contact_number,
                            'address'=>$request->address,
                            'permanent_address'=>$request->permanent_address,
                            'joining_date'=>$request->joining_date,
                            'expiration_date'=>$request->expiration_date,
                            'membership_fee'=>$request->membership_fee,
                            'membership_type'=>$request->membership_type,
                            'active_status'=>$request->active_status,
                            'member_image'=>$member_img
                            ]);

        }else{
            $member = DB::table('society_members')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'name'=>$request->name,
                            'designation'=>$request->designation,
                            'member_unique_id'=>$memberId,
                            'email'=>$request->email,
                            'contact_number'=>$request->contact_number,
                            'address'=>$request->address,
                            'permanent_address'=>$request->permanent_address,
                            'joining_date'=>$request->joining_date,
                            'expiration_date'=>$request->expiration_date,
                            'membership_fee'=>$request->membership_fee,
                            'membership_type'=>$request->membership_type,
                            'active_status'=>$request->active_status
                            // 'member_image'=>$member_img,
                            ]);
        }

    
        return redirect()->route('society_members.index')->with('success_message', 'Member is added successfully!');
    }


    private function generateMemberId() {
        $lastMember = DB::table('society_members')->orderBy('created_at', 'desc')->first();
        $lastId = $lastMember ? (int) substr($lastMember->id, 4) : 0; // Assuming id format is 'MEM0001'
        return sprintf('MEM%04d', $lastId + 1); // Format it as 'MEM0002', etc.
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {       
        $member = DB::table('society_members')
                  ->where('id',$id)
                  ->first();
                  
        return view('societymanagement::members.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $member = DB::table('society_members')
                      ->where('id',$id)
                      ->first();
        return view('societymanagement::members.edit',compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $member_data_from_db = DB::table('society_members')
                             ->select('member_image')
                             ->where('id',$id)
                             ->first();

        $member_image_from_db = $member_data_from_db->member_image;

        $member_new_image = $request->file('member_image');

        if(!empty($member_new_image)){

            if(!empty($member_image_from_db)){
                $filePath = public_path('backend/images/' . $member_image_from_db);
                        unlink($filePath);
            }

       
            $memberImageName = date('Ymd') . time() . '.' . $member_new_image->getClientOriginalExtension();
            $imagePath = public_path('backend/images/society_members/' . $memberImageName);
            Image::make($member_new_image)->resize(300, 300)->save($imagePath);
            $imageFile = 'society_members/' . $memberImageName; 

            

            $rules = [
                'name' => 'required|string',
                'member_image' => 'nullable|file|mimes:jpg,png', // Image file must be jpg or png
                'designation' => 'required|string',
                'address' => 'required|string',
                'permanent_address' => 'required|string',
                'joining_date' => 'required|date',
                'membership_type' => 'required|numeric',
                'active_status' => 'required|numeric',
            ];
    
            $customMessages = [
                'name.required' => 'Member Full Name is required',
                'member_image.mimes' => 'Member Image must be a file of type: jpg, png',
                'designation.required' => 'Member Designation is required',
                'contact_number.required' => 'Contact Number is required',
                'address.required' => 'Present Address is required',
                'permanent_address.required' => 'Permanent Address is required',
                'joining_date.required' => 'Joining Date is required',
                'membership_type.required' => 'Membership Type is required',
                'active_status.required' => 'Activation Status is required',
            ];
    
            $this->validate($request, $rules, $customMessages);

            $data = array();
            $data['name'] = $request->name;
            $data['designation'] = $request->designation;
            $data['email'] = $request->email;
            $data['contact_number'] = $request->contact_number;
            $data['address'] = $request->address;
            $data['permanent_address'] = $request->permanent_address;
            $data['joining_date'] = $request->joining_date;
            $data['expiration_date'] = $request->expiration_date;
            $data['membership_fee'] = $request->membership_fee;
            $data['membership_type'] = $request->membership_type;
            $data['active_status'] = $request->active_status;
            $data['member_image'] = $imageFile;

            $updated = DB::table('society_members')
                            ->where('id', $id)
                            ->update($data);

            // Check if the update was successful
         if ($updated){
            // Return a success response
                return redirect()->back()->with('success_message', 'Member Information is updated successfully!');
            }else{
            // Return a failure response
                return redirect()->back()->with('error_message', 'Member Information failed or no changes were made');
            }

        }else{
            $rules = [
                'name' => 'required|string',
                // 'member_image' => 'nullable|file|mimes:jpg,png',
                'designation' => 'required|string',
                'address' => 'required|string',
                'permanent_address' => 'required|string',
                'joining_date' => 'required|date',
                'membership_type' => 'required|numeric',
                'active_status' => 'required|numeric',
            ];
    
            $customMessages = [
                'name.required' => 'Member Full Name is required',
                // 'member_image.mimes' => 'Member Image must be a file of type: jpg, png',
                'designation.required' => 'Member Designation is required',
                'contact_number.required' => 'Contact Number is required',
                'address.required' => 'Present Address is required',
                'permanent_address.required' => 'Permanent Address is required',
                'joining_date.required' => 'Joining Date is required',
                'membership_type.required' => 'Membership Type is required',
                'active_status.required' => 'Activation Status is required',
            ];
    
            $this->validate($request, $rules, $customMessages);

            $data = array();
            $data['name'] = $request->name;
            $data['designation'] = $request->designation;
            $data['email'] = $request->email;
            $data['contact_number'] = $request->contact_number;
            $data['address'] = $request->address;
            $data['permanent_address'] = $request->permanent_address;
            $data['joining_date'] = $request->joining_date;
            $data['expiration_date'] = $request->expiration_date;
            $data['membership_fee'] = $request->membership_fee;
            $data['membership_type'] = $request->membership_type;
            $data['active_status'] = $request->active_status;
            // $data['member_image'] = $imageFile;

            $updated = DB::table('society_members')
                            ->where('id', $id)
                            ->update($data);

            // Check if the update was successful
         if ($updated){
            // Return a success response
                return redirect()->back()->with('success_message', 'Member Information is updated successfully!');
            }else{
            // Return a failure response
                return redirect()->back()->with('error_message', 'Member Information failed or no changes were made');
            }

        }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $member = DB::table('society_members')->where('id', $id)->first();

            if (!$member) {
                return response()->json(['success' => false, 'message' => 'Member not found.'], 404);
            }

            // Delete the branch using Query Builder
            DB::table('society_members')->where('id', $id)->delete();

            // Return a success response
            return response()->json(['success' => true, 'message' => 'Member has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Member.']);
        }
    }
}
