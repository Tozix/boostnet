<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('user_id')->index('user_id')->comment('ID юзера, для кого отчет');
            $table->smallInteger('type')->index('type')->comment('Тип отчета');
            $table->string('title')->comment('Заголовок отчета');
            $table->text('description')->comment('Текс отчета');
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
        Schema::dropIfExists('reports');
    }
}
