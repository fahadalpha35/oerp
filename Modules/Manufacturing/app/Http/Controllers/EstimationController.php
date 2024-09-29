<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; // Import DB facade
use Yajra\DataTables\DataTables;

class EstimationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('manufacture_estimations')
                ->join('manufacture_orders', 'manufacture_estimations.order_id', '=', 'manufacture_orders.id')
                ->select('manufacture_estimations.*', 'manufacture_orders.product_name');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('estimation.edit', $row->id) . '" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('estimation.destroy', $row->id).'\', '.$row->id.', \'estimationsTable\')">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manufacturing::estimation.index'); // Render index view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = DB::table('manufacture_orders')->get(); // Fetch all orders for the dropdown
        return view('manufacturing::estimation.create', compact('orders')); // Render create view with orders
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'order_id' => 'required|integer|exists:manufacture_orders,id',
            'estimation_number' => 'required|string|max:255',
            'estimation_date' => 'required|date',
        ]);

        // Insert data into manufacture_estimations table
        try {
            DB::table('manufacture_estimations')->insert([
                'order_id' => $request->order_id,
                'estimation_number' => $request->estimation_number,
                'estimation_date' => $request->estimation_date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('estimation.index')->with('success_message', 'Manufacture Estimation created successfully!'); // Redirect with success message
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to create estimation. Please try again.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estimation = DB::table('manufacture_estimations')->find($id); // Use DB to find estimation
        $orders = DB::table('manufacture_orders')->get(); // Fetch all orders for the dropdown

        return view('manufacturing::estimation.edit', compact('estimation', 'orders')); // Render edit view with orders
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'order_id' => 'required|integer|exists:manufacture_orders,id',
            'estimation_number' => 'required|string|max:255',
            'estimation_date' => 'required|date',
        ]);

        // Update estimation in manufacture_estimations table
        try {
            DB::table('manufacture_estimations')->where('id', $id)->update([
                'order_id' => $request->order_id,
                'estimation_number' => $request->estimation_number,
                'estimation_date' => $request->estimation_date,
                'updated_at' => now(),
            ]);

            return redirect()->route('estimation.index')->with('success_message', 'Manufacture Estimation updated successfully!'); // Redirect with success message
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to update estimation. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::table('manufacture_estimations')->where('id', $id)->delete(); // Use DB to delete estimation

            return response()->json(['success' => true, 'message' => 'Manufacture Estimation deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete estimation.']);
        }
    }
}
