@extends('layouts.app')

@section('content')

@php
    // dd($inputs);
@endphp

<form method="POST" action="{{ route('apply.thanks') }}">
    @csrf

    <div class="row mb-3">
        <label>イベント名称</label>

        <div class="col-md-6">
            {{ $event[0]->title }}
        </div>
    </div>

    <div class="row mb-3">
        <label>イベントの説明</label>

        <div class="col-md-6">
            {!! nl2br(e($event[0]->body)) !!}
        </div>
    </div>

    <div class="row mb-3">
        <label>開催日時</label>

        <div class="col-md-6">
            @if(isset($event[0]->finish_date))
                <label>開始日時　終了日時</label>
                <div>
                    {{ $event[0]->start_date }}
                    {{ $event[0]->finish_date }}
                </div>
            @else
                <label>開始日時</label>
                <div>
                    {{ $event[0]->start_date }}
                </div>
            @endif

        </div>
    </div>

    <div class="row mb-3">
        <label>開催方法</label>
        <div>
            {{ $event[0]->situation }}
        </div>
        @if($event[0]->situation==='オフライン')
            <label>開催場所</label>
            <div>
                {{ $event[0]->address }}
            </div>
            @if(isset($event[0]->venue))
                <label>会場</label>
                <div>
                    {{ $event[0]->venue }}
                </div>
            @endif
        @endif
    </div>

    <div class="row mb-3">
        <label>購入チケット</label>

        <div class="col-md-6">
            {{ $ticket[0]->ticket_name }}<br>
            ￥{{ $ticket[0]->ticket_fee }}
        </div>
    </div>

    <div class="row mb-3">
        <label>決済手段</label>

        <div class="col-md-6">
            {{ $inputs['payment'] }}
        </div>
        <input name="payment" value="{{ $inputs['payment'] }}" type="hidden">
    </div>

    <input name="event_id" value="{{ $event[0]->id }}" type="hidden">
    <input name="ticket_id" value="{{ $ticket[0]->id }}" type="hidden">

    <div class="col-md-8">
        <button type="submit">確定する</button>
    </div>



</form>


@endsection


{{-- ビューを作った後で
participantsテーブルに
決済のカラムを追加する
thanksコントローラの作成 --}}
