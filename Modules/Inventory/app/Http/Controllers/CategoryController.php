<?php

namespace Modules\Inventory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\InventoryCategorie;
use Modules\Inventory\Models\InventoryItemCategory;
use Yajra\DataTables\Facades\DataTables;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = InventoryCategorie::with('item')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('category.edit', $row->id) . '" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\'' . route('category.destroy', $row->id) . '\', ' . $row->id . ', \'ordersTable\')">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('inventory::category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = InventoryItemCategory::get();
        return view('inventory::category.create',compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'item_id' => 'required',
        ]);

        try {
            InventoryCategorie::create([
                'name' =>  $request->name,
                'status' =>  $request->status,
                'item_id' =>  $request->item_id,
            ]);

            return redirect()->route('category.index')->with('success_message', 'Category created successfully!'); // Redirect with success message
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to create order. Please try again.']);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('inventory::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = InventoryCategorie::find($id);
        $item = InventoryItemCategory::get();

        return view('inventory::category.edit',compact('item','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        InventoryCategorie::where('id',$id)->update([
            'name' =>  $request->name,
            'status' =>  $request->status,
            'item_id' =>  $request->item_id,
        ]);
        return redirect()->route('category.index')->with('success_message', 'Category Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        InventoryCategorie::where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted successfully!']);
    }
}
