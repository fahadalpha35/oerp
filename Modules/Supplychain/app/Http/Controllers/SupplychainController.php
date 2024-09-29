<?php

namespace Modules\Supplychain\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Supplychain\Models\ScmSupplierManagement;
use Yajra\DataTables\Facades\DataTables;

class SupplychainController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  ScmSupplierManagement::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('supplychain.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('supplychain.destroy', $row->id).'\', '.$row->id.', \'supplierTable\')">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('supplychain::supplierManagment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplychain::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('supplychain::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('supplychain::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ScmSupplierManagement::where('id',$id)->delete();
        return response()->json(['success' => true, 'message' => 'Client deleted successfully!']);
    }
}
