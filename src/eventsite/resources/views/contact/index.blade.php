@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('contact.confirm') }}">
    @csrf

    <div class="row mb-3">
        <label>メールアドレス</label>

        <div class="col-md-6">
            <input
                name="email"
                value="{{ old('email') }}"
                type="text">
            @if ($errors->has('email'))
                <p class="error-message">{{ $errors->first('email') }}</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>タイトル</label>

        <div class="col-md-6">
            <input
                name="title"
                value="{{ old('title') }}"
                type="text">
            @if ($errors->has('title'))
                <p class="error-message">{{ $errors->first('title') }}</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>お問い合わせ内容</label>

        <div class="col-md-6">
            <textarea name="body">{{ old('body') }}</textarea>
            @if ($errors->has('body'))
                <p class="error-message">{{ $errors->first('body') }}</p>
            @endif
        </div>
    </div>

    <div class="col-md-8">
        <button type="submit">入力内容確認</button>
    </div>

</form>
@endsection


