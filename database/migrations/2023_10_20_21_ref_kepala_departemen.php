<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefKepalaDepartemen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='ref_kepala_departemen';
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) use ($table_name) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->integer('id_karyawan')->length(10)->unsigned();
                $table->integer('departemen')->length(10)->unsigned();
                
                $table->unique(['id_karyawan','departemen'],$table_name.'_uniq');
                // $table->foreign(['id_karyawan'],$table_name.'_fk1')->references(['id_karyawan'])->on('ref_karyawan')->onUpdate('cascade')->onDelete('cascade');
                // $table->foreign(['departemen'],$table_name.'_fk2')->references(['id_departemen'])->on('ref_departemen')->onUpdate('cascade')->onDelete('cascade'); 
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
        $table_name='ref_kepala_departemen';
        if (Schema::hasTable($table_name)) {
            Schema::dropIfExists($table_name);
        }
    }
}
