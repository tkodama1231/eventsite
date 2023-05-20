<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Prefecture;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // dd($request);

        //フォームからの入力値をすべて取得
        $dir = 'image';
        $inputs = $request->all();
        $fileData = file_get_contents(
            $request->file('image')->getPathname()
        );
        $request->file('image')->store('public/'.$dir);
        $file_name = $request->file('image')->hashName();
        $file_path = 'storage/'.$dir.'/'.$file_name;

        // dd($inputs);

        //確認ページに表示
        //入力値を引数に渡す
        return view('publish.confirm')
            ->with([
                'inputs' => $inputs,
                'fileData' => $fileData,
                'file_path' => $file_path]);

    }

    public function post(Request $request)
    {

        //バリデーション
        //あとで考える

        //  dd($request);

        //actionの値を取得
        $action = $request->input('action');

        //フォームから入力値をすべて取得
        $inputs = $request->all();
        // dd($inputs);

        //file_path取得
        $file_path = $request->file_path;

        //actionの値分岐
        if($action !== 'submit'){

            //storageの画像削除
            dd($file_path)
            \Storage::disk('public')->delete($file_path);

            //戻るボタンの場合リダイレクト処理
            return redirect()
            ->route('publish.index')
            ->withInput($inputs);

        } else {

            //二重送信対策のためトークンを再発行
            $request->session()->regenerateToken();


            //DB保存処理
            //   dd($request);
            // $dir = 'image';
            // $request->file('image')->store('public/'.$dir);
            // $file_name = $request->file_name;

            $event = new Event();
            $event->name = Auth::id();
            $event->title = $request->title;
            $event->image = $file_path;
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
                $ticket->ticket_fee = $request->tickets_fee[$i];
                $ticket->ticket_amount = $request->tickets_amount[$i];
                $ticket->ticket_remain = $request->tickets_amount[$i];

                $ticket->save();

            }

            //送信完了ページのviewを表示
            return view('publish.thanks');

        }


    }
}
