<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAbsensi extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='ref_data_absensi_tmp';
        $table=new Blueprint($table_name);
        $table->integer('id_mesin_absensi')->length(10)->unsigned();
        $table->integer('id_user')->length(10)->unsigned();
        $table->dateTime('waktu');
        $table->string('verified', 20);
        $table->string('status', 20);
        $this->set_table($table_name,$table);


        $table_name='data_absensi_karyawan';
        $table=new Blueprint($table_name);
        $table->bigIncrements('id_data_absensi_karyawan');
        $table->integer('id_user')->length(10)->unsigned();
        $table->string('username', 40);
        $table->integer('id_karyawan')->length(10)->unsigned();
        $table->string('nm_karyawan',50);
        $table->string('alamat',200);
        $table->string('nip',50);
        $table->smallInteger('id_jabatan');
        $table->smallInteger('id_departemen');
        $table->string('nm_jabatan',50);
        $table->string('nm_departemen',50);
        $table->integer('id_mesin_absensi')->length(10)->unsigned();
        $table->string('nm_mesin')->length(255);
        $table->string('lokasi_mesin')->length(255);
        $table->dateTime('waktu_absensi');
        $table->date('tgl_absensi');
        $table->string('jam_absensi',20);
        $table->string('verified_mesin', 20);
        $table->string('status_absensi_mesin', 20);
        $table->integer('id_jenis_jadwal')->length(10)->unsigned();
        $table->string('nm_jenis_jadwal')->length(255);
        $table->integer('id_jadwal')->length(10)->unsigned();
        $table->string('nm_jadwal')->length(255);
        $table->string('waktu_buka',20);
        $table->string('waktu_tutup',20);
        $table->string('jam',10);
        $table->string('menit',10);
        $table->string('detik',10);
        $table->smallInteger('hasil_status_absensi');
        $table->string('hasil_status_absensi_text',50);

        $table->unique(['id_user','id_mesin_absensi','waktu_absensi'],$table_name.'_uniq');
        $this->set_table($table_name,$table);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table_name='ref_data_absensi_tmp';
        if (Schema::hasTable($table_name)) {
            Schema::dropIfExists($table_name);
        }

        $table_name='data_absensi_karyawan';
        if (Schema::hasTable($table_name)) {
            Schema::dropIfExists($table_name);
        }
    }
}
