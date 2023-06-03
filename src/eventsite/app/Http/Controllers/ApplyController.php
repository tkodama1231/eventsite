<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Participant;
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

    public function thanks(Request $request)
    {
        // dd($request);
        //participantsテーブル更新
        $participant = new Participant();
        $participant->event_id = $request->event_id;
        $participant->user_id = Auth::id();
        $participant->ticket_id = $request->ticket_id;
        $participant->payment = $request->payment;
        $participant->save();

        //ticketテーブル更新
        $ticketBuilder = DB::table('tickets');
        $ticketBuilder->where('id', $request->ticket_id)->decrement('ticket_remain');

        //申し込みイベントのIDを取得
        $event_id = $request->event_id;

        return view('apply.thanks')
            ->with([
                'event_id' => $event_id
            ]);


    }
}
