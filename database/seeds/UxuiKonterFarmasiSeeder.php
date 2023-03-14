<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UxuiKonterFarmasi;

class UxuiKonterFarmasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $check=UxuiKonterFarmasi::count();
            if($check==0){
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $db=UxuiKonterFarmasi::truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                UxuiKonterFarmasi::create(['konter_no' => 'loket 1','kode_konter'=>'ralan']);
                UxuiKonterFarmasi::create(['konter_no' => 'loket 2','kode_konter'=>'ranap']);

            }
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