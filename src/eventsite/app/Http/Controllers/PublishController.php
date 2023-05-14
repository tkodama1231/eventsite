<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Prefecture;
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
        $dir = 'image';
        $request->file('image')->store('public/'.$dir);
        $file_name = $request->file('image')->hashName();

        $event = new Event();
        $event->name = 'test_name';
        $event->title = 'test_title';
        $event->image = 'storage/'.$dir.'/'.$file_name;
        $event->body = 'test_body';
        $event->start_date = date('Y-m-d H:i:s');
        $event->finish_date = date('Y-m-d H:i:s', strtotime('+1 day'));
        $event->situation = 'offline';
        $event->venue = 'test_venue';
        $event->category = 'A';
        $event->address = '東京都';
        $event->save();

        $event=Event::latest()->first();

        return view('publish.confirm')
            ->with(['event'=>$event]);
    }
}
