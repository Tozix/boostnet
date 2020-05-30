<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id')->comment('ID Сервера');
            $table->string('domain')->index('domain')->comment('Имя домена')->nullable()->default("boostnet.ru");
            $table->string('ip')->index('ip')->comment('IP Адрес сервера')->nullable()->default("0.0.0.0");
            $table->string('city')->index('city')->comment('Гор. размещения сервера, на латинице')->nullable()->default("Tomsk");
            $table->smallInteger('num_users')->index('num_users')->comment('Количество юзеров на сервере')->default(0);
            $table->integer('speed')->index('speed')->comment('Общая ширина канала в битах')->default(0);
            $table->smallInteger('status')->index('status')->comment('Включен или нет сервер')->default(0);
            $table->text('description')->comment('Текстовое описание сервера')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
