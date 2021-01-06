<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->index('user_id');
            $table->string('server_id')->index('server_id');
            $table->string('ipAddress');
            $table->string('public_key')->nullable()->comment('Публичный ключ в конфиге сервера');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_accounts');
    }
}
