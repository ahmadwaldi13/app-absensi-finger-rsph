<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RefJadwalPhitung extends \App\Classes\MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name='ref_jadwal_phitung';
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) use ($table_name) {
                $table->enum('type', ['Rutin','Shift']);
                $table->enum('jenis', ['Mulai','Akhir']);
                $table->smallInteger('jam')->length(2)->default(0);
                $table->smallInteger('menit')->length(2)->default(0);
                $table->smallInteger('detik')->length(2)->default(0);

                $table->unique(['type','jenis'],$table_name.'_uniq');
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
        $table_name='ref_jadwal_phitung';
        if (Schema::hasTable($table_name)) {
            Schema::dropIfExists($table_name);
        }
    }
}
