@extends('layouts.app')

@section('content')

@php
// dd($event);
@endphp

<form method="POST" action="{{ route('apply.confirm') }}">
    @csrf

    <div class="row mb-3">
        <label>イベント名称</label>

        <div class="col-md-6">
            {{ $event['title'] }}
        </div>
    </div>

    <div class="row mb-3">
        <label>イベントの説明</label>

        <div class="col-md-6">
            {!! nl2br(e($event['body'])) !!}
        </div>
    </div>

    <div class="row mb-3">
        <label>開催日時</label>

        <div class="col-md-6">
            @if(isset($event['finish_date']))
                <label>開始日時　終了日時</label>
                <div>
                    {{ $event['start_date'] }}
                    {{ $event['finish_date'] }}
                </div>
            @else
                <label>開始日時</label>
                <div>
                    {{ $event['start_date'] }}
                </div>
            @endif

        </div>
    </div>

    <div class="row mb-3">
        <label>開催方法</label>
        <div>
            {{ $event['situation'] }}
        </div>
        @if($event['situation']==='オフライン')
            <label>開催場所</label>
            <div>
                {{ $event['address'] }}
            </div>
            @if(isset($event['venue']))
                <label>会場</label>
                <div>
                    {{ $event['venue'] }}
                </div>
            @endif
        @endif
    </div>

    <div class="row mb-3">
        <label>チケット選択</label>

        <div class="col-md-6">
            @forelse ($tickets as $ticket)
                <input type="radio" name="ticket_id" value="{{ $ticket->id }}" @if($ticket->ticket_remain === 0) disabled @endif>
                　{{ $ticket->ticket_name }}
                ￥{{ $ticket->ticket_fee }}
                @if($ticket->ticket_remain === 0) 　売り切れ @endif
                <br>
            @empty
                <li>No tickets!</li>
            @endforelse

        </div>
    </div>

    <div class="row mb-3">
        <label>決済手段</label>

        <div class="col-md-6">
            <input type="radio" name="payment" value="現金" >　現金<br>
            <input type="radio" name="payment" value="クレジットカード" disabled>　クレジットカード
        </div>
    </div>

    <input name="event_id" value="{{ $event->id }}" type="hidden">

    <div class="col-md-8">
        <button type="submit">申し込む</button>
    </div>

</form>

@endsection




