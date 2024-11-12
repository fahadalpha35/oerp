<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SocietyTicketController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        if ($request->ajax()) {
      
            $user_company_id = Auth::user()->company_id;

            $event_tickets = DB::table('society_tickets')
                          ->leftJoin('society_events','society_tickets.event_id','society_events.id')
                        ->select(
                            'society_events.event_name',
                            'society_tickets.id',
                            'society_tickets.ticket_type',
                            'society_tickets.ticket_price',
                            'society_tickets.ticket_quantity',
                            'society_tickets.ticket_status'                          
                            )
                        ->where('society_tickets.company_id', $user_company_id)
                        ->get();

        
        return DataTables::of($event_tickets)
        ->addIndexColumn()
        ->addColumn('ticket_type_label', function ($row) {
            if($row->ticket_type == 1){
                return '<span style = "color : #2b0d99;">Regular</span>';
            }else{
                return '<span style = "color : green;">VIP</span>';
            }
        })
        ->addColumn('ticket_status_label', function ($row) {
            if($row->ticket_status == 1){
                return '<span style = "color : green;">Available</span>';
            }else{
                return '<span style = "color : red;">Not Available</span>';
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('event_tickets.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';   
            $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteOperation(\''.route('event_tickets.destroy', $row->id).'\', '.$row->id.', \'exampleTable\')">Delete</a>';

            return $btn;
        })
        ->rawColumns(['ticket_type_label','ticket_status_label','action'])
        ->make(true);
        }

        return view('societymanagement::event_tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_company_id = Auth::user()->company_id;
        $events = DB::table('society_events')
                     ->where('event_status','<>',3)
                     ->where('company_id',$user_company_id)
                     ->get();
        
        return view('societymanagement::event_tickets.create',compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'event_id' => 'required|numeric',
            'ticket_type' => 'required|numeric',
            'ticket_price' => 'required|numeric',
            'ticket_quantity' => 'required|numeric',
            'ticket_status' => 'required|numeric'
        ];

        $customMessages = [
            'event_id.required' => 'Event Name is required',
            'ticket_type.required' => 'Ticket Type is required',
            'ticket_price.required' => 'Ticket Price is required',
            'ticket_quantity.required' => 'Ticket Quantity is required',
            'ticket_status.required' => 'Status is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;
       
        $event_ticket = DB::table('society_tickets')
                            ->insertGetId([
                            'company_id'=>$user_company_id,
                            'event_id'=>$request->event_id,
                            'ticket_type'=>$request->ticket_type,
                            'ticket_price'=>$request->ticket_price,
                            'ticket_quantity'=>$request->ticket_quantity,
                            'ticket_status'=>$request->ticket_status
                            ]);

        return redirect()->route('event_tickets.index')->with('success_message', 'Ticket is added successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('societymanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ticket = DB::table('society_tickets')
                    ->leftJoin('society_events','society_tickets.event_id','society_events.id')
                    ->select(
                        'society_events.event_name as society_event_name',
                        'society_tickets.id',
                        'society_tickets.event_id',
                        'society_tickets.ticket_type',
                        'society_tickets.ticket_price',
                        'society_tickets.ticket_quantity',
                        'society_tickets.ticket_status'                          
                        )
                    ->where('society_tickets.id', $id)
                    ->first();

        $user_company_id = Auth::user()->company_id;
        $events = DB::table('society_events')
                    ->where('event_status','<>',3)
                    ->where('company_id',$user_company_id)
                    ->get();

        
        return view('societymanagement::event_tickets.edit',compact('ticket','events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'event_id' => 'required|numeric',
            'ticket_type' => 'required|numeric',
            'ticket_price' => 'required|numeric',
            'ticket_quantity' => 'required|numeric',
            'ticket_status' => 'required|numeric'
        ];

        $customMessages = [
            'event_id.required' => 'Event Name is required',
            'ticket_type.required' => 'Ticket Type is required',
            'ticket_price.required' => 'Ticket Price is required',
            'ticket_quantity.required' => 'Ticket Quantity is required',
            'ticket_status.required' => 'Status is required'
        ];

        $this->validate($request, $rules, $customMessages);
        $data = array();
        $data['event_id'] = $request->event_id;
        $data['ticket_type'] = $request->ticket_type;
        $data['ticket_price'] = $request->ticket_price;
        $data['ticket_quantity'] = $request->ticket_quantity;
        $data['ticket_status'] = $request->ticket_status;
       

        $updated = DB::table('society_tickets')
                        ->where('id', $id)
                        ->update($data);

        // Check if the update was successful
     if ($updated){
        // Return a success response
            return redirect()->back()->with('success_message', 'Event Ticket Information is updated successfully!');
        }else{
        // Return a failure response
            return redirect()->back()->with('error_message', 'Event Ticket Information failed or no changes were made');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the branch exists using Query Builder
            $event_ticket = DB::table('society_tickets')->where('id', $id)->first();
            if (!$event_ticket) {
                return response()->json(['success' => false, 'message' => 'Event Ticket not found.'], 404);
            }
            // Delete the branch using Query Builder
            DB::table('society_tickets')->where('id', $id)->delete();
            // Return a success response
            return response()->json(['success' => true, 'message' => 'Event Ticket has been deleted successfully!']);
        } catch (\Exception $e) {
            // If an error occurs, return an error response
            return response()->json(['success' => false, 'message' => 'Error deleting Event Ticket.']);
        }
    }
}
