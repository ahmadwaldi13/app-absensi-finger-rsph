<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefJadwalPhitungSeeder extends Seeder
{

    public function __construct() {

    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $table=(new \App\Models\RefJadwalPhitung);
            $check=$table::count();
            if($check==0){
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $db=$table::truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                $table::insertOrIgnore(['type' => 'Rutin','jenis'=>'Mulai','jam'=>0,'menit'=>30,'detik'=>0]);
                $table::insertOrIgnore(['type' => 'Rutin','jenis'=>'Akhir','jam'=>0,'menit'=>30,'detik'=>0]);
            }
        } catch(\Illuminate\Database\QueryException $e){
            if($e->errorInfo[1] == '1062'){

            }
            dd($e);
        } catch (\Throwable $e) {
            dd($e);
        }
    }
}