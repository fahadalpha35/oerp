<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                ->join('manufacture_estimations', 'manufacture_work_orders.estimation_id', '=', 'manufacture_estimations.id')
                ->select('manufacture_work_orders.*', 'manufacture_estimations.estimation_number') // Change according to your needs
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="'.$row->id.'">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manufacturing::workorder.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estimations = DB::table('manufacture_estimations')->get(); // Fetch all estimations for the dropdown
        return view('manufacturing::workorder.create', compact('estimations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estimation_id' => 'required|integer|exists:manufacture_estimations,id',
            'assign_manager' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'preferred_date' => 'nullable|date',
            'preference_note' => 'nullable|string',
        ]);

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

        return response()->json(['success' => 'Work Order created successfully.']);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $workOrder = DB::table('manufacture_work_orders')->find($id);
        return response()->json($workOrder);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $workOrder = DB::table('manufacture_work_orders')->find($id);
        $estimations = DB::table('manufacture_estimations')->get(); // Fetch all estimations for the dropdown
        return response()->json(['workOrder' => $workOrder, 'estimations' => $estimations]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'estimation_id' => 'required|integer|exists:manufacture_estimations,id',
            'assign_manager' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'preferred_date' => 'nullable|date',
            'preference_note' => 'nullable|string',
        ]);

        DB::table('manufacture_work_orders')->where('id', $id)->update([
            'estimation_id' => $request->estimation_id,
            'assign_manager' => $request->assign_manager,
            'priority' => $request->priority,
            'notes' => $request->notes,
            'preferred_date' => $request->preferred_date,
            'preference_note' => $request->preference_note,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => 'Work Order updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('manufacture_work_orders')->where('id', $id)->delete();
        return response()->json(['success' => 'Work Order deleted successfully.']);
    }
}
