<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RefJenisJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='ref_jenis_jadwal';
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) use ($table_name) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->increments('id_jenis_jadwal');
                $table->string('nm_jenis_jadwal');
                $table->time('masuk_kerja');
                $table->time('pulang_kerja');
                $table->time('awal_istirahat');
                $table->time('akhir_istirahat');
            });
        }

        $another_create_time=['masuk_kerja','pulang_kerja','awal_istirahat','akhir_istirahat'];
        foreach($another_create_time as $value){
            if (!Schema::hasColumn($table_name, $value)){
                Schema::table($table_name, function (Blueprint $table) use ($value){
                    $table->time($value);
                });
            }
        }
        $another_create_string=['hari_kerja'=>50];
        foreach($another_create_string as $value => $length){
            if (!Schema::hasColumn($table_name, $value)){
                Schema::table($table_name, function (Blueprint $table) use ($value,$length){
                    $table->string($value,$length);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table_name='ref_jenis_jadwal';
        if (Schema::hasTable($table_name)) {
            Schema::dropIfExists($table_name);
        }
    }
}
