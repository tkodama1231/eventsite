<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Prefecture;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index()
    {
        $events = Event::paginate(20);
        $categories = Category::get();
        $prefectures = Prefecture::get();

        return view('search.index')
            ->with([
                'events' => $events,
                'categories' => $categories,
                'prefectures' => $prefectures,
            ]);

    }

    public function search(Request $request)
    {
       $categories = Category::get();
       $prefectures = Prefecture::get();

        //イベント一覧をページネートで取得
        $events = Event::paginate(20);


        //検索フォームで入力された値を取得する
        $search = $request->input('keyword');
        $search_category_id = $request->input('category');
        $search_prefecture_id = $request->input('prefecture');
        $search_date = $request->input('date');



        //クエリビルダ
        $query = Event::query();

        //もし検索フォームにキーワードが入力されたら
        if ($search) {

            //全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');

            //単語を半角スペースで区切り、配列にする
            ///[\s,]+/ → 「半角スペース」または「,」が一つ以上連続している
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            //単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $query->where('title', 'like', "%$value%")->get();
            }
        }

        if ($search_category_id) {
            //カテゴリIDに相当するカテゴリ名を取得する
            $search_category = Category::find($search_category_id)->category_name;
            //dd($search_category);

            $query->where('category', $search_category)->get();
        }

        if ($search_prefecture_id) {
            //prefecture IDに相当する都道府県名を取得する
            $search_prefecture = Prefecture::find($search_prefecture_id)->prefecture_name;
            //dd($search_prefecture);

            $query->where('address', $search_prefecture)->get();
        }

        if ($search_date) {
            $query->whereDate('start_date', '<=', $search_date)
                  ->whereDate('finish_date', '>=', $search_date)
                  ->get();
        }

        //上記で取得した$queryをページネートにし、変数$eventsに代入
        $events = $query->paginate(20);


        // ビューにusersとsearchを変数として渡す
        return view('search.index')
            ->with([
                'events' => $events,
                'categories' => $categories,
                'prefectures' => $prefectures,
            ]);
    }
}
