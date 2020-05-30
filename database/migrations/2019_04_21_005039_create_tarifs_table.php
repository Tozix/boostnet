<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('name')->index('name')->comment('Название тарифа');
            $table->integer('cost')->index('cost')->comment('Стоимость');
            $table->smallInteger('type')->index('type')->comment('Тип тарифа: Юр лицо, Физ лицо, Интернет и т.д.');
            $table->smallInteger('status')->index('status')->comment('Включен, выключен, новый, акционный');
            $table->integer('speed')->index('speed')->comment('скорость по тарифу');
            $table->text('description')->comment('Текстовое описание тарифа');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarifs');
    }
}
