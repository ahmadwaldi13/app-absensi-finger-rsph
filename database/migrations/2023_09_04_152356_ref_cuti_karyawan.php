<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefCutiKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='ref_cuti_karyawan';
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) use ($table_name) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->integer('id_karyawan')->length(10)->unsigned();
                $table->date('tgl_mulai');
                $table->date('tgl_selesai');
                $table->string('uraian');
                $table->smallInteger('jumlah');

                $table->unique(['id_karyawan','tgl_mulai','tgl_selesai'],$table_name.'_uniq');
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
        $table_name='ref_cuti_karyawan';
        if (Schema::hasTable($table_name)) {
            Schema::dropIfExists($table_name);
        }
    }
}
