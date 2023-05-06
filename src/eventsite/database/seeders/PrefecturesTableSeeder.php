<?php

namespace Database\Seeders;

use App\Models\Prefecture;
use Illuminate\Database\Seeder;

class PrefecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Prefecture::query()->delete();
        Prefecture::create([ 'prefecture_name' => '北海道' ]);
        Prefecture::create([ 'prefecture_name' => '青森県' ]);
        Prefecture::create([ 'prefecture_name' => '岩手県' ]);
        Prefecture::create([ 'prefecture_name' => '宮城県' ]);
        Prefecture::create([ 'prefecture_name' => '秋田県' ]);
        Prefecture::create([ 'prefecture_name' => '山形県' ]);
        Prefecture::create([ 'prefecture_name' => '福島県' ]);
        Prefecture::create([ 'prefecture_name' => '茨城県' ]);
        Prefecture::create([ 'prefecture_name' => '栃木県' ]);
        Prefecture::create([ 'prefecture_name' => '群馬県' ]);
        Prefecture::create([ 'prefecture_name' => '埼玉県' ]);
        Prefecture::create([ 'prefecture_name' => '千葉県' ]);
        Prefecture::create([ 'prefecture_name' => '東京都' ]);
        Prefecture::create([ 'prefecture_name' => '神奈川県' ]);
        Prefecture::create([ 'prefecture_name' => '新潟県' ]);
        Prefecture::create([ 'prefecture_name' => '富山県' ]);
        Prefecture::create([ 'prefecture_name' => '石川県' ]);
        Prefecture::create([ 'prefecture_name' => '福井県' ]);
        Prefecture::create([ 'prefecture_name' => '山梨県' ]);
        Prefecture::create([ 'prefecture_name' => '長野県' ]);
        Prefecture::create([ 'prefecture_name' => '岐阜県' ]);
        Prefecture::create([ 'prefecture_name' => '静岡県' ]);
        Prefecture::create([ 'prefecture_name' => '愛知県' ]);
        Prefecture::create([ 'prefecture_name' => '三重県' ]);
        Prefecture::create([ 'prefecture_name' => '滋賀県' ]);
        Prefecture::create([ 'prefecture_name' => '京都府' ]);
        Prefecture::create([ 'prefecture_name' => '大阪府' ]);
        Prefecture::create([ 'prefecture_name' => '兵庫県' ]);
        Prefecture::create([ 'prefecture_name' => '奈良県' ]);
        Prefecture::create([ 'prefecture_name' => '和歌山県' ]);
        Prefecture::create([ 'prefecture_name' => '鳥取県' ]);
        Prefecture::create([ 'prefecture_name' => '島根県' ]);
        Prefecture::create([ 'prefecture_name' => '岡山県' ]);
        Prefecture::create([ 'prefecture_name' => '広島県' ]);
        Prefecture::create([ 'prefecture_name' => '山口県' ]);
        Prefecture::create([ 'prefecture_name' => '徳島県' ]);
        Prefecture::create([ 'prefecture_name' => '香川県' ]);
        Prefecture::create([ 'prefecture_name' => '愛媛県' ]);
        Prefecture::create([ 'prefecture_name' => '高知県' ]);
        Prefecture::create([ 'prefecture_name' => '福岡県' ]);
        Prefecture::create([ 'prefecture_name' => '佐賀県' ]);
        Prefecture::create([ 'prefecture_name' => '長崎県' ]);
        Prefecture::create([ 'prefecture_name' => '熊本県' ]);
        Prefecture::create([ 'prefecture_name' => '大分県' ]);
        Prefecture::create([ 'prefecture_name' => '宮崎県' ]);
        Prefecture::create([ 'prefecture_name' => '鹿児島県' ]);
        Prefecture::create([ 'prefecture_name' => '沖縄県' ]);

    }
}
