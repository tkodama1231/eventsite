@extends('layouts.app')

@section('content')


{{ __('イベントへの申し込みが完了しました。') }}

<div>
    <button>
        <a href="{{ route('detail.index', $event_id) }}">
            戻る
        </a>
    </button>
</div>



@endsection
