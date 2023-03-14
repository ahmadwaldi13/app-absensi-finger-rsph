<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUxuiSitb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_pasien_sitb')) {
            Schema::create('uxui_pasien_sitb', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->string('id_tb_03',30)->primary();
                $table->string('no_rkm_medis',15);
                $table->string('kode_icd_x',15);
                $table->string('tipe_diagnosis',2);
                $table->string('klasifikasi_lokasi_anatomi',2);
                $table->string('klasifikasi_riwayat_pengobatan',2);
                $table->string('sebelum_pengobatan_hasil_mikroskopis',20);
                $table->string('sebelum_pengobatan_hasil_tes_cepat',20);
                $table->string('sebelum_pengobatan_hasil_biakan',20);
                $table->string('hasil_mikroskopis_bulan_2',20);
                $table->string('hasil_mikroskopis_bulan_3',20);
                $table->string('hasil_mikroskopis_bulan_5',20);
                $table->string('akhir_pengobatan_hasil_mikroskopis',20);
                $table->string('hasil_akhir_pengobatan',2);

                $table->date('tanggal_mulai_pengobatan');
                $table->date('tanggal_hasil_akhir_pengobatan')->nullable();
                $table->string('nip', 20);

                $table->foreign(['nip'],'uxui_pbnmstatus_2')->references(['nik'])->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('no_rkm_medis','uxui_pasien_sitb_1')->references('no_rkm_medis')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade'); 
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
        Schema::dropIfExists('uxui_pasien_sitb');
    }
}
