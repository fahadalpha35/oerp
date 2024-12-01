<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SocietyInsuranceController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        if ($request->ajax()){
      
            $user_company_id = Auth::user()->company_id;

            $society_insurances = DB::table('society_insurances')
                          ->leftJoin('society_members','society_insurances.member_id','society_members.id')
                        ->select(
                            'society_insurances.id',
                            'society_insurances.policy_number',
                            'society_insurances.provider',
                            'society_insurances.start_date',
                            'society_insurances.end_date',
                            'society_insurances.premium_amount',
                            'society_insurances.status as insurance_status',
                            'society_members.name as member_name'
                            )
                        ->where('society_insurances.company_id', $user_company_id)
                        ->get();

        
        return DataTables::of($society_insurances)
        ->addIndexColumn()
        ->addColumn('status_label', function ($row) {
            if($row->insurance_status == 1){
                return '<span style = "color : #2b0d99;">Pending</span>';
            }else{
                return '<span style = "color : green;">Collected</span>' ;
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('fund_collections.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('fund_collections.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['fund_collection_status_label','action'])
        ->make(true);
        }

        return view('societymanagement::insurances.index');
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
