<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Practice_PostController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PublishController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AccountController;

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
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
//検索実行時
Route::get('/search/results', [SearchController::class, 'search'])->name('search.results');

//イベント投稿のルーティング
//入力ページ
Route::get('/publish', [PublishController::class, 'index'])->name('publish.index');
//投稿の確認
Route::post('/publish/confirm', [PublishController::class, 'confirm'])->name('publish.confirm');
//送信完了ページ
Route::post('/publish/thanks', [PublishController::class, 'post'])->name('publish.post');

//イベント詳細確認のルーティング
//詳細ページ表示
Route::get('/detail/index/{event}', [DetailController::class, 'index'])
    ->name('detail.index')
    ->where('event', '[0-9]+');
//主催者向け詳細ページ
Route::get('/detail/host/{event}', [DetailController::class, 'host'])
    ->name('detail.host')
    ->where('event', '[0-9]+');
//主催者向けイベント削除
Route::get('/detail/destroy/{event}', [DetailController::class, 'destroy'])
    ->name('detail.destroy')
    ->where('event', '[0-9]+');
//参加者向けイベントキャンセル
Route::get('/detail/cancel/{event}', [DetailController::class, 'cancel'])
    ->name('detail.cancel')
    ->where('event', '[0-9]+');

//イベント申し込みのルーティング
//申し込みページ表示
Route::get('/apply/index/{event}', [ApplyController::class, 'index'])
    ->name('apply.index')
    ->where('event', '[0-9]+');
//申込内容の確認
Route::post('/apply/confirm', [ApplyController::class, 'confirm'])
    ->name('apply.confirm');
//申し込み完了
Route::post('/apply/thanks', [ApplyController::class, 'thanks'])
    ->name('apply.thanks');

//会員画面のルーティング
//主催イベント一覧表示
Route::get('/member/host', [MemberController::class, 'host'])
    ->name('member.host');
//参加イベント一覧表示
Route::get('/member/participant', [MemberController::class, 'participant'])
    ->name('member.participant');


//アカウント設定機能として新しくグループをつくる
//アカウント設定ページ
Route::get('/account', [AccountController::class, 'index'])
    ->name('account.index');
//変更確認ページ
Route::post('/account/confirm', [AccountController::class, 'confirm'])
    ->name('account.confirm');
//変更確認ページ
Route::post('/account/thanks', [AccountController::class, 'thanks'])
    ->name('account.thanks');



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



