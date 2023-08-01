<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    //
    public function index(Event $event)
    {
        $user_id = Auth::id();
        if($user_id===$event['user_id']) {
            $certification = 'host';
        } else {
            $exists = DB::table('participants')
                ->where('event_id',$event['id'])
                ->where('user_id',$user_id)
                ->exists();
            if($exists) {
                $certification = 'participant';
            } else {
                $certification = 'other';
            }
        }

        $ticketsBuilder = DB::table('tickets');
        $tickets = $ticketsBuilder
            ->where('event_id',$event['id'])
            ->get();
        //  dd($certification);
        return view('detail.index')
            ->with([
                'event' => $event,
                'tickets' => $tickets,
                'certification' => $certification
            ]);
    }

    public function host(Event $event)
    {
        $user_id = Auth::id();

        $ticketsBuilder = DB::table('tickets');
        $tickets = $ticketsBuilder
            ->where('event_id',$event['id'])
            ->get();
 
        $participantsBuilder = DB::table('participants');
        $participantsBuilder
            ->where('participants.event_id',$event['id'])
            ->join('tickets', 'participants.ticket_id','=','tickets.id')
            ->join('users', 'participants.user_id','=','users.id');


        $participants_detail = $participantsBuilder->get();

        //     ->get();

        // dd($participants_detail);


        return view('detail.host')
            ->with([
                'event' => $event,
                'tickets' => $tickets,
                'participants_detail' => $participants_detail
            ]);
    }



    public function destroy(Event $event)
    {
        $event->delete();

        return view('detail.destroy');
    }

    public function cancel(Event $event)
    {
        $user_id = Auth::id();

        $participantsBuilder = DB::table('participants');
        $ticket_id = $participantsBuilder
            ->where('participants.event_id',$event['id'])
            ->where('participants.user_id',$user_id)
            ->pluck('ticket_id');
            // dd($ticket_id);

        $ticketsBuilder = DB::table('tickets');
        $ticketsBuilder
            ->where('tickets.id',$ticket_id)
            ->increment('ticket_remain');

        $participantsBuilder
            ->where('participants.event_id',$event['id'])
            ->where('participants.user_id',$user_id)
            ->delete();

        return view('detail.cancel')
            ->with(['event' => $event]);
    }
}
