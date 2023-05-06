<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::query()->delete();
        Category::create([ 'category_name' => 'A' ]);
        Category::create([ 'category_name' => 'B' ]);
        Category::create([ 'category_name' => 'C' ]);
        Category::create([ 'category_name' => 'D' ]);
    }
}
