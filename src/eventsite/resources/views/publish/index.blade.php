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
                <input type="date" name="start_date" value="@if (isset($search)) {{ $search }} @endif">
                @if ($errors->has('start_date'))
                    <p class="error-message">{{ $errors->first('start_date') }}</p>
                @endif

                <input type="date" name="finish_date" value="@if (isset($search)) {{ $search }} @endif">
                @if ($errors->has('finish_date'))
                    <p class="error-message">{{ $errors->first('finish_date') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label>開催方法</label>
        <div class="col-md-6">
            <input type="radio" name="situation" value="offline"> オフライン
            <input type="radio" name="situation" value="online" checked> オンライン
        </div>
        <label>開催場所</label>
        <div class="col-md-6">
            <select type="search" name="address">
                <option value="" hidden>▼選択してください</option>
                @foreach ($prefectures as $prefecture)
                    <option value="{{ $prefecture->prefecture_name }}">{{ $prefecture->prefecture_name }}</option>
                @endforeach
            </select>
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
                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
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

            <!-- 入力ボックスを追加するボタン ② -->
            <button type="button" @click="addInput">追加する</button>

        </div>

        <div class="col-md-8">
            <button type="submit">公開する</button>
        </div>


    </div>

    <script>

        new Vue({
            el: '#ticket_box',
            data: {
                tickets_name: [""], // 複数入力のデータ（配列）
                tickets_fee: [""], // 複数入力のデータ（配列）
                tickets_amount: [""], // 複数入力のデータ（配列）
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
                    tickets: this.tickets
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



</form>



@endsection


