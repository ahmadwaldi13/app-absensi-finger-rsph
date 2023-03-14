<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableActionBpjs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('uxui_taskid_errors')) {
            Schema::create('uxui_taskid_errors', function(Blueprint $table){
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                $table->string('no_rawat', 17);
                $table->smallInteger('taskid')->length(6)->unsigned();
                $table->string('kode', 255)->nullable(true);
                $table->text('message')->nullable(true);
                $table->dateTime('waktu', 0)->nullable(true);
                $table->unique(['no_rawat','taskid'],'uxui_taskid_errors_uniq');
                $table->foreign('no_rawat')->references('no_rawat')->on('reg_periksa')->onUpdate('cascade')->onDelete('cascade'); 
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
        if (Schema::hasTable('uxui_taskid_errors')) {
            Schema::dropIfExists('uxui_taskid_errors');
        }
    }
}
