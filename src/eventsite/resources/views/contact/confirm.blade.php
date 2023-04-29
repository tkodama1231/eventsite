@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('contact.send') }}">
    @csrf

    <div class="row mb-3">
        <label>メールアドレス</label>

        <div class="col-md-6">
            {{ $inputs['email'] }}
            <input name="email" value="{{ $inputs['email'] }}" type="hidden">
        </div>
    </div>

    <div class="row mb-3">
        <label>タイトル</label>

        <div class="col-md-6">
            {{ $inputs['title'] }}
            <input name="title" value="{{ $inputs['title'] }}" type="hidden">
        </div>
    </div>

    <div class="row mb-3">
        <label>お問い合わせ内容</label>

        <div class="col-md-6">
            {!! nl2br(e($inputs['body'])) !!}
            <input name="body" value="{{ $inputs['body'] }}" type="hidden">
        </div>
    </div>

    <div class="col-md-8">
        <button type="submit" name="action" value="back">入力内容修正</button>
        <button type="submit" name="action" value="submit">送信する</button>
    </div>

</form>
@endsection
