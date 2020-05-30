<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgpropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orgprops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable()->index('user_id')->comment('ID Юзера в таблице Юзерс');
            $table->string('org_tel')->nullable()->index('org_tel')->comment('Телефон организации');
            $table->string('org_email')->nullable()->index('org_email')->comment('Почта организации');
            $table->string('org_name')->nullable()->index('org_name')->comment('Имя организации');
            $table->string('org_inn')->nullable()->index('org_inn')->comment('ИНН организации');
            $table->string('org_kpp')->nullable()->index('org_kpp')->comment('КПП организации');
            $table->string('org_bik')->nullable()->index('org_bik')->comment('Бик Банка');
            $table->string('org_rschet')->nullable()->index('org_rschet')->comment('Расчетный счет');
            $table->string('org_korschet')->nullable()->index('org_korschet')->comment('Кор счет');
            $table->string('org_bank')->nullable()->index('org_bank')->comment('Наименование банка');
            $table->string('org_dir_fio')->nullable()->index('org_dir_fio')->comment('ФИО руководителя');
            $table->string('org_dir_dol')->nullable()->index('org_dir_dol')->comment('Должность руководителя');
            $table->string('address_ur')->nullable()->index('address_ur')->comment('Юридический адрес');
            $table->string('address_fact')->nullable()->index('address_fact')->comment('Фактический или Почтовый адрес');
            $table->mediumText('org_contacts')->nullable()->comment('Контактное лицо и другие данные для связи');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orgprops');
    }
}
