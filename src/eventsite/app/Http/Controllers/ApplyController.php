<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Http\Requests\ApplyRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApplyController extends Controller
{
    //
    public function index(Event $event)
    {
        // $event = $request->input('event');
        $user = Auth::user();
        // dd($user);
        if(isset($user)){
            $ticketsBuilder = DB::table('tickets');
            $tickets = $ticketsBuilder
                ->where('event_id',$event['id'])
                ->get();
            return view('apply.index')
                ->with([
                    'event' => $event,
                    'tickets' => $tickets
                ]);

        } else {
            return redirect()
            ->route('login');
        }

    }

    public function confirm(ApplyRequest $request)
    {
        // dd($request);
        $inputs = $request->all();
        $eventsBuilder = DB::table('events');
        // dd($inputs);
        $event = $eventsBuilder
            ->where('id', $inputs['event_id'])
            ->get();

        $ticketsBuilder = DB::table('tickets');
        $ticket = $ticketsBuilder
            ->where('id', $inputs['ticket_id'])
            ->get();

        return view('apply.confirm')
            ->with([
                'inputs' => $inputs,
                'event' => $event,
                'ticket' => $ticket
            ]);


    }
}
