@extends('layouts.app')

@section('content')

{{ __('アカウント設定を変更しました') }}


<div>
    <button>
        <a href="{{ route('member.host') }}">
            戻る
        </a>
    </button>
</div>



@endsection




