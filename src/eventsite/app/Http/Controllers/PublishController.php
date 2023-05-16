<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Prefecture;
use App\Models\Ticket;
use Illuminate\Http\Request;

class PublishController extends Controller
{
    public function index()
    {
        $prefectures = Prefecture::get();
        $categories = Category::get();

        return view('publish.index')
            ->with([
                'prefectures' => $prefectures,
                'categories' => $categories]);
    }

    public function confirm(Request $request)
    {
        //  dd($request);
        $dir = 'image';
        // $request->file('image')->store('public/'.$dir);
        // $file_name = $request->file('image')->hashName();
        $file_name = 'https://via.placeholder.com/640x480.png/009977?text=repudiandae';

        $event = new Event();
        $event->name = 'test_name';
        $event->title = 'test_title';
        // $event->image = 'storage/'.$dir.'/'.$file_name;
        $event->image = $file_name;
        $event->body = 'test_body';
        $event->start_date = date('Y-m-d H:i:s');
        $event->finish_date = date('Y-m-d H:i:s', strtotime('+1 day'));
        $event->situation = 'offline';
        $event->venue = 'test_venue';
        $event->category = 'A';
        $event->address = '東京都';
        $event->save();

        $event=Event::latest()->first();

        foreach($request->tickets_name as $i=>$value) {

            $ticket = new Ticket();
            $ticket->event_id = $event->id;
            $ticket->ticket_name = $value;
            // $ticket->ticket_fee = $request->input('ticket_fee');
            $ticket->ticket_fee = $request->tickets_fee[$i];
            // $ticket->ticket_amount = $request->input('ticket_amount');
            $ticket->ticket_amount = $request->tickets_amount[$i];
            // $ticket->ticket_remain = $request->input('ticket_amount');
            $ticket->ticket_remain = $request->tickets_amount[$i];

            $ticket->save();

        }

        $tickets=Ticket::where('event_id', $event->id)->get();

        // dd($ticket);


        return view('publish.confirm')
            ->with([
                'event'=>$event,
                'tickets'=>$tickets
            ]);
    }
}
