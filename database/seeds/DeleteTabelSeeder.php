<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DeleteTabelSeeder extends Seeder
{
    public function run()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            if (Schema::hasTable('kamar_operasis')) {
                Schema::dropIfExists('kamar_operasis');
            }

            if (Schema::hasTable('jadwal_kamar_operasis')) {
                Schema::dropIfExists('jadwal_kamar_operasis');
            }

            if (Schema::hasTable('booking_operasi_subs')) {
                Schema::dropIfExists('booking_operasi_subs');
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch(\Illuminate\Database\QueryException $e){
            if($e->errorInfo[1] == '1062'){
                dd($e);
            }
            dd($e);
        } catch (\Throwable $e) {
            dd($e);
        }
    }
}