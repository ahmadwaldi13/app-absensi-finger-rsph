<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateResumePasien extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='resume_pasien_ranap';
        $table=new Blueprint($table_name);
        $params=['dropForeign'=>['no_rawat'],'dropPrimary'=>['no_rawat']];
        $this->update_table($table_name,$table,$params);

        $table=new Blueprint($table_name);
        $table->bigIncrements('id_resume_ranap')->first();
        $table->foreign(['no_rawat'],$table_name.'_fk1')->references('no_rawat')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade'); 
        $this->update_table($table_name,$table);

        DB::statement("ALTER TABLE ".$table_name." MODIFY id_resume_ranap bigInt(255) NOT NULL AUTO_INCREMENT");



        // $table_name='resume_pasien';
        // $table=new Blueprint($table_name);
        // $params=['dropForeign'=>['no_rawat'],'dropPrimary'=>['no_rawat']];
        // $this->update_table($table_name,$table,$params);

        // $table=new Blueprint($table_name);
        // $table->bigIncrements('id_resume')->first();
        // $table->foreign(['no_rawat'],$table_name.'_fk1')->references('no_rawat')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade'); 
        // $this->update_table($table_name,$table);

        // DB::statement("ALTER TABLE ".$table_name." MODIFY id_resume bigInt(255) NOT NULL AUTO_INCREMENT");
    }
}