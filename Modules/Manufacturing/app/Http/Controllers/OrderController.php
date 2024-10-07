<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; // Import DB facade
use Modules\Inventory\Models\InventoryProduct;
use Modules\Manufacturing\Models\ManufactureClient;
use Modules\Manufacturing\Models\ManufactureOrder;
use Modules\Manufacturing\Models\ManufactureOrderCostcalculation;
use Yajra\DataTables\DataTables;
use Modules\Manufacturing\Models\ManufactureService; // Import ManufactureService model

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ManufactureOrder::with(['client:id,name', 'product:id,name', 'production'])
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('order.edit', $row->id) . '" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="' . route('order.show', $row->id) . '" class="edit btn btn-info btn-sm">View</a>';

                    if (!$row->production) {
                        $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\'' . route('order.destroy', $row->id) . '\', ' . $row->id . ', \'ordersTable\')">Delete</a>';
                    }
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
        $clint = ManufactureClient::all(); // Fetch all clients
        $product = InventoryProduct::all(); // Fetch all products
        $services = ManufactureService::all(); // Fetch all services

        return view('manufacturing::order.create', compact('clint', 'product', 'services')); // Render create view with services
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $data = ManufactureOrder::with(['client:id,name', 'product:id,name', 'order_cost'])
            ->where('id', $id)
            ->firstOrFail(); // Use firstOrFail to throw 404 if not found

        return view('manufacturing::order.show', compact('data')); // Render show view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'client_id' => 'required|integer|exists:manufacture_clients,id',
            'product_id' => 'required|integer|exists:inventory_products,id',
            'quantity' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:0',
            'delivery_date' => 'required|date',
            'internal_notes' => 'nullable|string',
            'name.*' => 'required|string',
            'amount.*' => 'required|numeric|min:0',
            'service_id.*' => 'required|integer|exists:manufacture_services,id',
        ]);

        try {
            // Extract and filter the order data
            $orderData = array_filter($request->only(['client_id', 'product_id', 'quantity', 'total', 'delivery_date', 'internal_notes']));
            $order = ManufactureOrder::create($orderData); // Create the order

            // Extract cost calculation data
            $names = $request->input('name', []);
            $amounts = $request->input('amount', []);
            $serviceIds = $request->input('service_id', []);

            // Iterate and create ManufactureOrderCostcalculation records
            foreach ($names as $key => $name) {
                ManufactureOrderCostcalculation::create([
                    'order_id' => $order->id,
                    'name' => $name,
                    'amount' => $amounts[$key],
                    'service_id' => $serviceIds[$key],
                ]);
            }

            return redirect()->route('order.index')->with('success_message', 'Manufacture Order created successfully!'); // Redirect with success message
        } catch (\Exception $e) {
            // Log the exception message for debugging (optional)
            // \Log::error($e->getMessage());

            return back()->withErrors(['error' => 'Unable to create order. Please try again.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clint = ManufactureClient::all(); // Fetch all clients
        $product = InventoryProduct::all(); // Fetch all products
        $services = ManufactureService::all(); // Fetch all services

        $order = ManufactureOrder::with(['client:id,name', 'product:id,name', 'order_cost'])
            ->where('id', $id)
            ->firstOrFail(); // Use firstOrFail to throw 404 if not found

        return view('manufacturing::order.edit', compact('order', 'clint', 'product', 'services')); // Render edit view with services
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'client_id' => 'required|integer|exists:manufacture_clients,id',
            'product_id' => 'required|integer|exists:inventory_products,id',
            'quantity' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:0',
            'delivery_date' => 'required|date',
            'internal_notes' => 'nullable|string',
            'name.*' => 'required|string',
            'amount.*' => 'required|numeric|min:0',
            'service_id.*' => 'required|integer|exists:manufacture_services,id',
        ]);

        try {
            // Extract and filter the order data
            $orderData = array_filter($request->only(['client_id', 'product_id', 'quantity', 'total', 'delivery_date', 'internal_notes']));
            ManufactureOrder::where('id', $id)->update($orderData); // Update the order

            // Extract cost calculation data
            $ids = $request->input('id', []); // Existing cost calculation IDs (if any)
            $names = $request->input('name', []);
            $amounts = $request->input('amount', []);
            $serviceIds = $request->input('service_id', []);

            // Iterate and update or create ManufactureOrderCostcalculation records
            foreach ($names as $key => $name) {
                ManufactureOrderCostcalculation::updateOrCreate(
                    [
                        'order_id' => $id,
                        'id' => $ids[$key] ?? null, // Update if ID exists, else create new
                    ],
                    [
                        'name' => $name,
                        'amount' => $amounts[$key],
                        'service_id' => $serviceIds[$key],
                    ]
                );
            }

            return redirect()->route('order.index')->with('success_message', 'Manufacture Order updated successfully!');
        } catch (\Exception $e) {
            // Log the exception message for debugging (optional)
            // \Log::error($e->getMessage());

            return back()->withErrors(['error' => 'Unable to update order. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $manufactureOrder = ManufactureOrder::find($id);

        if ($manufactureOrder) {
            $manufactureOrder->order_cost()->delete(); // Delete associated cost calculations
            $manufactureOrder->delete(); // Delete the order
            return response()->json(['success' => true, 'message' => 'Manufacture Order deleted successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Manufacture Order not found.']);
    }
}
