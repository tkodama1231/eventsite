@extends('layouts.app')

@section('content')

    @csrf

    <form method="GET" action="{{ route('search.results') }}">
        <label>
            <input type="search" placeholder="キーワード" name="keyword" value="@if (isset($search)) {{ $search }} @endif">
        </label>
        <label>
            <select type="search" name="category">
                <option value="" hidden>カテゴリ</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </label>
        <label>
            <select type="search" name="prefecture">
                <option value="" hidden>場所</option>
                @foreach ($prefectures as $prefecture)
                    <option value="{{ $prefecture->id }}">{{ $prefecture->prefecture_name }}</option>
                @endforeach
            </select>
        </label>
        <label>
            <input type="date" name="date" value="@if (isset($search)) {{ $search }} @endif">
        </label>


        <div>
            <button type="submit">検索</button>
            <button>
                <a href="{{ route('search.results') }}">
                    クリア
                </a>
            </button>
        </div>
    </form>

    <div class="row mb-3">

        @forelse ($events as $event)
        <div >
            <ul class="search_card">
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




