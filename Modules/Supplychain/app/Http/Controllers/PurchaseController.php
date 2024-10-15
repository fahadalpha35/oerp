<?php

namespace Modules\Supplychain\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Supplychain\Models\ScmPurchases;
use Modules\Supplychain\Models\ScmSupplierManagement;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Modules\Inventory\Models\InventoryProduct;
use Modules\Supplychain\Models\ScmPurchaseInfo;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  ScmPurchases::with('supplier:id,name')->get();
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
        $suppliers = ScmSupplierManagement::get();
        $product = InventoryProduct::get();
        return view('supplychain::purchase.create', compact('suppliers','product'));
    }

    public function store(Request $request)
    {
        $data = array_filter($request->only(['supplier_id', 'purchase_date','service_cost','total','sub_total','invoice_no', 'discount', 'delivary_cost', 'service_cost','tax','due','paid']));
        $purchase = ScmPurchases::create($data);

        $products = $request->input('products');
        if(isset($products)){
            foreach ($products as $key => $data) {
                ScmPurchaseInfo::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $key,
                    'quantity' => $data['quantity'],
                    'sale_price' => $data['sale_price'],
                    'purchase_price' => $data['purchase_price'],
                    'total' => $data['total'],
                ]);
            }
        }
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
        $suppliers = ScmSupplierManagement::get();
        $product = InventoryProduct::get();

        $purchase = ScmPurchases::where('id',$id)->with('purchase_info.product:id,name')->first();
        return view('supplychain::purchase.edit', compact('suppliers', 'product','purchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = array_filter($request->only(['supplier_id', 'purchase_date','service_cost','total','sub_total','invoice_no', 'discount', 'delivary_cost', 'service_cost','tax','due','paid']));
        $purchase = ScmPurchases::where('id',$id)->update($data);

        $products = $request->input('products');
        if(isset($products)){
            foreach ($products as $key => $data) {
                ScmPurchaseInfo::updateOrCreate([
                    'id' => $data['id'],
                    'purchase_id' => $id,
                ],[
                    'product_id' => $key,
                    'quantity' => $data['quantity'],
                    'sale_price' => $data['sale_price'],
                    'purchase_price' => $data['purchase_price'],
                    'total' => $data['total'],
                ]);
            }
        }
        return redirect()->route('purchase.index')->with('success_message', 'Purchase created successfully!');
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
