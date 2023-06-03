@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('account.thanks') }}" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <label>ニックネーム</label>

        <div class="col-md-6">
            @if(isset($inputs['nickname']))
                {{ $inputs['nickname'] }}
                <input name="nickname" value="{{ $inputs['nickname'] }}" type="hidden">
            @else
                <p>変更なし</p>
            @endif
        </div>
    </div>


    <div class="row mb-3">
        <label>カバー画像</label>

        <div class="col-md-6">
            @if(isset($fileData))
                <img src="data:image/jpeg;base64,{{ base64_encode($fileData) }}" alt="Image">
                <input type="hidden" name="file_path" value="{{ $file_path }}">

            @else
                <p>変更なし</p>

            @endif

        </div>
    </div>

    <div class="row mb-3">
        <label>自己紹介</label>

        <div class="col-md-6">
            @if(isset($inputs['introduction']))
                {!! nl2br(e($inputs['introduction'])) !!}
                <input name="introduction" value="{{ $inputs['introduction'] }}" type="hidden">
            @else
                <p>変更なし</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>メールアドレス</label>

        <div class="col-md-6">
            @if(isset($inputs['email']))
                {{ $inputs['email'] }}
                <input name="email" value="{{ $inputs['email'] }}" type="hidden">
            @else
                <p>変更なし</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>パスワード</label>

        <div class="col-md-6">
            @if(session()->has('password'))
                {{ str_repeat('*', strlen(session('password'))) }}
            @else
                <p>変更なし</p>
            @endif
        </div>
    </div>


{{-- //送信ボタンをつくる。send controllerの仕上げ --}}

    <div class="col-md-8">
        <button type="submit" name="action" value="back">入力内容修正</button>
        <button type="submit" name="action" value="submit">確定</button>
    </div>

</form>





@endsection




