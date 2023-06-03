@extends('layouts.app')

@section('content')

    @csrf

    <span style='font-weight:bold'>主催イベント</span>
    <a href="{{ route('member.participant') }}">参加イベント</a>


    <div >
        <div>
            <button>
                <a href="{{ route('publish.index') }}">イベントを投稿する</a>
            </button>
        </div>
        @forelse ($events as $event)
        <div class="search_card">
            <a class="Link" href="{{ route('detail.index', $event ) }}"></a>
            <ul>
                <li>
                    イベント名：{{ $event->title }}
                </li>
                <li>
                    開催日時：{{ $event->start_date }}
                </li>
                <li>
                    場所：{{ $event->address }}
                </li>
                <li>
                    説明：{{ $event->body }}
                </li>
            </ul>
        </div>
        @empty
        <div >
            <ul class="search_card">
                <li>No event</li>
            </ul>
        </div>
        @endforelse

    </div>

    <div>
        {{ $events->links() }}
    </div>

@endsection




