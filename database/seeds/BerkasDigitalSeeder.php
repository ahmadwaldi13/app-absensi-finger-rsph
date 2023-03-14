<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\UxuiBerkasJenis;
use App\Models\UxuiBerkasKlaim;

use App\Models\MasterBerkasDigital;

class BerkasDigitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $check=UxuiBerkasJenis::count();
            if($check==0){
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $db=UxuiBerkasJenis::truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                $data_master_berkas=MasterBerkasDigital::orderBy('kode','ASC')->get();

                if(!empty($data_master_berkas)){

                    $berkas_type_khusus=[
                        'kartu bpjs',
                        'kartu keluarga',
                        'ktp',
                    ];

                    $berkas_id_khusus=[
                        '04','05'
                    ];

                    foreach($data_master_berkas as $list){
                        if(!in_array($list->kode, $berkas_id_khusus)){
                            $kode_berkas=!empty($list->kode) ? $list->kode : null;
                            $nama_berkas=!empty($list->nama) ? $list->nama : null;
                            if(!empty($kode_berkas) and !empty($nama_berkas) ){
                                $prefix=trim(strtolower($nama_berkas));
                                $prefix = str_replace(" ","_", $prefix);
                                $prefix = str_replace("-","", $prefix);

                                $type=2;
                                foreach($berkas_type_khusus as $value_khusus){

                                    if( trim(strtolower($nama_berkas)) == trim(strtolower($value_khusus)) )
                                    $type=1;
                                }
                                $data_save[]=[
                                    'kode'=>$kode_berkas,
                                    'type'=>$type,
                                    'prefix'=>$prefix
                                ];
                            }
                        }
                    }

                    if(!empty($data_save)){
                        UxuiBerkasJenis::insertOrIgnore($data_save);
                    }
                }
            }

            $check=UxuiBerkasKlaim::count();
            if($check==0){
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $db=UxuiBerkasKlaim::truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                $data_save[]=[
                    'id'=>1,
                    'nama'=>'SEP',
                    'status'=>1
                ];

                $data_save[]=[
                    'id'=>2,
                    'nama'=>'SOAP/CPPT',
                    'status'=>1
                ];

                $data_save[]=[
                    'id'=>3,
                    'nama'=>'Billing',
                    'status'=>1
                ];

                $data_save[]=[
                    'id'=>4,
                    'nama'=>'Resume',
                    'status'=>1
                ];
                $data_save[]=[
                    'id'=>5,
                    'nama'=>'Laporan Operasi',
                    'status'=>1
                ];
                $data_save[]=[
                    'id'=>6,
                    'nama'=>'Hasil Lab PK M1',
                    'status'=>0
                ];
                $data_save[]=[
                    'id'=>7,
                    'nama'=>'Hasil Lab PK M9',
                    'status'=>1
                ];
                $data_save[]=[
                    'id'=>8,
                    'nama'=>'Hasil Lab Radiologi',
                    'status'=>1
                ];
                $data_save[]=[
                    'id'=>9,
                    'nama'=>'SKDP',
                    'status'=>1
                ];
                $data_save[]=[
                    'id'=>10,
                    'nama'=>'SPRI',
                    'status'=>1
                ];
                $data_save[]=[
                    'id'=>100,
                    'nama'=>'Data Berkas',
                    'status'=>1
                ];

                if(!empty($data_save)){
                    if(!empty($data_save)){
                        UxuiBerkasKlaim::insertOrIgnore($data_save);
                    }
                }
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