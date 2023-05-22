@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('publish.confirm') }}" enctype="multipart/form-data" @submit.prevent="onSubmit">
    @csrf

    <div class="row mb-3">
        <label>イベント名称</label>

        <div class="col-md-6">
            <input
                name="title"
                value="{{ old('title') }}"
                type="text">
            @if ($errors->has('title'))
                <p class="error-message">{{ $errors->first('title') }}</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>カバー画像</label>
        <div class="col-md-6">
            <input type="file" name="image">
        </div>
    </div>

    <div class="row mb-3">
        <label>イベントの説明</label>

        <div class="col-md-6">
            <textarea name="body">{{ old('body') }}</textarea>
            @if ($errors->has('body'))
                <p class="error-message">{{ $errors->first('body') }}</p>
            @endif
        </div>
    </div>


    <div class="row mb-3">
        <label>開催日時</label>

        <div class="col-md-6">
            <div>
                <label>開始日時　終了日時</label>
            </div>
            <div>
                <input type="date" name="start_date" value="{{ old('start_date') }}">
                @if ($errors->has('start_date'))
                    <p class="error-message">{{ $errors->first('start_date') }}</p>
                @endif

                <input type="date" name="finish_date" value="{{ old('finish_date') }}">
                @if ($errors->has('finish_date'))
                    <p class="error-message">{{ $errors->first('finish_date') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label>開催方法</label>
        <div class="col-md-6">
            <input type="radio" name="situation" value="オフライン" @if("オフライン" === old('situation')) checked @endif> オフライン
            <input type="radio" name="situation" value="オンライン" @if("オンライン" === old('situation')) checked @endif> オンライン
            @if ($errors->has('situation'))
                <p class="error-message">{{ $errors->first('situation') }}</p>
            @endif
        </div>
        <label>開催場所</label>
        <div class="col-md-6">
            <select name="address">
                <option value="" hidden>▼選択してください</option>
                @foreach ($prefectures as $prefecture)
                    <option value="{{ $prefecture->prefecture_name }}" @if("$prefecture->prefecture_name" === old('address')) selected @endif>{{ $prefecture->prefecture_name }}</option>
                @endforeach
            </select>
            @if ($errors->has('address'))
                <p class="error-message">{{ $errors->first('address') }}</p>
            @endif
        </div>
        <label>会場名</label>
        <div class="col-md-6">
            <input
                name="venue"
                value="{{ old('venue') }}"
                type="text">
            @if ($errors->has('venue'))
                <p class="error-message">{{ $errors->first('venue') }}</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>カテゴリ</label>
        <div class="col-md-6">
            <select type="search" name="category">
                <option value="" hidden>▼選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_name }}" @if("$category->category_name" === old('category')) selected @endif>{{ $category->category_name }}</option>
                @endforeach
            </select>
            @if ($errors->has('category'))
                <p class="error-message">{{ $errors->first('category') }}</p>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label>料金</label>
        <div>
            <label>チケット種別　金額　販売予定数</label>
        </div>
        <div id="ticket_box">

            <!-- 入力ボックスを表示する場所 ① -->
            <div v-for="(ticket,index) in tickets_name">
                <!-- 各入力ボックス -->
                <input type="text" name="tickets_name[]" v-model="tickets_name[index]">
                <input type="text" name="tickets_fee[]" v-model="tickets_fee[index]">
                <input type="text" name="tickets_amount[]" v-model="tickets_amount[index]">

                <!-- 入力ボックスの削除ボタン -->
                <button type="button" @click="removeInput(index)">削除</button>

            </div>
            @if ($errors->has('tickets_name'))
                    <p class="error-message">{{ $errors->first('tickets_name') }}</p>
                @endif
                @if ($errors->has('tickets_name.*'))
                    <p class="error-message">{{ $errors->first('tickets_name.*') }}</p>
                @endif
                @if ($errors->has('tickets_fee.*'))
                    <p class="error-message">{{ $errors->first('tickets_fee.*') }}</p>
                @endif
                @if ($errors->has('tickets_amount.*'))
                    <p class="error-message">{{ $errors->first('tickets_amount.*') }}</p>
                @endif

            <!-- 入力ボックスを追加するボタン ② -->
            <button type="button" @click="addInput">追加する</button>



        </div>

        <div class="col-md-8">
            <button type="submit">公開する</button>
        </div>

        <hr>
        <label>textsの中身</label>
        <div v-text="tickets_name"></div>


    </div>





</form>

@php

$session_data = session('_old_input');

$tickets_name = $session_data['tickets_name'] ?? [''];
$tickets_fee = $session_data['tickets_fee'] ?? [''];
$tickets_amount = $session_data['tickets_amount'] ?? [''];

$tickets_name = json_encode($tickets_name);
$tickets_fee = json_encode($tickets_fee);
$tickets_amount = json_encode($tickets_amount);

@endphp

<script>

   new Vue({
       el: '#ticket_box',
       data: {
            tickets_name: {!! $tickets_name !!},
            tickets_fee: {!! $tickets_fee !!},
            tickets_amount: {!! $tickets_amount !!},
       },
       methods: {

           // ボタンをクリックしたときのイベント ①〜③
           // ボタンをクリックしたときのイベント ③
           removeInput(index) {
               this.tickets_name.splice(index, 1);
               this.tickets_fee.splice(index, 1);
               this.tickets_amount.splice(index, 1);
           },

           // ボタンをクリックしたときのイベント ③
           addInput() {

               this.tickets_name.push(''); // 配列に１つ空データを追加する
               this.tickets_fee.push(''); // 配列に１つ空データを追加する
               this.tickets_amount.push(''); // 配列に１つ空データを追加する

           },

           onSubmit() {

           const url = '/publish/index';
           const params = {
                tickets_name: this.tickets_name,
                tickets_fee: this.tickets_fee,
                tickets_amount: this.tickets_amount
           };
           axios.post(url, params)
               .then(response => {

                   // 成功した時


               })
               .catch(error => {

                   // 失敗した時


               });

           }

// 省略
       }
   });

</script>



@endsection


