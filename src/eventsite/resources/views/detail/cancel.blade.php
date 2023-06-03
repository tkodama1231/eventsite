@extends('layouts.app')

@section('content')

    @csrf

    <div class="row mb-3">
        <p>イベントをキャンセルしました</p>

    </div>

    <hr>

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


@endsection




