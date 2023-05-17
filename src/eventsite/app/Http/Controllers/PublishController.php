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
        //バリデーションルールを定義
        //引っかかるとエラーを起こしてくれる
        // $request->validate([
        //     'email' => 'required|email',
        //     'title' => 'required',
        //     'body' => 'required',
        // ]);

        //フォームからの入力値をすべて取得
        $inputs = $request->all();
        $fileData = file_get_contents(
            $request->file('image')->getPathname()
        );

        //  dd($fileData);

        //確認ページに表示
        //入力値を引数に渡す
        return view('publish.confirm', [
            'inputs' => $inputs,
            'fileData' => $fileData
        ]);

    }

    public function post(Request $request)
    {
        //  dd($request);
        $dir = 'image';
        $request->file('image')->store('public/'.$dir);
        $file_name = $request->file('image')->hashName();
        // $file_name = 'https://via.placeholder.com/640x480.png/009977?text=repudiandae';

        $event = new Event();
        $event->name = 'test_name';
        $event->title = $request->title;
        $event->image = 'storage/'.$dir.'/'.$file_name;
        // $event->image = $file_name;
        $event->body = $request->body;
        $event->start_date = $request->start_date;
        $event->finish_date = $request->finish_date;
        $event->situation = $request->situation;
        $event->venue = $request->venue;
        $event->category = $request->category;
        $event->address = $request->address;
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
