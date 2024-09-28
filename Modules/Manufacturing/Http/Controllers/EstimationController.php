<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                ->select('manufacture_estimations.*', 'manufacture_orders.product_name') // Change according to your needs
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

        return view('manufacturing::estimation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = DB::table('manufacture_orders')->get(); // Fetch all orders for the dropdown
        return view('manufacturing::estimation.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:manufacture_orders,id',
            'estimation_number' => 'required|string|max:255',
            'estimation_date' => 'required|date',
        ]);

        DB::table('manufacture_estimations')->insert([
            'order_id' => $request->order_id,
            'estimation_number' => $request->estimation_number,
            'estimation_date' => $request->estimation_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => 'Manufacture Estimation created successfully.']);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $estimation = DB::table('manufacture_estimations')->find($id);
        return response()->json($estimation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estimation = DB::table('manufacture_estimations')->find($id);
        $orders = DB::table('manufacture_orders')->get(); // Fetch all orders for the dropdown
        return response()->json(['estimation' => $estimation, 'orders' => $orders]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:manufacture_orders,id',
            'estimation_number' => 'required|string|max:255',
            'estimation_date' => 'required|date',
        ]);

        DB::table('manufacture_estimations')->where('id', $id)->update([
            'order_id' => $request->order_id,
            'estimation_number' => $request->estimation_number,
            'estimation_date' => $request->estimation_date,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => 'Manufacture Estimation updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('manufacture_estimations')->where('id', $id)->delete();
        return response()->json(['success' => 'Manufacture Estimation deleted successfully.']);
    }
}
