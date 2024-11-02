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
                            'name',
                            'email',
                            'contact_number',
                            'joining_date',
                            'expiration_date',
                            'membership_type'
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
            $btn = '<a href="'.route('society_members.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';     
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('society_members.destroy', $row->id).'\', '.$row->id.', \'clientsTable\')">Delete</a>';

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
            'email' => 'nullable|email|unique:society_members,email', // Email is optional but must be unique if provided
            'contact_number' => 'required|string',
            'address' => 'required|string',
            'permanent_address' => 'required|string',
            'joining_date' => 'required|date',
            'membership_type' => 'required|numeric',
            'active_status' => 'required|numeric',
        ];

        $customMessages = [
            'name.required' => 'Member Full Name is required',
            'contact_number.required' => 'Contact Number is required',
            'address.required' => 'Present Address is required',
            'permanent_address.required' => 'Permanent Address is required',
            'joining_date.required' => 'Joining Date is required',
            'membership_type.required' => 'Membership Type is required',
            'active_status.required' => 'Activation Status is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;

        

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
