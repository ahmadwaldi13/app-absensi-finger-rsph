<?php

namespace App\Services;

use App\Models\RegPeriksa;
use App\Models\Jadwal;
use App\Models\UxuiSettinganMonitorPoli;
use App\Models\UxuiPanggilMonitorPoli;
use Illuminate\Support\Facades\DB;

class AntrianPoliklinikService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->regPeriksa = new RegPeriksa;
        $this->jadwal = new Jadwal;
        $this->uxuiSettinganMonitorPoli = new UxuiSettinganMonitorPoli;
        $this->uxuiPanggilMonitorPoli = new UxuiPanggilMonitorPoli;
    }

    public function getListRawatJalan(array $filter)
    {
      $query = $this->regPeriksa
            ->select(
                'reg_periksa.no_reg',
                'reg_periksa.no_rawat',
                'reg_periksa.tgl_registrasi',
                'reg_periksa.jam_reg',
                'reg_periksa.kd_dokter',
                'dokter.nm_dokter',
                'reg_periksa.no_rkm_medis',
                'pasien.nm_pasien',
                'poliklinik.nm_poli',
                'reg_periksa.p_jawab',
                'reg_periksa.almt_pj',
                'reg_periksa.hubunganpj',
                'reg_periksa.biaya_reg',
                'reg_periksa.stts',
                'penjab.png_jawab',
                DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),
                'reg_periksa.status_bayar',
                'reg_periksa.status_poli',
                'reg_periksa.kd_pj',
                'reg_periksa.kd_poli',
                'pasien.no_tlp',
                DB::raw(
                    'concat(
                        uxui_tindakan_pasien.pemeriksaan,\'-\',
                        uxui_tindakan_pasien.permintaan_lab,\'-\',
                        uxui_tindakan_pasien.resep,\'-\',
                        uxui_tindakan_pasien.resume
                    ) as tindakan_pasien'.
                    (empty($filter["kd_dokter"]) ? ',concat(uxui_tindakan_pasien_perawat.pemeriksaan) as tindakan_pasien_perawat': ''))
            )
            ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->join('penjab', 'reg_periksa.kd_pj', '=', 'penjab.kd_pj')
            ->leftJoin('uxui_tindakan_pasien', function ($join) {
                $join->on('uxui_tindakan_pasien.no_rawat', '=', 'reg_periksa.no_rawat');
                $join->on('uxui_tindakan_pasien.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis');
                $join->where('uxui_tindakan_pasien.type_akses', '=', 'rj');
            })
            ->where('reg_periksa.status_lanjut', '=', 'Ralan')
            ->where('reg_periksa.kd_poli', 'NOT LIKE', '%IGDK%')
            ->where('reg_periksa.stts', 'LIKE', 'Belum')
            ->orderBy('reg_periksa.no_rawat', 'ASC')

            ->when($filter['poli'], function ($query, $filter) {
                $query->where('poliklinik.kd_poli', '=', $filter);
            })

            ->when([$filter['start'], $filter['end']], function ($query, $filter) {
                if ($filter[0] != null) {
                    $query->whereBetween('reg_periksa.tgl_registrasi',  [$filter[0], $filter[1]]);
                }
            })
            ->when($filter['search'], function ($query, $filter) {
                $query->where(function ($qb2) use ($filter) {
                    $qb2->where('dokter.nm_dokter', 'LIKE', '%' . $filter . '%')
                        ->orWhere('dokter.kd_dokter', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $filter . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.stts', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rawat', 'LIKE', '%' . $filter . '%');
                });
            });

            if(empty($filter['kd_dokter'])){
                $query->leftJoin('uxui_tindakan_pasien_perawat', function ($join) {
                    $join->on('uxui_tindakan_pasien_perawat.no_rawat', '=', 'reg_periksa.no_rawat');
                    $join->on('uxui_tindakan_pasien_perawat.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis');
                    $join->where('uxui_tindakan_pasien_perawat.type_akses', '=', 'rj');
                });
            }
        return $query;
    }

    function getAllAntrian($date, $kode)
    {
      $tentukan_hari=date('D',strtotime(date('Y-m-d')));
      $day = array(
          'Sun' => 'AKHAD',
          'Mon' => 'SENIN',
          'Tue' => 'SELASA',
          'Wed' => 'RABU',
          'Thu' => 'KAMIS',
          'Fri' => 'JUMAT',
          'Sat' => 'SABTU'
        );
      $hari=$day[$tentukan_hari];
      // Ini untuk semua
      // $display = $this->uxuiSettinganMonitorPoli->get()->toArray();
      // Ini untuk per kode
      $display = $this->uxuiSettinganMonitorPoli
                  ->where('kode_setting','=', $kode)
                  ->get()
                  ->toArray();
      foreach($display as $values){
        $poliklinik = str_replace(",","','",!empty($values["item_poli"]) ? $values["item_poli"] : "");
        $query = DB::select("SELECT a.kd_dokter, a.kd_poli, b.nm_poli, c.nm_dokter, a.jam_mulai, a.jam_selesai FROM jadwal a, poliklinik b, dokter c WHERE a.kd_poli = b.kd_poli AND a.kd_dokter = c.kd_dokter AND a.hari_kerja = '$hari'  AND a.kd_poli IN ('$poliklinik')");
      }
      $result = [];
      if(!empty($query)?? count($query) ) {
          foreach ($query as $row) {
              $row->dalam_pemeriksaan = $this->regPeriksa
                ->select('no_reg','nm_pasien')
                ->join('pasien', 'pasien.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis')
                ->where('tgl_registrasi', $date)
                ->where('stts', 'Berkas Diterima')
                ->where('kd_poli', $row->kd_poli)
                ->where('kd_dokter', $row->kd_dokter)
                ->first();
              $row->dalam_antrian = $this->regPeriksa
                ->select(['jumlah'=> DB::raw('COUNT(DISTINCT reg_periksa.no_rawat) as jumlah')])
                ->join('poliklinik', 'poliklinik.kd_poli', '=', 'reg_periksa.kd_poli')
                ->where('reg_periksa.tgl_registrasi', date('Y-m-d'))
                ->where('reg_periksa.kd_poli', $row->kd_poli)
                ->where('reg_periksa.kd_dokter', $row->kd_dokter)
                ->first();
              $row->sudah_dilayani = $this->regPeriksa
                ->select(['count' => DB::raw('COUNT(DISTINCT reg_periksa.no_rawat) as count')])
                ->join('poliklinik', 'poliklinik.kd_poli', '=', 'reg_periksa.kd_poli')
                ->where('reg_periksa.tgl_registrasi', date('Y-m-d'))
                ->where('reg_periksa.kd_poli', $row->kd_poli)
                ->where('reg_periksa.kd_dokter', $row->kd_dokter)
                ->where('reg_periksa.stts', 'Sudah')
                ->first();
                $row->sudah_dilayani->jumlah = 0;
                if(!empty($row->sudah_dilayani)) {
                  $row->sudah_dilayani->jumlah = $row->sudah_dilayani->count;
              }
              $row->selanjutnya = $this->regPeriksa
                ->select('reg_periksa.no_reg', 'pasien.nm_pasien')
                ->join('pasien', 'pasien.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis')
                ->where('reg_periksa.tgl_registrasi', $date)
                ->where('reg_periksa.stts', 'Belum')
                ->where('reg_periksa.kd_poli', $row->kd_poli)
                ->where('reg_periksa.kd_dokter', $row->kd_dokter)
                ->orderBy('reg_periksa.no_reg', 'ASC')
                ->get();
                
              $row->get_no_reg = $this->regPeriksa
                ->select(['max' => DB::raw('ifnull(MAX(CONVERT(RIGHT(no_reg,3),signed)),0) as max')])
                ->where('tgl_registrasi', $date)
                ->where('kd_poli', $row->kd_poli)
                ->where('kd_dokter', $row->kd_dokter)
                ->first();
              $row->diff= (strtotime($row->jam_selesai)-strtotime($row->jam_mulai))/60;
              $row->interval = 0;
              if($row->diff == 0) {
                $row->interval = round($row->diff/$row->get_no_reg->max);
              }
              if($row->interval > 10){
                  $interval = 10;
                } else {
                  $interval = $row->interval;
                }
              if (is_array($row->selanjutnya) || is_object($row->selanjutnya))
              {
              foreach ($row->selanjutnya as $value) {
                  
              }
          }   
          
          $result[] = $row;
          }
      }
      return $result;
    }
    public function get_list_panggilan_poliklinik($kode){
      $query = $this->uxuiPanggilMonitorPoli
                  ->select($this->uxuiPanggilMonitorPoli->table.'.*')
                  ->join('poliklinik','poliklinik.nm_poli','=',$this->uxuiPanggilMonitorPoli->table.'.poli')
                  ->join('uxui_settingan_monitor_poli','uxui_settingan_monitor_poli.item_poli','=','poliklinik.kd_poli')
                  ->where('uxui_settingan_monitor_poli.kode_setting','=',$kode)
                  ->get();
      return $query;
    }
}