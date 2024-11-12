<?php

namespace Modules\SocietyManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SocietySoldTicketController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        return view('societymanagement::index');
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
        
        return view('societymanagement::sold_tickets.create',compact('events'));
    }


     //event and ticket depandancy
     public function event_ticket_dependancy(Request $request){
        $selectedEvent = $request->input('data');
        $user_company_id = Auth::user()->company_id;

        $tickets = DB::table('society_tickets')
                        ->where('event_id',$selectedEvent)
                        ->where('company_id',$user_company_id)
                        ->get();

        $str="<option value=''>-- Select --</option>";
       
        foreach ($tickets as $ticket) {
            $ticketType = $ticket->ticket_type == 1 ? 'Regular' : ($ticket->ticket_type == 2 ? 'VIP' : 'Unknown');
            $str .= "<option value='$ticket->id'> $ticketType </option>";
        }
        echo $str;
    }

     //Ticket type and ticket price depandancy
     public function ticket_price_dependancy(Request $request){
        $selectedTicket = $request->input('data');
        $user_company_id = Auth::user()->company_id;

        $ticket = DB::table('society_tickets')
                        ->where('id',$selectedTicket)
                        ->where('company_id',$user_company_id)
                        ->first();

        $ticket_price = $ticket->ticket_price;
        $ticket_available_quantity = $ticket->ticket_quantity;

       
        if ($ticket) {
            // Return ticket price and available quantity as JSON
            return response()->json([
                'ticket_price' => $ticket->ticket_price,
                'ticket_available_quantity' => $ticket->ticket_quantity
            ]);
        }
    
        // In case no ticket is found, return a default response
        return response()->json([
            'ticket_price' => 0,
            'ticket_available_quantity' => 0
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ticket_selling_date' => 'required|date',
            'event_id' => 'required|numeric',
            'ticket_id' => 'required|numeric',
            'sold_ticket_quantity' => 'required|numeric'
        ];

        $customMessages = [
            'ticket_selling_date.required' => 'Ticket Selling Date is required',
            'event_id.required' => 'Event Name is required',
            'ticket_id.required' => 'Ticket Type is required',
            'sold_ticket_quantity.required' => 'Ticket Quantity is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_company_id = Auth::user()->company_id;

        $ticket = DB::table('society_tickets')
                     ->where('id',$request->ticket_id)
                     ->first();

        $ticket_price = $ticket->ticket_price;
        $current_ticket_quantity = $ticket->ticket_quantity;
        $sold_ticket_quantity = $request->sold_ticket_quantity;

        if($sold_ticket_quantity > $current_ticket_quantity){

            return redirect()->route('sold_event_tickets.create')->with('error_message', 'Sold quantity cannot exceed available quantity.!');
        }else{
        
            $remaining_ticket_quantity = $current_ticket_quantity - $sold_ticket_quantity;
            $total_revenue = $ticket_price * $sold_ticket_quantity;
        
            $sold_event_ticket = DB::table('society_sold_tickets')
                                ->insertGetId([
                                'company_id'=>$user_company_id,
                                'event_id'=>$request->event_id,
                                'ticket_id'=>$request->ticket_id,
                                'ticket_selling_date'=>$request->ticket_selling_date,
                                'sold_ticket_quantity'=>$request->sold_ticket_quantity,
                                'total_revenue'=>$total_revenue
                                ]);

            $data = array();
            $data['ticket_quantity'] = $remaining_ticket_quantity;           
            $updated = DB::table('society_tickets')
                        ->where('id', $request->ticket_id)
                        ->update($data);

            return redirect()->route('sold_event_tickets.create')->with('success_message', 'Ticket is sold successfully!');
        }

        
        
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
        return view('societymanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
