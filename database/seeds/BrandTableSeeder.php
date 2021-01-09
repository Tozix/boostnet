<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    public function run()
    {
        // создать 4 бренда
        factory(BoostNet\Brand::class, 4)->create();
    }
}
