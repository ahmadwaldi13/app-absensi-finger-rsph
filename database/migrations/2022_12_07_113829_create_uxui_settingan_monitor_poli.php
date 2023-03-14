<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUxuiSettinganMonitorPoli extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='uxui_settingan_monitor_poli';
        $table=new Blueprint($table_name);
        $table->string('kode_setting',15);
        $table->string('kode_template',20);
        $table->string('link_video',255)->nullable(true);
        $table->string('item_poli',255);
        
        $table->unique(['kode_setting'],'uxui_smpoli_uniq');
        $this->set_table($table_name,$table);

        if (!Schema::hasTable('uxui_list_panggil_monitor_poli')) {
            Schema::create('uxui_list_panggil_monitor_poli', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->string('no_rawat', 17)->nullable(true)->primary();
                $table->string('no_reg', 8)->nullable(true);
                $table->string('nm_pasien', 40)->nullable(true);
                $table->string('poli', 20)->nullable(true);
                $table->date('tanggal')->nullable(true);
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
        if (Schema::hasTable('uxui_settingan_monitor_poli')) {
            Schema::dropIfExists('uxui_settingan_monitor_poli');
        }
        if (Schema::hasTable('uxui_list_panggil_monitor_poli')) {
            Schema::dropIfExists('uxui_list_panggil_monitor_poli');
        }
    }
}
