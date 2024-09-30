<?php

namespace Modules\Supplychain\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Supplychain\Models\ScmPurchases;
use Modules\Supplychain\Models\ScmSupplierManagement;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  ScmPurchases::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('purchase.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('purchase.destroy', $row->id).'\', '.$row->id.', \'supplierTable\')">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('supplychain::purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = ScmSupplierManagement::all();
        return view('supplychain::purchase.create', compact('suppliers'));
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:scm_supplier_managements,id',
            'purchase_date' => 'required|date',
            // Add validation rules for other fields
        ]);

        // Save purchase data
        $purchase = new ScmPurchases(); // Ensure to use the correct model name
        $purchase->supplier_id = $request->supplier_id;
        $purchase->purchase_date = $request->purchase_date;
        // Add other purchase data saving logic
        $purchase->save();

        return redirect()->route('purchase.index')->with('success_message', 'Purchase created successfully!');
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'company' => 'required|string|max:100',
            'area' => 'nullable|string|max:50',
            'address' => 'required|string',
        ]);

        $supplier = new ScmSupplierManagement();
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->company = $request->company;
        $supplier->area = $request->area;
        $supplier->address = $request->address;
        $supplier->save();

        return response()->json(['success' => 'Supplier added successfully!']);
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
        $purchase = ScmPurchases::findOrFail($id);
        $suppliers = ScmSupplierManagement::all();

        return view('supplychain::purchase.edit', compact('purchase', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $purchase = ScmPurchases::findOrFail($id);

        $request->validate([
            'supplier_id' => 'required|exists:scm_supplier_managements,id',
            'purchase_date' => 'required|date',
            'invoice_no' => 'required|string|max:100',
            'sub_total' => 'required|numeric',
            'delivary_cost' => 'nullable|numeric',
            'service_cost' => 'nullable|numeric',
            'total' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'due' => 'nullable|numeric',
            'paid' => 'nullable|numeric',
        ]);

        $purchase->update([
            'supplier_id' => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
            'invoice_no' => $request->invoice_no,
            'sub_total' => $request->sub_total,
            'delivary_cost' => $request->delivary_cost,
            'service_cost' => $request->service_cost,
            'total' => $request->total,
            'discount' => $request->discount,
            'tax' => $request->tax,
            'due' => $request->due,
            'paid' => $request->paid,
        ]);

        return redirect()->route('purchase.index')->with('success', 'Purchase updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchase = ScmPurchases::findOrFail($id);
        $purchase->delete();

        return redirect()->route('purchase.index')->with('success', 'Purchase deleted successfully!');
    }

    public function getSupplierDetails($id): JsonResponse
    {
        $supplier = ScmSupplierManagement::find($id);
        return response()->json($supplier);
    }
}
