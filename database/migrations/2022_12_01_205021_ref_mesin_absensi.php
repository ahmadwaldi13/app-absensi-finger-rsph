<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RefMesinAbsensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='ref_mesin_absensi';
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->increments('id_mesin_absensi');
                $table->string('ip_address')->unique();
                $table->integer('comm_key');
                $table->string('nm_mesin');
                $table->string('lokasi_mesin');
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
        $table_name='ref_mesin_absensi';
        if (Schema::hasTable($table_name)) {
            Schema::dropIfExists($table_name);
        }
    }
}
