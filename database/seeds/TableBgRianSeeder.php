<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TableBgRianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {  
            $check=DB::table('uxui_userakses')->count('mm_idakses');
            if($check==0){
                $table=DB::table('uxui_userakses');
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $db=$table->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                DB::table('uxui_userakses')->insert([
                    'mm_idakses'=>1,
                    'nama'=>'Admin',
                    'no_hp'=>'081231231234',
                    'nip'=>'1212345678102',
                    'username'=>'rgadmin',
                    'password'=>'9d2629f036394ae5d8205fe1ee8648a7e64cb1d3a0cc997088fca2e5ff54d9c1e64635b81201fc54ab69aa5b2c8aa924e02410aa88eea5b7b7c4a3ac97d1c794TmBPOVHY7GZMsdkx4oi9XI5Hzv72FS8PjOmynEQth3M='
                ]);
                
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
