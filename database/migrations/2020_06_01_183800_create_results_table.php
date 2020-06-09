<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->smallInteger('user_id')->index('user_id')->default(0);
            $table->smallInteger('server_id')->index('server_id')->default(0);
            $table->smallInteger('ping')->default(0);
            $table->smallInteger('jitter')->comment('Дрожание(Разброс стабильность коннекта)')->default(0);
            $table->integer('download')->comment('Скачать')->default(0);
            $table->integer('upload')->comment('Скорость скачки')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
