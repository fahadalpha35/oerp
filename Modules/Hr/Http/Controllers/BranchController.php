<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = DB::table('hr_branches')->get();
        $dataTable = DataTables::collection($branches)
        ->addColumn('action', function($row){
            // Add an action column (like edit/delete buttons)
            $btn = '<a href="edit/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
            return $btn;
        })
        ->rawColumns(['action']) // Ensure action column supports raw HTML
        ->make(true);
        return view('hr::branches.index',['branches' => $dataTable->getData()->data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hr::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('hr::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('hr::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
