<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        // создать 4 категории
        factory(BoostNet\Models\Category::class, 4)->create();
    }
}
