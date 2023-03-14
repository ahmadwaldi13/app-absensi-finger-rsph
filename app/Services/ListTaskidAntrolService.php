<?php

namespace App\Services;

use App\Models\RegPeriksa;
use App\Models\ReferensiMobilejkn;
use App\Models\ReferensiMobilejknBpjsTaskid;
use App\Services\Antrol\BridgeAntrolService;
use App\Services\BpjsService;
use Illuminate\Support\Facades\DB;

class ListTaskidAntrolService extends BaseService
{
    public function __construct(){
        parent::__construct(); 

        $this->regPeriksa = new RegPeriksa;
        $this->referenMobilejkn = new ReferensiMobilejkn;
        $this->referenTaskid = new ReferensiMobilejknBpjsTaskid;
        $this->bridgeAntrolService = new BridgeAntrolService;
        $this->bpjsService = new BpjsService;
    }

    function referensiMjkn($noRawat){
        $query = $this->referenMobilejkn
                // ->select('nobooking')
                ->select('*')
                ->where('no_rawat','=',$noRawat)
                ->get();

        foreach($query as $item){
            $hasil = $item->no_rawat;
        }
        return $hasil;
    }

    public function referensiTaskid($params=[]){
        $query= $this->referenTaskid
        ->select('*')->where('no_rawat', '=', $params);
        return $query->get();
    }

    public function getTaskid($params=[]){
        $data=$this->referensiTaskid($params);

        return $data;
    }

    function listTaskidOnline($noRawat)
    {
        $tampil1=[];
        $endpoint = 'antrean/getlisttask';
        try {
            $data = [
                "kodebooking" => !empty($noRawat) ? $noRawat : ""
            ];

            $result = $this->bridgeAntrolService->postRequest($endpoint, $data);
            $data = json_decode($result, true);
            $string = $data['response'];
            $tampil = json_encode($string);
            $tampil1 = json_decode($tampil, true);

            if ($data['metadata']['code'] == '200') {
                $hasil1 = $data['metadata']['message'];
            } else {
                $hasil1 = $data['metadata']['message'];
            }
        } catch (\Throwable $e) {
            $hasil1 = $data['metadata']['message'];
        }
        return $tampil1;
    }

    function listDataLocal(array $filter)
    {
        $query = $this->regPeriksa->select('reg_periksa.no_rkm_medis','reg_periksa.no_rawat','pasien.nm_pasien','poliklinik.nm_poli')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->where('reg_periksa.status_lanjut','=','Ralan')
            
            ->when([$filter['form_filter_date_start'], $filter['form_filter_date_end']], function ($query, $filter) {
                if ($filter[0] != null) {
                    $query->whereBetween('reg_periksa.tgl_registrasi',  [$filter[0], $filter[1]]);
                }
            })

            ->when($filter['poli'], function ($query, $filter) {
                $query->where('poliklinik.kd_poli', '=', $filter);
            })

            ->when($filter['filter_search'], function ($query, $filter) {
                $query->where(function ($qb2) use ($filter) {
                    $qb2->where('pasien.nm_pasien', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rawat', 'LIKE', '%' . $filter . '%')
                        ->orWhere('poliklinik.nm_poli', 'LIKE', '%' . $filter . '%');
                });
            })
            ->get();

            $result = [];
            if(count($query)){
                foreach ($query as $row)
                {
                    $check_data = $this->referenMobilejkn->where('no_rawat', '=', $row['no_rawat'])->count('nobooking');
                    if($check_data == 1){
                        $jkn = $this->referensiMjkn($row['no_rawat']);
                        $noRawat =  $jkn;
                    }else{
                        $noRawat = $row['no_rawat'];
                    }
                    $row['taskidbpjs'] = $this->listTaskidOnline($noRawat);
                    $result[] = $row;
                }
            }
            return $result;
    }

    function regPeriksaLocal(array $filter)
    {
        $query = $this->regPeriksa->select('reg_periksa.no_rkm_medis','pasien.no_peserta','reg_periksa.no_rawat','pasien.nm_pasien','poliklinik.nm_poli', 'poliklinik.kd_poli', 'dokter.nm_dokter', 'referensi_mobilejkn_bpjs.nobooking', 'bridging_sep.no_rujukan')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
            ->leftJoin('referensi_mobilejkn_bpjs', 'reg_periksa.no_rawat', '=', 'referensi_mobilejkn_bpjs.no_rawat')
            ->leftJoin('bridging_sep', 'reg_periksa.no_rawat', '=', 'bridging_sep.no_rawat')
            ->where('reg_periksa.status_lanjut','=','Ralan')
            ->where('reg_periksa.tgl_registrasi', '=', $filter)
            ->orderBy('reg_periksa.no_rawat', 'ASC')
            
            ->when($filter['poli'], function ($query, $filter) {
                $query->where('poliklinik.kd_poli', '=', $filter);
            })

            ->when($filter['filter_search'], function ($query, $filter) {
                $query->where(function ($qb2) use ($filter) {
                    $qb2->where('pasien.nm_pasien', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rawat', 'LIKE', '%' . $filter . '%')
                        ->orWhere('poliklinik.nm_poli', 'LIKE', '%' . $filter . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $filter . '%');
                });
            })
            ->get();


            $result = [];
            if(count($query)){
                foreach ($query as $row)
                {
                    $check_data = $this->referenMobilejkn->where('no_rawat', '=', $row['no_rawat'])->count('nobooking');
                    if($check_data == 1){
                        $jkn = $this->referensiMjkn($row['no_rawat']);
                        $noRawat =  $jkn;
                    }else{
                        $noRawat = $row['no_rawat'];
                    }
                    $row['task_id'] = $this->getTaskid($noRawat);
                    // dd($row['task_id'] );
                    $result[] = $row;
                }
            }
            return $result;
    }

    function taskid($noRawat, $taksid)
    {
        $endpoint = "antrean/updatewaktu";
        date_default_timezone_set(getenv('TIME_ZONE_BPJS_SERVICE'));
        $date_time = new \DateTime();
        $set_prefix_waktu_1=1000;
        $set_prefix_waktu_2=7;
        $waktu    = strtotime(''.$date_time->format('Y-m-d').' '.$date_time->format('H:i:s').'') * $set_prefix_waktu_1 + $set_prefix_waktu_2;

        if(!is_string($taksid)){
            $taksid=''.(string)$taksid.'';
        }
        
        $data = [
            "kodebooking" => $noRawat,
            "taskid"      => $taksid,
            "waktu"       => $waktu
        ];
        
        $data_tmp_tmp = $this->bridgeAntrolService->postRequest($endpoint, $data);

        $hasil_respon = json_decode($data_tmp_tmp, true);
        $hasil_respon =!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : '';
        $meta = $hasil_respon['message'];
        if(empty($hasil_respon)){
            $pesan=['error','Tidak ada internet',12];
        }else{
            if($hasil_respon['code']=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
            if($hasil_respon['code']!=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
        }
    }
}