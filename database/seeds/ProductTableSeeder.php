<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        // создать 12 товаров
        factory(BoostNet\Models\Product::class, 12)->create();
    }
}
