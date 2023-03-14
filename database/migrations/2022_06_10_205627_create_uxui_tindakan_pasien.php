<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUxuiTindakanPasien extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='uxui_tindakan_pasien';
        $table=new Blueprint($table_name);
        $table->string('no_rawat',17);
        $table->string('no_rkm_medis',15);
        $table->string('type_akses',5);
        $table->smallInteger('pemeriksaan')->nullable(true)->default(0);
        $table->smallInteger('permintaan_lab')->nullable(true)->default(0);
        $table->smallInteger('resep')->nullable(true)->default(0);
        $table->smallInteger('resume')->nullable(true)->default(0);
        $table->unique(['no_rawat','no_rkm_medis','type_akses'],'uxui_tindakan_pasien_uniq');
        $this->set_table($table_name,$table);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('uxui_tindakan_pasien')) {
            Schema::dropIfExists('uxui_tindakan_pasien');
        }
    }
}
