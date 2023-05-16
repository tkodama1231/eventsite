@extends('layouts.app')

@section('content')
<div id="app">

    <!-- 入力ボックスを表示する場所 ① -->

    <div v-for="(text,index) in texts">

        <!-- 各入力ボックス -->
        <input type="text" v-model="texts[index]">

        <!-- 入力ボックスの削除ボタン -->
        <button type="button" @click="removeInput(index)">削除</button>

    </div>

    <!-- 入力ボックスを追加するボタン ② -->
    <button type="button" @click="addInput">追加する</button>

    <!-- 入力されたデータを送信するボタン ③ -->

    <!-- 確認用 -->
    <hr>
    <label>textsの中身</label>
    <div v-text="texts"></div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script>

    new Vue({
        el: '#app',
        data: {
            texts: [], // 複数入力のデータ（配列）
        },
        methods: {

            // ボタンをクリックしたときのイベント ①〜③
            // ボタンをクリックしたときのイベント ③
            removeInput(index) {

                this.texts.splice(index, 1); //

            },

            addInput() {

                this.texts.push(''); // 配列に１つ空データを追加する

            },

// 省略

}
    });

</script>


</div>
@endsection
