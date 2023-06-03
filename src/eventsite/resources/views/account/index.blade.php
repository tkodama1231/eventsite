@extends('layouts.app')

@section('content')

@if(session('warning'))
    <div class="alert alert-danger">
        {{ session('warning') }}
    </div>
@endif

<form method="POST" action="{{ route('account.confirm') }}" enctype="multipart/form-data" @submit.prevent="onSubmit">
    @csrf

    <div class="row mb-3">
        <label>ニックネーム</label>

        <div class="col-md-6">
            <input
                name="nickname"
                value="{{ old('nickname') }}"
                type="text">
            @if ($errors->has('nickname'))
                <p class="error-message">{{ $errors->first('nickname') }}</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>プロフィール画像</label>
        <div class="col-md-6">
            <input type="file" name="image">
        </div>
    </div>

    <div class="row mb-3">
        <label>自己紹介</label>

        <div class="col-md-6">
            <textarea name="introduction">{{ old('introduction') }}</textarea>
            @if ($errors->has('introduction'))
                <p class="error-message">{{ $errors->first('introduction') }}</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>メールアドレス</label>

        <div class="col-md-6">
            <input
                name="email"
                value="{{ old('email') }}"
                type="email">
            @if ($errors->has('email'))
                <p class="error-message">{{ $errors->first('email') }}</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>パスワード</label>

        <div>
            <div class="col-md-6">
                <label>現在のパスワード</label><br>
                <input
                    name="current_password"
                    value=""
                    type="password"
                    id="current_password">
                @if ($errors->has('current_password'))
                    <p class="error-message">{{ $errors->first('current_password') }}</p>
                @endif
            </div>

            <div class="col-md-6">
                <label>新しいパスワード</label><br>
                <input
                    name="password"
                    value=""
                    type="password"
                    id="new_password"
                    disabled>
                @if ($errors->has('password'))
                    <p class="error-message">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="col-md-6">
                <label>パスワードの確認</label><br>
                <input
                    name="password_confirmation"
                    value=""
                    type="password"
                    id="new_password_confirmation"
                    disabled>
                @if ($errors->has('password_confirmation'))
                    <p class="error-message">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <button type="submit">設定する</button>
    </div>


</form>

<script>
    const current_password = document.getElementById('current_password');
    const new_password = document.getElementById('new_password');
    const new_password_confirmation = document.getElementById('new_password_confirmation');



    current_password.addEventListener('input', function() {
        // 入力項目が空でない場合、アクティブにする
        if (current_password.value !== '') {
            new_password.disabled = false;
            new_password_confirmation.disabled = false;
        } else {
            new_password.disabled = true;
            new_password_confirmation.disabled = true;
        }
    });
</script>

@endsection




