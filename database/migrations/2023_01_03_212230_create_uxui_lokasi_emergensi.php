<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUxuiLokasiEmergensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_lokasi_emergensi')) {
            Schema::create('uxui_lokasi_emergensi', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                
                $table->id();
                $table->string('no_rkm_medis',15);
                $table->string('longitude',200);
                $table->string('latitude',200);
                $table->string('keluhan');
                $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));

                $table->foreign('no_rkm_medis')->references('no_rkm_medis')->on('reg_periksa')->onUpdate('CASCADE')->onDelete('CASCADE'); 
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
        // if (Schema::hasTable('uxui_lokasi_emergensi')) {
            Schema::dropIfExists('uxui_lokasi_emergensi');
        // }
    }
}
