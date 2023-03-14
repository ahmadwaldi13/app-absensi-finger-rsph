<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUxuiPermintaanBarangNonMedisIpsrsdetailpengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran')) {
            Schema::create('uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';

                $table->string('no_permintaan', 20);
                $table->string('no_keluar', 15);
                $table->string('kode_brng', 20);
                $table->string('keterangan',255);
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
        Schema::dropIfExists('uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran');
    }
}
