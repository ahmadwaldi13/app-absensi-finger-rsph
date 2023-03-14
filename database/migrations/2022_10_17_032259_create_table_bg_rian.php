<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBgRian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_userakses')) {
            Schema::create('uxui_userakses', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->integer('mm_idakses',11);
                $table->char('nama', 35)->nullable(true);
                $table->char('no_hp', 12)->nullable(true);
                $table->char('nip', 16)->nullable(true);
                $table->char('username', 30)->nullable(true);
                $table->text('password')->nullable(true);
            });
        }

        if (!Schema::hasTable('uxui_pasien_baru_onsite')) {
            Schema::create('uxui_pasien_baru_onsite', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->char('no_rkm_medis', 7)->nullable(true);
                $table->char('no_boking', 18)->nullable(true);
                $table->date('tanggal')->nullable(true);
                $table->char('no_referensi', 20)->nullable(true);
                $table->char('jns_kunjungan', 2)->nullable(true);
                $table->enum('posisi', ['Belum','Sudah'])->nullable(true)->default('Belum');
                
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
        if (Schema::hasTable('uxui_userakses')) {
            Schema::dropIfExists('uxui_userakses');
        }
        
        if (Schema::hasTable('uxui_pasien_baru_onsite')) {
            Schema::dropIfExists('uxui_pasien_baru_onsite');
        }
    }
}
