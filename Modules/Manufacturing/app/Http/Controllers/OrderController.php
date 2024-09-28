<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; // Import DB facade
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('manufacture_orders')->select('*'); // Use DB to get data

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('order.edit', $row->id) . '" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(' . $row->id . ')">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manufacturing::order.index'); // Render index view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manufacturing::order.create'); // Render create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'client_id' => 'required|integer|exists:manufacture_clients,id',
            'product_name' => 'required|string|max:255',
            'unit_of_measure' => 'required|string',
            'purchase_unit_of_measure' => 'required|string',
            'sales_price' => 'required|numeric',
            'cost' => 'required|numeric',
            'quantity' => 'required|integer',
            'delivery_date' => 'nullable|date',
            'internal_notes' => 'nullable|string',
            'barcode' => 'nullable|string',
            'sku_code' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        // Insert data into manufacture_orders table
        try {
            DB::table('manufacture_orders')->insert([
                'client_id' => $request->client_id,
                'product_name' => $request->product_name,
                'unit_of_measure' => $request->unit_of_measure,
                'purchase_unit_of_measure' => $request->purchase_unit_of_measure,
                'sales_price' => $request->sales_price,
                'cost' => $request->cost,
                'quantity' => $request->quantity,
                'delivery_date' => $request->delivery_date,
                'internal_notes' => $request->internal_notes,
                'barcode' => $request->barcode,
                'sku_code' => $request->sku_code,
                'image' => $request->image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('order.index')->with('success_message', 'Manufacture Order created successfully!'); // Redirect with success message
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to create order. Please try again.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = DB::table('manufacture_orders')->find($id); // Use DB to find order

        return view('manufacturing::order.edit', compact('order')); // Render edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'client_id' => 'required|integer|exists:manufacture_clients,id',
            'product_name' => 'required|string|max:255',
            'unit_of_measure' => 'required|string',
            'purchase_unit_of_measure' => 'required|string',
            'sales_price' => 'required|numeric',
            'cost' => 'required|numeric',
            'quantity' => 'required|integer',
            'delivery_date' => 'nullable|date',
            'internal_notes' => 'nullable|string',
            'barcode' => 'nullable|string',
            'sku_code' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        // Update order in manufacture_orders table
        DB::table('manufacture_orders')->where('id', $id)->update([
            'client_id' => $request->client_id,
            'product_name' => $request->product_name,
            'unit_of_measure' => $request->unit_of_measure,
            'purchase_unit_of_measure' => $request->purchase_unit_of_measure,
            'sales_price' => $request->sales_price,
            'cost' => $request->cost,
            'quantity' => $request->quantity,
            'delivery_date' => $request->delivery_date,
            'internal_notes' => $request->internal_notes,
            'barcode' => $request->barcode,
            'sku_code' => $request->sku_code,
            'image' => $request->image,
            'updated_at' => now(),
        ]);

        return redirect()->route('order.index')->with('success_message', 'Manufacture Order updated successfully!'); // Redirect with success message
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('manufacture_orders')->where('id', $id)->delete(); // Use DB to delete order

        return response()->json(['success' => true, 'message' => 'Manufacture Order deleted successfully!']);
    }
}
