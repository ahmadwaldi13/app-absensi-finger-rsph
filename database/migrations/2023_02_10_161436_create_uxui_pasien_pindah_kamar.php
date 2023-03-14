<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUxuiPasienPindahKamar extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_pasien_pindah_kamar')) {
            Schema::create('uxui_pasien_pindah_kamar', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->string('no_rkm_medis',15);
                $table->string('no_rawat',17);
                $table->dateTime('waktu_masuk', 0);
                $table->string('kd_kamar_awal',15);
                $table->char('kd_bangsal_awal', 5);
                $table->string('nm_bangsal_awal',30);
                $table->double('trf_kamar_awal');
                $table->dateTime('waktu_keluar', 0);
                $table->string('kd_kamar_pindah',15);
                $table->char('kd_bangsal_pindah', 5);
                $table->string('nm_bangsal_pindah',30);
                $table->double('trf_kamar_pindah');
                $table->double('lama_inap');
                $table->double('total');
                $table->unique(['no_rkm_medis', 'no_rawat', 'waktu_masuk', 'waktu_keluar', 'kd_kamar_awal', 'kd_kamar_pindah'],'uxui_pasien_pindah_kamar_uniq');
            });
        }

        $table_name='uxui_pasien_pindah_kamar';
        $table=new Blueprint($table_name);
        $table->bigIncrements('id_pindah_kamar')->first();
        $this->update_table($table_name,$table);

        DB::statement("ALTER TABLE ".$table_name." MODIFY id_pindah_kamar bigInt(255) NOT NULL AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('uxui_pasien_pindah_kamar')) {
            Schema::dropIfExists('uxui_pasien_pindah_kamar');
        }
    }
}
