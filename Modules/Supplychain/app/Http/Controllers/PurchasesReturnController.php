<?php

namespace Modules\Supplychain\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Supplychain\Models\ScmPurchaseReturn;
use Yajra\DataTables\Facades\DataTables;

class PurchasesReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ScmPurchaseReturn::with('purchase:id,purchase_date')
                        ->with('purchase.supplier:id,name')
                        ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Pur_ret_id', function($row) {
                    return 'Pur_ret #' . $row->id;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('supplychain.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('supplychain.destroy', $row->id).'\', '.$row->id.', \'supplierTable\')">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('supplychain::purchaseReturn.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplychain::purchaseReturn.create');
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
        return view('supplychain::purchaseReturn.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('supplychain::purchaseReturn.edit');
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
