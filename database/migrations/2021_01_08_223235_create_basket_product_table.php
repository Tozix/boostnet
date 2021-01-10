<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('basket_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedTinyInteger('quantity');


            $table->foreign('basket_id')
            ->references('id')
            ->on('baskets')
            ->OnDelete('cascade');
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->OnDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('basket_product');
    }
}
