<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasDigitalTable extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $table_name='uxui_berkas_jenis';
        $table=new Blueprint($table_name);
        $table->string('kode')->constrained();
        $table->string('prefix');
        $table->boolean('download_status');
        $table->unique(['prefix', 'kode']);
        $table->foreign('kode')->references('kode')->on('master_berkas_digital')->onUpdate('cascade')->onDelete('cascade');
        $table->boolean('type')->comment('1= berdasarkan nomor RM dan 2 berdasarkan nomor rawat');
        $this->set_table($table_name,$table);


        $table_name='uxui_berkas_digital';
        $table=new Blueprint($table_name);
        $table->increments('id');
        $table->string('url', 100);
        $table->string('name', 100);
        $table->string('id_jenis_bdig', 10);
        $table->string('no_rm', 30);
        $table->string('no_rw', 20);
        $table->string("kode", 20);
        $this->set_table($table_name,$table);


        $table_name='uxui_berkas_klaim';
        $table=new Blueprint($table_name);
        $table->increments('id');
        $table->string('nama', 100);
        $table->boolean('status');
        $table->unique(['nama']);
        $this->set_table($table_name,$table);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('uxui_berkas_jenis')) {
            Schema::dropIfExists('uxui_berkas_jenis');
        }

        if (Schema::hasTable('uxui_berkas_digital')) {
            Schema::dropIfExists('uxui_berkas_digital');
        }

        if (Schema::hasTable('uxui_berkas_klaim')) {
            Schema::dropIfExists('uxui_berkas_klaim');
        }
    }
}