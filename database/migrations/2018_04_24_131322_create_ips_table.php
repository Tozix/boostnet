<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable()->index('user_id')->comment('ID Юзера');
            $table->string('user_name')->nullable()->index('user_name')->comment('Логин Юзера');
            $table->ipAddress('ip_openvpn')->unique('ip_openvpn');
            $table->ipAddress('ip_ppp')->unique('ip_ppp');
            $table->integer('speed')->default(0);
            $table->string('server')->default('boostnet.ru');
            $table->tinyInteger('active')->default(0);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ips');
    }
}
