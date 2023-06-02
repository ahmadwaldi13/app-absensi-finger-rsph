<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DeleteTabelDuluSeeder extends Seeder
{
    public function run()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $data_table=['ref_user_info','ref_user_info_detail','ref_karyawan_user','ref_jadwal'];
            foreach($data_table as $value){
                if (Schema::hasTable($value)) {
                    Schema::dropIfExists($value);
                }
            }
        
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch(\Illuminate\Database\QueryException $e){
            if($e->errorInfo[1] == '1062'){
            }
            dd($e);
        } catch (\Throwable $e) {
            dd($e);
        }
    }
}