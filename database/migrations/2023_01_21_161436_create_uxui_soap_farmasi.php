<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUxuiSoapFarmasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_soap_farmasi')) {
            Schema::create('uxui_soap_farmasi', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->id('id_soap_farmasi');
                $table->string('no_rawat',17);
                $table->string('nik',20);
                $table->string('subjek',400);
                $table->string('objek',400);
                $table->string('assessment',400);
                $table->string('plan',400);
                $table->enum('jns_rawat',['rj','rp','ri']);
                $table->timestamps();

                $table->foreign('no_rawat','uxui_soap_farmasi_1')->references('no_rawat')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade'); 
                $table->foreign('nik','uxui_soap_farmasi_2')->references('nik')->on('pegawai')->onUpdate('cascade')->onDelete('cascade'); 
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
        if (!Schema::hasTable('uxui_soap_farmasi')) {
            Schema::dropIfExists('uxui_soap_farmasi');
        }
    }
}
