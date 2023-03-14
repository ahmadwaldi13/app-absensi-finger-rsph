<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\RuangOk;
use App\Models\BookingOperasi;

class JadwalOperasiService extends BaseService
{
    public function __construct(
        RuangOk $ruangOk,
        BookingOperasi $bookingOperasi
    ){
        parent::__construct(); 
        $this->ruangOk = $ruangOk;
        $this->bookingOperasi = $bookingOperasi;
    }

    function getKamarOperasi($params=[])
    {

        $query = $this->ruangOk
            ->orderBy('nm_ruang_ok','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }

        return $query->get();
    }

    function getJadwalOperasiList($params,$type='')
    {
        $query = $this->bookingOperasi->select(
            'booking_operasi.no_rawat',
            'reg_periksa.no_rkm_medis',
            'pasien.nm_pasien',
            'booking_operasi.tanggal',
            'booking_operasi.jam_mulai',
            'booking_operasi.jam_selesai',
            'booking_operasi.status',
            'booking_operasi.kd_dokter',
            'dokter.nm_dokter',
            'booking_operasi.kode_paket',
            'paket_operasi.nm_perawatan',
            DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),
            'pasien.jk',
            'poliklinik.nm_poli',
            DB::raw('concat(diagnosa_pasien.kd_penyakit,\' \',penyakit.nm_penyakit) as diagnosa'),
            'ruang_ok.kd_ruang_ok',
            'ruang_ok.nm_ruang_ok'
        )
            ->join('reg_periksa', 'booking_operasi.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('paket_operasi', 'booking_operasi.kode_paket', '=', 'paket_operasi.kode_paket')
            ->join('dokter', 'booking_operasi.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->leftJoin('diagnosa_pasien', 'booking_operasi.no_rawat', '=', 'diagnosa_pasien.no_rawat')
            ->leftJoin('penyakit', 'diagnosa_pasien.kd_penyakit', '=', 'penyakit.kd_penyakit')
            ->leftJoin('ruang_ok', 'ruang_ok.kd_ruang_ok', '=', 'booking_operasi.kd_ruang_ok')
            ->orderBy('booking_operasi.tanggal', 'ASC')
            ->orderBy('booking_operasi.jam_mulai', 'ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                if($key!='search' and $key!='tanggal' and $key!='whereIn'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tanggal'])){
                $data_tgl=$params['tanggal'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('booking_operasi.tanggal', $data_tgl);
                }
            }

            if(!empty($params['whereIn'])){
                foreach($params['whereIn'] as $key => $value){
                    $query->whereIn($key, $value);
                }
            };

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('booking_operasi.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('paket_operasi.nm_perawatan', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }
        
        if(!empty($type)){
            return $query;
        }else{
            return $query->get();
        }
    }
}