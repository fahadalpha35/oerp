<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Manufacturing\Models\ManufactureOrder;
use Modules\Manufacturing\Models\ManufactureOrderCostcalculation;
use Modules\Manufacturing\Models\ManufactureProduction;
use Modules\Manufacturing\Models\ManufactureProductionCostCalculation;
use Yajra\DataTables\Facades\DataTables;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ManufactureProduction::with('order:id,client_id','order.client:id,name,email')
                    ->get()
                    ->map(function ($production) {
                        $clientName = $production->order && $production->order->client ? $production->order->client->name : '';
                        $production->order_number = $production->order->id . ' - ' . $clientName;
                        return $production;
                    });
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('production.edit', $row->id) . '" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="' . route('production.show', $row->id) . '" class="edit btn btn-info btn-sm">View</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('production.destroy', $row->id).'\', '.$row->id.', \'productionTable\')">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search')['value'])) {
                        $searchValue = $request->get('search')['value'];
                        $instance->collection = $instance->collection->filter(function ($row) use ($searchValue) {
                            return (strpos($row['worker'], $searchValue) !== false) ||
                                   (strpos($row['duration'], $searchValue) !== false);
                        });
                    }
                })
                ->make(true);
        }
        return view('manufacturing::production.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $order = ManufactureOrder::with('client:id,name')->doesntHave('production')->get();
        return view('manufacturing::production.create',compact('order'));
    }
    public function getOrderDetails(Request $request){
        $data = ManufactureOrder::with('order_cost')->where('id',$request->id)->first();

        $html = '<h3 class="mb-4">Work Order Cost Calculation</h3>';
        $html .= '<table class="table table-bordered table-hover">';
        $html .= '<thead><tr><th>Name</th><th>Amount</th></tr></thead>';
        $html .= '<tbody>';

        foreach ($data['order_cost'] as $item) {
            $html .= '<tr>';
            $html .= '<td>' . $item['name'] . '</td>';
            $html .= '<td>' . $item['amount'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tr>';
        $html .= '<td><h5 style="font-weight: revert;">Total</h5></td>';
        $html .= '<td>'  . $data['total'] . '</td>';
        $html .= '</tr>';

        $html .= '</tbody></table>';

        // Return the generated HTML as JSON response
        return response()->json($html);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:manufacture_orders,id|unique:manufacture_productions',
        ]);

        try {
            $data = array_filter($request->only(['order_id', 'worker', 'duration','total']));
            $production = ManufactureProduction::create($data);

            $names = $request->input('name');
            $amounts = $request->input('amount');
            if(isset($names)){
                foreach ($names as $key => $name) {
                    ManufactureProductionCostCalculation::create([
                        'production_id' => $production->id,
                        'name' => $name,
                        'amount' => $amounts[$key],
                    ]);
                }
            }
            return redirect()->route('production.index')->with('success_message', 'Manufacture Order created successfully!'); // Redirect with success message
        }catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $production = ManufactureProduction::with('production_cost')
                    ->with(
                        'order:id,client_id',
                        'order.client:id,name'
                        )
                    ->where('id',$id)->first();
        return view('manufacturing::production.show', compact('production'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $production = ManufactureProduction::with('production_cost')
                            ->with('order:id,client_id','order.client:id,name')
                            ->where('id',$id)->first();
        return view('manufacturing::production.edit',compact('production'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = array_filter($request->only(['order_id', 'worker', 'duration','total']));
            $production = ManufactureProduction::where('id',$id)->update($data);

            $ids = $request->input('id');
            $names = $request->input('name');
            $amounts = $request->input('amount');
            foreach ($names as $key => $name) {
                ManufactureProductionCostCalculation::updateOrCreate(
                    [
                        'production_id' => $id,
                        'id' => $ids[$key],
                    ],
                    [
                    'name' => $name,
                    'amount' => $amounts[$key],
                ]);
            }
            return redirect()->route('production.index')->with('success_message', 'Manufacture Order created successfully!'); // Redirect with success message
        }catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $manufactureOrder = ManufactureProduction::find($id);
        if ($manufactureOrder) {
            $manufactureOrder->production_cost()->delete();
            $manufactureOrder->delete();
            return response()->json(['success' => true, 'message' => 'Manufacture Order deleted successfully!']);
        }
    }
}
