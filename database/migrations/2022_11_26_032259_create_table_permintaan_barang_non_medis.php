<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTablePermintaanBarangNonMedis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_permintaan_barang_non_medis_status')) {
            Schema::create('uxui_permintaan_barang_non_medis_status', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->string('no_permintaan', 20);
                $table->string('nip', 20);
                $table->char('departemen', 4)->nullable(true);
                $table->smallInteger('pengajuan')->length(6)->unsigned()->comment('1=pengajuan');
                $table->smallInteger('verifikasi_ke')->length(6)->unsigned()->comment('verifikasi ke n');
                $table->smallInteger('status')->length(6)->unsigned()->comment('pengajuan (0=pengajuan, 1=proses, 2=terima, 3=tolak) verifikasi (2=terima,3=tolak) ');
                $table->timestamp('tanggal')->useCurrent();
                $table->string('keterangan', 255)->nullable(true);

                $table->unique(['no_permintaan','nip','pengajuan','verifikasi_ke','status'],'uxui_pbnmstatus_uniq');
                $table->foreign('no_permintaan','uxui_pbnmstatus_1')->references('no_permintaan')->on('permintaan_non_medis')->onUpdate('cascade')->onDelete('cascade'); 
                $table->foreign(['nip','departemen'],'uxui_pbnmstatus_2')->references(['nik','departemen'])->on('pegawai')->onUpdate('cascade')->onDelete('cascade'); 
            });
        }

        if (!Schema::hasTable('uxui_permintaan_barang_validasi')) {
            Schema::create('uxui_permintaan_barang_validasi', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->string('nip', 20);
                $table->char('departemen', 4);
        
                $table->unique(['nip','departemen'],'uxui_pbvalidasi_uniq');
                $table->foreign('nip','uxui_pbvalidasi_1')->references('nik')->on('pegawai')->onUpdate('cascade')->onDelete('cascade'); 
                $table->foreign('departemen','uxui_pbvalidasi_2')->references('dep_id')->on('departemen')->onUpdate('cascade')->onDelete('cascade'); 
            });
        }

        if (!Schema::hasTable('uxui_permintaan_barang_non_medis_pengeluaran')) {
            Schema::create('uxui_permintaan_barang_non_medis_pengeluaran', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->string('no_permintaan', 20);
                $table->string('no_keluar', 15);
        
                $table->unique(['no_permintaan','no_keluar'],'uxui_pbnm_pengeluaran_uniq');
                $table->foreign('no_permintaan','uxui_pbnm_pengeluaran_1')->references('no_permintaan')->on('permintaan_non_medis')->onUpdate('cascade')->onDelete('cascade'); 
                $table->foreign('no_keluar','uxui_pbnm_pengeluaran_2')->references('no_keluar')->on('ipsrspengeluaran')->onUpdate('cascade')->onDelete('cascade'); 
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
        if (Schema::hasTable('uxui_permintaan_barang_non_medis_status')) {
            Schema::dropIfExists('uxui_permintaan_barang_non_medis_status');
        }

        if (Schema::hasTable('uxui_permintaan_barang_validasi')) {
            Schema::dropIfExists('uxui_permintaan_barang_validasi');
        }

        if (Schema::hasTable('uxui_permintaan_barang_non_medis_pengeluaran')) {
            Schema::dropIfExists('uxui_permintaan_barang_non_medis_pengeluaran');
        }
    }
}
