<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RefTemplateJadwalShiftWaktu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='ref_template_jadwal_shift_waktu';
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) use ($table_name) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->integer('id_template_jadwal_shift');
                $table->integer('id_jenis_jadwal');
                $table->text('tgl');

                $table->unique(['id_template_jadwal_shift','id_jenis_jadwal'],$table_name.'_uniq');
            });
        }

        $another_create_string=['id_template_jadwal_shift'=>10,'id_jenis_jadwal'=>10];
        foreach($another_create_string as $value => $length){
            if (Schema::hasColumn($table_name, $value)){
                DB::statement("ALTER TABLE ".$table_name." MODIFY ".$value." INT(".$length.")");
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
        $table_name='ref_template_jadwal_shift_waktu';
        if (Schema::hasTable($table_name)) {
            Schema::dropIfExists($table_name);
        }
    }
}
