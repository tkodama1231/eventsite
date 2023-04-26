@section('content')
<form method="POST" action="{{ route('contact.confirm') }}">
    @csrf

    <label>メールアドレス</label>
    <input
        name="emal"
        value="{{ old('email') }}"
        type="text">
    @if ($errors->has('email'))
        <p class="error-message">{{ $errors->first('email') }}</p>
    @endif

    <label>お問い合わせ内容</label>
    <textarea name="body">{{ old('body') }}</textarea>
    @if ($errors->has('body'))
        <p class="error-message">{{ $errors->first('body') }}</p>
    @endif

    <button type="submit">入力内容確認</button>
</form>
@endsection


