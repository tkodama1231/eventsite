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

    {{-- <div class="row mb-3">
        <label>地図</label>

        <div class="col-md-6">
            JSを使ってgooglemapAPIに接続
            いったん後回し
        </div>
    </div> --}}

    <hr>

    <div class="row mb-3">
        <div class="col-md-6">
            <table border="2">
                <tr>
                    <th>　参加者名　</th>
                    <th>　チケット名　</th>
                    <th>　料金　</th>
                    <th>　支払い　</th>
                </tr>
                @forelse ($participants_detail as $participant)
                    <tr align="center">
                        <td>{{ $participant->nickname }}</td>
                        <td>{{ $participant->ticket_name }}</td>
                        <td>{{ $participant->ticket_fee }}</td>
                        <td>{{ $participant->payment }}</td>
                    </tr>
                @empty
                    <li>No tickets!</li>
                @endforelse
            </table>
        </div>
    </div>

    <div>
        <button>
            <a href="{{ route('detail.destroy', $event) }}">
                イベントを削除する
            </a>
        </button>
    </div>




@endsection




