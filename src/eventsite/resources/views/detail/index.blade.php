@extends('layouts.app')

@section('content')

    @csrf

    <div class="row mb-3">
        <label>カバー画像</label>

        <div class="col-md-6">

            @if(isset($event['image']))
                <div class="content-img">
                    <img src="{{ asset($event['image']) }}" alt="Image">
                </div>
            @else
                <p>No Image</p>
            @endif

        </div>
    </div>

    <div class="row mb-3">
        <label>イベント名称</label>

        <div class="col-md-6">
            {{ $event['title'] }}
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
        {{-- 開催方法がオフラインならば、開催場所と会場名(nullでない場合)を表示する --}}
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
        <label>イベントの説明</label>

        <div class="col-md-6">
            {!! nl2br(e($event['body'])) !!}
        </div>
    </div>

    <hr>

    <div class="row mb-3">
        <div class="col-md-6">
            @forelse ($tickets as $ticket)
            チケット名称：{{ $ticket->ticket_name }}
                <ul type=none>
                    <li>
                        料金：￥{{ $ticket->ticket_fee }}
                    </li>
                    <li>
                        残数：{{ $ticket->ticket_remain }}
                    </li>
                </ul>
            @empty
                <li>No tickets!</li>
            @endforelse
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

    {{-- ボタンがcertificationによって変化する実装をいれる --}}

    <div>
        <button>
            @if($certification === 'host')
                <a href="{{ route('detail.host', $event) }}">
                    イベントの詳細を確認
                </a>
            @elseif($certification === 'participant')
                <a href="{{ route('detail.cancel', $event) }}">
                    参加をキャンセルする
                </a>
            @else
                <a href="{{ route('apply.index', $event) }}">
                    申し込み
                </a>
            @endif
        </button>
    </div>


@endsection




