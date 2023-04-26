<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//トップページへのルーティング
Route::get('/', function () {
    return view('welcome');
});

//認証機能(ログイン・会員登録)のルーティング
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//問い合わせ機能のルーティング
//入力フォームページ
Route::get('/contact', 'ContactsController@index')->name('contact.index');
//確認フォームページ
Route::post('/contact/confirm', 'ContactsController@confirm')->name('contact.confirm');
//送信完了ページ
Route::post('/contact/thanks', 'ContactsController@send')->name('contact.send');



//dotinstall練習用
Route::get('/practice_index', function () {
    $posts = [
        'Title A',
        'Title B',
        'Title C',
    ];

    return view('practice_index')
        ->with(['posts' => $posts]);
});

