<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUxuiKonterFarmasi extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='uxui_konter_farmasi';
        $table=new Blueprint($table_name);
        $table->charset = 'latin1';
        $table->collation = 'latin1_swedish_ci';
        $table->increments('id');
        $table->string('konter_no', 20);
        $table->string('kode_konter', 20);
        $this->set_table($table_name,$table);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('uxui_konter_farmasi')) {
            Schema::dropIfExists('uxui_konter_farmasi');
        }
    }
}
