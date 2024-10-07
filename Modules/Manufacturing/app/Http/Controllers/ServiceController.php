<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; // Import DB facade
use DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('manufacture_services')->select('*'); // Use DB to get data

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('service.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('service.destroy', $row->id).'\', '.$row->id.', \'servicesTable\')">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manufacturing::service.index'); // Render index view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manufacturing::service.create'); // Render create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        DB::table('manufacture_services')->insert([ // Use DB to insert only name
            'name' => $request->name,
        ]);

        return redirect()->route('service.index')->with('success_message', 'Service added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = DB::table('manufacture_services')->find($id); // Use DB to find service

        return view('manufacturing::service.edit', compact('service')); // Render edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        DB::table('manufacture_services')->where('id', $id)->update([ // Use DB to update only name
            'name' => $request->name,
        ]);

        return redirect()->route('service.index')->with('success_message', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('manufacture_services')->where('id', $id)->delete(); // Use DB to delete service

        return response()->json(['success' => true, 'message' => 'Service deleted successfully!']);
    }
}
