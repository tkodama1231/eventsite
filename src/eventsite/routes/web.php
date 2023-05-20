<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Practice_PostController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PublishController;

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
Route::get('/contact', [ContactsController::class, 'index'])->name('contact.index');
//確認フォームページ
Route::post('/contact/confirm', [ContactsController::class, 'confirm'])->name('contact.confirm');
//送信完了ページ
Route::post('/contact/thanks', [ContactsController::class, 'send'])->name('contact.send');

//検索機能のルーティング
//welcomeからの遷移
//検索機能のルーティング
Route::get('/search', [EventController::class, 'index'])->name('search.index');
//検索実行時
Route::get('/search/results', [EventController::class, 'search'])->name('search.results');

//イベント投稿のルーティング
//入力ページ
Route::get('/publish', [PublishController::class, 'index'])->name('publish.index');
//投稿の確認
Route::post('/publish/confirm', [PublishController::class, 'confirm'])->name('publish.confirm');
//送信完了ページ
Route::post('/publish/thanks', [PublishController::class, 'post'])->name('publish.post');





//dotinstall練習用
Route::get('/practice_index', [Practice_PostController::class, 'index'])
    ->name('posts.index');

Route::get('/practice_posts/{post}', [Practice_PostController::class, 'show'])
    ->name('posts.show')
    ->where('post', '[0-9]+');

Route::get('/practice_posts/practice_create', [Practice_PostController::class, 'create'])
    ->name('posts.create');

Route::post('/practice_posts/practice_store', [Practice_PostController::class, 'store'])
    ->name('posts.store');

Route::get('/practice_posts/{post}/edit', [Practice_PostController::class, 'edit'])
    ->name('posts.edit')
    ->where('post', '[0-9]+');

Route::patch('/practice_posts/{post}/update', [Practice_PostController::class, 'update'])
    ->name('posts.update')
    ->where('post', '[0-9]+');

Route::delete('/practice_posts/{post}/destroy', [Practice_PostController::class, 'destroy'])
    ->name('posts.destroy')
    ->where('post', '[0-9]+');



