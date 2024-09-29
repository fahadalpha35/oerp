<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; // Import DB facade
use DataTables;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('manufacture_parts')->select('*'); // Use DB to get data

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route('part.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('part.destroy', $row->id).'\', '.$row->id.', \'partsTable\')">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manufacturing::part.index'); // Render index view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manufacturing::part.create'); // Render create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'unit' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::table('manufacture_parts')->insert([ // Use DB to insert data
            'name' => $request->name,
            'price' => $request->price,
            'unit' => $request->unit,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('part.index')->with('success_message', 'Part added successfully!'); // Redirect with success message
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $part = DB::table('manufacture_parts')->find($id); // Use DB to find part

        return view('manufacturing::part.edit', compact('part')); // Render edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'unit' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::table('manufacture_parts')->where('id', $id)->update([ // Use DB to update data
            'name' => $request->name,
            'price' => $request->price,
            'unit' => $request->unit,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return redirect()->route('part.index')->with('success_message', 'Part updated successfully!'); // Redirect with success message
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('manufacture_parts')->where('id', $id)->delete(); // Use DB to delete part

        return response()->json(['success' => true, 'message' => 'Part deleted successfully!']);
    }
}
