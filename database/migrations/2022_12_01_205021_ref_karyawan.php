<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RefKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='ref_karyawan';
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) use($table_name) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->increments('id_karyawan');
                $table->string('nm_karyawan',50);
                $table->string('alamat',100);
                $table->string('nip',20);
                $table->smallInteger('id_jabatan');
                $table->smallInteger('id_departemen');
                $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->foreign(['id_jabatan'],$table_name.'_1')->references(['id_jabatan'])->on('ref_jabatan')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign(['id_departemen'],$table_name.'_2')->references(['id_departemen'])->on('ref_departemen')->onUpdate('cascade')->onDelete('cascade');
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
        $table_name='ref_karyawan';
        if (Schema::hasTable($table_name)) {
            Schema::dropIfExists($table_name);
        }
    }
}
