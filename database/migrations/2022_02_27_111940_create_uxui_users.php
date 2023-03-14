<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUxuiUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_users')) {
            Schema::create('uxui_users', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->string('id',700);
                $table->string('id_user',700);
                $table->string('name',100);
                $table->string('type_user',30);
                $table->rememberToken();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('uxui_users')) {
            Schema::dropIfExists('uxui_users');
        }
    }
}
