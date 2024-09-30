<?php

namespace Modules\Supplychain\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
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
            $data = ScmSupplierManagement::get();
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
        return view('supplychain::supplierManagment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:scm_supplier_managements',
            'phone' => 'required|unique:scm_supplier_managements',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'area' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the supplier
        $supplier = ScmSupplierManagement::create($request->all());

        return response()->json([
            'success' => true,
            'supplier' => $supplier,
            'message' => 'Supplier added successfully!',
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $supplier = ScmSupplierManagement::find($id);

        if (!$supplier) {
            return response()->json(['error' => 'Supplier not found'], 404);
        }

        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = ScmSupplierManagement::findOrFail($id);
        return view('supplychain::supplierManagment.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:scm_supplier_managements,email,' . $id,
            'phone' => 'required|unique:scm_supplier_managements,phone,' . $id,
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $updateData = array_filter($request->only(['name', 'email', 'phone', 'company', 'address', 'area']));

        ScmSupplierManagement::where('id', $id)->update($updateData);

        return redirect()->route('supplychain.index')->with('success_message', 'Supply chain is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ScmSupplierManagement::where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Supplier deleted successfully!']);
    }
}
