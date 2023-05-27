<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    //
    public function index(Event $event)
    {
        $ticketsBuilder = DB::table('tickets');
        $tickets = $ticketsBuilder
            ->where('event_id',$event['id'])
            ->get();
        // dd($tickets);
        return view('detail.index')
            ->with([
                'event' => $event,
                'tickets' => $tickets
            ]);
    }
}
