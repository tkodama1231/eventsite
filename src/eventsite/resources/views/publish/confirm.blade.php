@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('publish.post') }}" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <label>イベント名称</label>

        <div class="col-md-6">
            {{ $inputs['title'] }}
            <input name="title" value="{{ $inputs['title'] }}" type="hidden">
        </div>
    </div>


    <div class="row mb-3">
        <label>カバー画像</label>

        <div class="col-md-6">
            @if(isset($fileData))
                <img src="data:image/jpeg;base64,{{ base64_encode($fileData) }}" alt="Image">
                <input type="hidden" name="file_path" value="{{ $file_path }}">

            @else
                <p>なし</p>

            @endif

        </div>
    </div>

    <div class="row mb-3">
        <label>イベントの説明</label>

        <div class="col-md-6">
            {!! nl2br(e($inputs['body'])) !!}
            <input name="body" value="{{ $inputs['body'] }}" type="hidden">
        </div>
    </div>


    <div class="row mb-3">
        <label>開催日時</label>

        <div class="col-md-6">
            <label>開始日時　終了日時</label>
            <div>
                {{ $inputs['start_date'] }}
                <input name="start_date" value="{{ $inputs['start_date'] }}" type="hidden">

                {{ $inputs['finish_date'] }}
                <input name="finish_date" value="{{ $inputs['finish_date'] }}" type="hidden">
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label>開催方法</label>
        <div class="col-md-6">
            {{ $inputs['situation'] }}
            <input name="situation" value="{{ $inputs['situation'] }}" type="hidden">
        </div>
        <label>開催場所</label>
        <div class="col-md-6">
            {{ $inputs['address'] }}
            <input name="address" value="{{ $inputs['address'] }}" type="hidden">
        </div>
        <label>会場名</label>
        <div class="col-md-6">
            {{ $inputs['venue'] }}
            <input name="venue" value="{{ $inputs['venue'] }}" type="hidden">
        </div>
    </div>

    <div class="row mb-3">
        <label>カテゴリ</label>

        <div class="col-md-6">
            {{ $inputs['category'] }}
            <input name="category" value="{{ $inputs['category'] }}" type="hidden">
        </div>
    </div>

    <div class="row mb-3">
        <label>料金</label>
        <label>チケット種別　金額　販売予定数</label>

        <div class="col-md-6">
            @forelse ($inputs['tickets_name'] as $i=>$ticket_name)
                <li>
                    {{ $ticket_name }}
                    {{ $inputs["tickets_fee"][$i] }}
                    {{ $inputs["tickets_amount"][$i] }}
                </li>
                <input name="tickets_name[]" value="{{ $inputs['tickets_name'][$i] }}" type="hidden">
                <input name="tickets_fee[]" value="{{ $inputs['tickets_fee'][$i] }}" type="hidden">
                <input name="tickets_amount[]" value="{{ $inputs['tickets_amount'][$i] }}" type="hidden">
            @empty
                <li>No tickets!</li>
            @endforelse

        </div>
    </div>


{{-- //送信ボタンをつくる。send controllerの仕上げ --}}

    <div class="col-md-8">
        <button type="submit" name="action" value="back">入力内容修正</button>
        <button type="submit" name="action" value="submit">確定</button>
    </div>

</form>
@endsection
