<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUxuiRmOperasi extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('checklist_pre_operasi')) {
            Schema::create('checklist_pre_operasi', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->string('no_rawat',17);
                $table->dateTime('tanggal');
                $table->string('sncn',25);
                $table->string('tindakan',50);
                $table->string('kd_dokter_bedah',20);
                $table->string('kd_dokter_anestesi',20);
                $table->enum('identitas', ['Ya','Tidak'])->nullable();
                $table->enum('surat_ijin_bedah', ['Ada','Tidak Ada'])->nullable();
                $table->enum('surat_ijin_anestesi', ['Ada','Tidak Ada'])->nullable();
                $table->enum('surat_ijin_transfusi', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->enum('penandaan_area_operasi', ['Ada','Tidak Ada'])->nullable();
                $table->enum('keadaan_umum', ['Baik','Sedang','Lemah'])->nullable();
                $table->enum('pemeriksaan_penunjang_rontgen', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_rontgen',20)->nullable();
                $table->enum('pemeriksaan_penunjang_ekg', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_ekg',20)->nullable();
                $table->enum('pemeriksaan_penunjang_usg', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_usg',20)->nullable();
                $table->enum('pemeriksaan_penunjang_ctscan', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_ctscan',20)->nullable();
                $table->enum('pemeriksaan_penunjang_mri', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_mri',20)->nullable();
                $table->enum('persiapan_darah', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->string('keterangan_persiapan_darah',20)->nullable();
                $table->enum('perlengkapan_khusus', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->string('nip_petugas_ruangan',20)->nullable();
                $table->string('nip_perawat_ok',20)->nullable();

                $table->foreign('no_rawat')->references('no_rawat')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('nip_petugas_ruangan')->references('nip')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('nip_perawat_ok')->references('nip')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_anestesi')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_bedah')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');

                $table->primary(['no_rawat', 'tanggal']);
            });
        }

        if (!Schema::hasTable('checklist_post_operasi')) {
            Schema::create('checklist_post_operasi', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->string('no_rawat',17);
                $table->dateTime('tanggal');
                $table->string('sncn',25);
                $table->string('tindakan',50);
                $table->string('kd_dokter_bedah',20);
                $table->string('kd_dokter_anestesi',20);
                $table->enum('keadaan_umum', ['Sadar','Tidur','Terintubasi'])->nullable();
                $table->enum('pemeriksaan_penunjang_rontgen', ['Ada','Tidak Ada'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_rontgen',20)->nullable();
                $table->enum('pemeriksaan_penunjang_ekg', ['Ada','Tidak Ada'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_ekg',20)->nullable();
                $table->enum('pemeriksaan_penunjang_usg', ['Ada','Tidak Ada'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_usg',20)->nullable();
                $table->enum('pemeriksaan_penunjang_ctscan', ['Ada','Tidak Ada'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_ctscan',20)->nullable();
                $table->enum('pemeriksaan_penunjang_mri', ['Ada','Tidak Ada'])->nullable();
                $table->string('keterangan_pemeriksaan_penunjang_mri',20)->nullable();
                $table->string('jenis_cairan_infus',40)->nullable();
                $table->enum('kateter_urine', ['Ada','Tidak Ada'])->nullable();
                $table->dateTime('tanggal_pemasangan_kateter');
                $table->enum('warna_kateter', ['Jernih','Keruh','-'])->nullable();
                $table->string('jumlah_kateter',4)->nullable();
                $table->string('area_luka_operasi',120)->nullable();
                $table->enum('drain', ['Ada','Tidak Ada'])->nullable();
                $table->string('jumlah_drain',2)->nullable();
                $table->string('letak_drain',40)->nullable();
                $table->string('warna_drain',40)->nullable();
                $table->enum('jaringan_pa', ['Ada','Tidak Ada'])->nullable();
                $table->string('nip_perawat_ok',20)->nullable();
                $table->string('nip_perawat_anestesi',20)->nullable();

                $table->foreign('no_rawat')->references('no_rawat')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('nip_perawat_anestesi')->references('nip')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('nip_perawat_ok')->references('nip')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_anestesi')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_bedah')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');

                $table->primary(['no_rawat', 'tanggal']);
            });
        }

        if (!Schema::hasTable('signin_sebelum_anestesi')) {
            Schema::create('signin_sebelum_anestesi', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->string('no_rawat',17);
                $table->dateTime('tanggal');
                $table->string('sncn',25);
                $table->string('tindakan',50);
                $table->string('kd_dokter_bedah',20);
                $table->string('kd_dokter_anestesi',20);
                $table->enum('identitas', ['Ya','Tidak'])->nullable();
                $table->enum('penandaan_area_operasi', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->string('alergi',30)->nullable();
                $table->enum('resiko_aspirasi', ['Ada','Tidak Ada'])->nullable();
                $table->string('resiko_aspirasi_rencana_antisipasi',50)->nullable();
                $table->enum('resiko_kehilangan_darah', ['Tidak Ada','Ada'])->nullable();
                $table->string('resiko_kehilangan_darah_line',30)->nullable();
                $table->string('resiko_kehilangan_darah_rencana_antisipasi',50)->nullable();
                $table->enum('kesiapan_alat_obat_anestesi', ['Lengkap','Pulsa Oximetri','Tidak Lengkap'])->nullable();
                $table->string('kesiapan_alat_obat_anestesi_rencana_antisipasi',50)->nullable();
                $table->string('nip_perawat_ok',20)->nullable();


                $table->foreign('no_rawat')->references('no_rawat')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('nip_perawat_ok')->references('nip')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_anestesi')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_bedah')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');
                $table->primary(['no_rawat', 'tanggal']);
            });
    }

    if (!Schema::hasTable('timeout_sebelum_insisi')) {
            Schema::create('timeout_sebelum_insisi', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->string('no_rawat',17);
                $table->dateTime('tanggal');
                $table->string('sncn',25);
                $table->string('tindakan',50);
                $table->string('kd_dokter_bedah',20);
                $table->string('kd_dokter_anestesi',20);
                $table->enum('verbal_identitas', ['Ya','Tidak'])->nullable();
                $table->enum('verbal_tindakan', ['Ya','Tidak'])->nullable();
                $table->enum('verbal_area_insisi', ['Ya','Tidak'])->nullable();
                $table->enum('penandaan_area_operasi', ['Ada','Tidak Ada','Tidak Diperlukan'])->nullable();
                $table->string('lama_operasi',10);
                $table->enum('penayangan_radiologi', ['Ditayangkan','Benar','Tidak Diperlukan'])->nullable();
                $table->enum('penayangan_ctscan', ['Ditayangkan','Benar','Tidak Diperlukan'])->nullable();
                $table->enum('penayangan_mri', ['Ditayangkan','Benar','Tidak Diperlukan'])->nullable();
                $table->enum('antibiotik_profilaks', ['Ya','Tidak'])->nullable();
                $table->string('nama_antibiotik',50);
                $table->string('jam_pemberian',10);
                $table->string('antisipasi_kehilangan_darah',50);
                $table->enum('hal_khusus', ['Ada','Tidak Ada'])->nullable();
                $table->string('hal_khusus_diperhatikan',100);
                $table->date('tanggal_steril')->nullable();
                $table->enum('petujuk_sterilisasi', ['Ya','Tidak'])->nullable();
                $table->enum('verifikasi_preoperatif', ['Ya','Tidak'])->nullable();
                $table->string('nip_perawat_ok',20)->nullable();

                $table->foreign('no_rawat')->references('no_rawat')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('nip_perawat_ok')->references('nip')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_anestesi')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_bedah')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');
                $table->primary(['no_rawat', 'tanggal']);
            });
    }

    if (!Schema::hasTable('signout_sebelum_menutup_luka')) {
            Schema::create('signout_sebelum_menutup_luka', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->string('no_rawat',17);
                $table->dateTime('tanggal');
                $table->string('sncn',25);
                $table->string('tindakan',50);
                $table->string('kd_dokter_bedah',20);
                $table->string('kd_dokter_anestesi',20);
                $table->enum('verbal_tindakan', ['Ya','Tidak'])->nullable();
                $table->enum('verbal_kelengkapan_kasa', ['Ya','Tidak'])->nullable();
                $table->enum('verbal_instrumen', ['Ya','Tidak'])->nullable();
                $table->enum('verbal_alat_tajam', ['Ya','Tidak'])->nullable();
                $table->enum('kelengkapan_specimen_label', ['Lengkap','Tidak Lengkap','Tidak Ada Pemeriksaan Spesimen'])->nullable();
                $table->enum('kelengkapan_specimen_formulir', ['Lengkap','Tidak Lengkap','Tidak Ada Pemeriksaan Spesimen'])->nullable();
                $table->enum('peninjauan_kegiatan_dokter_bedah', ['Ya','Tidak'])->nullable();
                $table->enum('peninjauan_kegiatan_dokter_anestesi', ['Ya','Tidak'])->nullable();
                $table->enum('peninjauan_kegiatan_perawat_kamar_ok', ['Ya','Tidak'])->nullable();
                $table->string('perhatian_utama_fase_pemulihan',100)->nullable();
                $table->string('nip_perawat_ok',20)->nullable();

                $table->foreign('no_rawat')->references('no_rawat')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('nip_perawat_ok')->references('nip')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_anestesi')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('kd_dokter_bedah')->references('kd_dokter')->on('dokter')->onUpdate('cascade')->onDelete('cascade');
                $table->primary(['no_rawat', 'tanggal']);
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
        if (Schema::hasTable('checklist_pre_operasi')) {
            Schema::dropIfExists('checklist_pre_operasi');
        }
        if (Schema::hasTable('checklist_post_operasi')) {
            Schema::dropIfExists('checklist_post_operasi');
        }

        if (Schema::hasTable('signin_sebelum_anestesi')) {
            Schema::dropIfExists('signin_sebelum_anestesi');
        }

        if (Schema::hasTable('timeout_sebelum_insisi')) {
            Schema::dropIfExists('timeout_sebelum_insisi');
        }

        if (Schema::hasTable('signout_sebelum_menutup_luka')) {
            Schema::dropIfExists('signout_sebelum_menutup_luka');
        }
    }
}

