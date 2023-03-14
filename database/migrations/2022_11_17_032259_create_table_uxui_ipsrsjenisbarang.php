<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUxuiIpsrsjenisbarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_ipsrsjenisbarang')) {
            Schema::create('uxui_ipsrsjenisbarang', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->char('kd_jenis', 5);
                $table->string('prefix', 50);
                $table->unique(['kd_jenis','prefix'],'uxui_ipsrsjenisbarang_uniq');
                $table->foreign('kd_jenis')->references('kd_jenis')->on('ipsrsjenisbarang')->onUpdate('cascade')->onDelete('cascade'); 
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
        if (Schema::hasTable('uxui_ipsrsjenisbarang')) {
            Schema::dropIfExists('uxui_ipsrsjenisbarang');
        }
    }
}
