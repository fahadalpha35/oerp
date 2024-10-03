<?php

namespace Modules\Manufacturing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Modules\Manufacturing\Models\ManufactureClient;

class ManufacturingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ManufactureClient::with('order')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('manufacturing.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';
                    if(!$row->order){
                        $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('manufacturing.destroy', $row->id).'\', '.$row->id.', \'clientsTable\')">Delete</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manufacturing::manufacturing.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('manufacturing::manufacturing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:manufacture_clients',
            'phone' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        DB::table('manufacture_clients')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
        ]);

        return redirect()->route('manufacturing.index')->with('success_message', 'Client added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = DB::table('manufacture_clients')->find($id);
        return view('manufacturing::manufacturing.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:manufacture_clients,email,'.$id,
            'phone' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        DB::table('manufacture_clients')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
        ]);

        return redirect()->route('manufacturing.index')->with('success_message', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('manufacture_clients')->where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Client deleted successfully!']);
    }
}
