<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class UpdateRefPerjalananKaryawan extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='ref_perjalanan_dinas';
        $table=new Blueprint($table_name);
        $params=['dropPrimary'=>['id_karyawan']];
        $this->update_table($table_name,$table,$params);

        $primary_key='id_spd';
        $table=new Blueprint($table_name);
        $table->bigIncrements($primary_key)->first();
        $this->update_table($table_name,$table);

        DB::statement("ALTER TABLE ".$table_name." MODIFY ".$primary_key." INT(10) NOT NULL AUTO_INCREMENT");
        DB::statement("ALTER TABLE ".$table_name." ADD uraian varchar(100) NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
