<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; // Import DB facade
use Yajra\DataTables\DataTables;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('manufacture_work_orders')
                ->select('*'); // Fetch all data from work orders

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('workorder.edit', $row->id) . '" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(' . $row->id . ')">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manufacturing::workorder.index'); // Render index view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estimations = DB::table('manufacture_estimations')->get(); // Fetch all estimations
        return view('manufacturing::workorder.create', compact('estimations')); // Render create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'estimation_id' => 'required|integer|exists:manufacture_estimations,id',
            'assign_manager' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'preferred_date' => 'nullable|date',
            'preference_note' => 'nullable|string',
        ]);

        // Insert data into manufacture_work_orders table
        try {
            DB::table('manufacture_work_orders')->insert([
                'estimation_id' => $request->estimation_id,
                'assign_manager' => $request->assign_manager,
                'priority' => $request->priority,
                'notes' => $request->notes,
                'preferred_date' => $request->preferred_date,
                'preference_note' => $request->preference_note,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('workorder.index')->with('success_message', 'Work Order created successfully!'); // Redirect with success message
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to create work order. Please try again.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $workOrder = DB::table('manufacture_work_orders')->find($id); // Fetch work order by ID
        $estimations = DB::table('manufacture_estimations')->get(); // Fetch all estimations

        if ($workOrder) {
            return view('manufacturing::workorder.edit', compact('workOrder', 'estimations')); // Render edit view
        } else {
            return back()->withErrors(['error' => 'Work Order not found.']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'estimation_id' => 'required|integer|exists:manufacture_estimations,id',
            'assign_manager' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'preferred_date' => 'nullable|date',
            'preference_note' => 'nullable|string',
        ]);

        // Update work order in manufacture_work_orders table
        DB::table('manufacture_work_orders')->where('id', $id)->update([
            'estimation_id' => $request->estimation_id,
            'assign_manager' => $request->assign_manager,
            'priority' => $request->priority,
            'notes' => $request->notes,
            'preferred_date' => $request->preferred_date,
            'preference_note' => $request->preference_note,
            'updated_at' => now(),
        ]);

        return redirect()->route('workorder.index')->with('success_message', 'Work Order updated successfully!'); // Redirect with success message
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('manufacture_work_orders')->where('id', $id)->delete(); // Delete work order by ID

        return response()->json(['success' => true, 'message' => 'Work Order deleted successfully!']);
    }
}
