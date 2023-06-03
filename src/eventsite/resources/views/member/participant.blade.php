@extends('layouts.app')

@section('content')

    @csrf



    <a href="{{ route('member.host') }}">主催イベント</a>
    <span style="font-weight:bold">参加イベント</span>


    <div >

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




