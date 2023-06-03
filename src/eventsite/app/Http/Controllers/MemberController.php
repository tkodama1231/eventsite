<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Participant;

class MemberController extends Controller
{
    //
    public function host()
    {
        $user_id = Auth::id();
        $eventquery = Event::query();
        $eventquery->where('user_id', $user_id)->get();
        $events = $eventquery->paginate(20);
        // dd($events);
        return view('member.host')
            ->with(['events'=>$events]);
    }

    public function participant()
    {
        $user_id = Auth::id();
        $participantquery = Participant::query();
        $participantquery->where('user_id', $user_id)->get();
        $event_ids = $participantquery->pluck('event_id');
        //   dd($event_ids);

        $eventquery = Event::whereIn('id', $event_ids)->paginate(20);

        $events = $eventquery;
            //  dd($events);


        return view('member.participant')
            ->with(['events'=>$events]);
    }
}
