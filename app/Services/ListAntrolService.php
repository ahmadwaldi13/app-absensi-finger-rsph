<?php

namespace App\Services;

use App\Models\RegPeriksa;
use App\Models\ReferensiMobilejkn;
use App\Services\Antrol\BridgeAntrolService;

class ListAntrolService extends BaseService
{
    public function __construct(){
        parent::__construct(); 

        $this->regPeriksa = new RegPeriksa();
        $this->referenMobilejkn = new ReferensiMobilejkn();
        $this->bridgeAntrolService = new BridgeAntrolService;
    }

    function referensiMjkn($noRawat){
        $query = $this->referenMobilejkn
                ->select('nobooking')
                ->where('no_rawat','=',$noRawat)
                ->get();

        foreach($query as $item){
            $hasil = $item->nobooking;
        }
        return $hasil;
    }

    function antreanOnline($noBooking)
    {
        $tampil1=[];
        $endpoint = "antrean/pendaftaran/kodebooking/{$noBooking}";
        try {
            $result = $this->bridgeAntrolService->getRequest($endpoint);
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

    function regPeriksaAntreanLocal($filter)
    {
        $query = $this->regPeriksa->select('reg_periksa.*','pasien.nm_pasien','poliklinik.nm_poli')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->where('reg_periksa.tgl_registrasi', '=', $filter)
            ->where('reg_periksa.status_lanjut','=','Ralan')
            ->get();
        $result = [];
        if(count($query)){
            foreach ($query as $row)
            {
                $check_data = $this->referenMobilejkn->where('no_rawat', '=', $row['no_rawat'])->count('nobooking');
                if($check_data == 1){
                    $jkn = $this->referensiMjkn($row['no_rawat']);
                    $noBooking = str_replace('/','%2F', $jkn);
                }else{
                    $noBooking = str_replace('/','%2F', $row['no_rawat']);
                }
                $row['antrean'] = $this->antreanOnline($noBooking);
                $result[] = $row;
            }
        }
        return $result;
    }
}