<?php

namespace Modules\Inventory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Models\InventoryCategorie;
use Modules\Inventory\Models\InventoryProduct;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = InventoryProduct::with('category')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('product.edit', $row->id) . '" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\'' . route('product.destroy', $row->id) . '\', ' . $row->id . ', \'ordersTable\')">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('inventory::product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = InventoryCategorie::get();
        return view('inventory::product.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'cost_price' => 'required',
            'selling_price' => 'required',
        ]);

        try {
            InventoryProduct::create([
                'name' =>  $request->name,
                'category_id' =>  $request->category_id,
                'company_id' =>  Auth::user()->company_id,
                'cost_price' =>  $request->cost_price,
                'selling_price' =>  $request->selling_price,
                'description' =>  $request->description,
            ]);

            return redirect()->route('product.index')->with('success_message', 'Product created successfully!'); // Redirect with success message
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
        $product = InventoryProduct::find($id);
        $category = InventoryCategorie::get();
        return view('inventory::product.edit',compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        InventoryProduct::where('id',$id)->update([
            'name' =>  $request->name,
            'category_id' =>  $request->category_id,
            'company_id' =>  Auth::user()->company_id,
            'cost_price' =>  $request->cost_price,
            'selling_price' =>  $request->selling_price,
            'description' =>  $request->description,
        ]);
        return redirect()->route('product.index')->with('success_message', 'Product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        InventoryProduct::where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Product deleted successfully!']);
    }
}
