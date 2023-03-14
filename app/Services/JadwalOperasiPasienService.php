<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\RuangOk;
use App\Models\BookingOperasi;

class JadwalOperasiPasienService extends BaseService
{
    public function __construct()
    {
        parent::__construct(); 
        $this->ruangOk = new RuangOk;
        $this->bookingOperasi = new BookingOperasi;
    }

    function updateOperasi($params, $set, $type = '')
    {
      $query = $this->bookingOperasi;
        foreach ($params as $key => $value) {
          if ($type == 'raw') {
            $query = $query->whereRaw($key . ' = ? ', [$value]);
          } else {
            $query = $query->where($key, '=', $value);
          }
        }
      return $query->update($set);
    }

    function deleteOperasi($fields)
    {
        return BookingOperasi::where('no_rawat', $fields)->delete();
    }

    function getJadwalOperasiStatus()
    {
        return $this->bookingOperasi->getPossibleEnumValues("status");
    }

    public function getPaketOperasi()
    {
        return DB::select("
            select paket_operasi.kode_paket,paket_operasi.nm_perawatan,paket_operasi.kategori,paket_operasi.kd_pj,paket_operasi.kelas,
            paket_operasi.operator1,paket_operasi.operator2,paket_operasi.operator3,paket_operasi.asisten_operator1,paket_operasi.asisten_operator2,
            paket_operasi.asisten_operator3,paket_operasi.instrumen,paket_operasi.dokter_anak,paket_operasi.perawaat_resusitas,
            paket_operasi.dokter_anestesi,paket_operasi.asisten_anestesi,paket_operasi.asisten_anestesi2,paket_operasi.bidan,paket_operasi.bidan2,
            paket_operasi.bidan3,paket_operasi.perawat_luar,paket_operasi.alat,paket_operasi.sewa_ok,paket_operasi.akomodasi,paket_operasi.bagian_rs,
            paket_operasi.omloop,paket_operasi.omloop2,paket_operasi.omloop3,paket_operasi.omloop4,paket_operasi.omloop5,paket_operasi.sarpras,
            paket_operasi.dokter_pjanak,paket_operasi.dokter_umum from paket_operasi where paket_operasi.status='1' order by paket_operasi.nm_perawatan
        ");
    }

    function getJadwalOperasiList($filter = [], $noRawat)
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
            DB::raw('concat(diagnosa_pasien.kd_penyakit,\' \',penyakit.nm_penyakit) as diagnosa')
        )
            ->join('reg_periksa', 'booking_operasi.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('paket_operasi', 'booking_operasi.kode_paket', '=', 'paket_operasi.kode_paket')
            ->join('dokter', 'booking_operasi.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->leftJoin('diagnosa_pasien', 'booking_operasi.no_rawat', '=', 'diagnosa_pasien.no_rawat')
            ->leftJoin('penyakit', 'diagnosa_pasien.kd_penyakit', '=', 'penyakit.kd_penyakit')
            ->where('booking_operasi.no_rawat','=',$noRawat)
            ->orderBy('booking_operasi.tanggal', 'ASC')
            ->orderBy('booking_operasi.jam_mulai', 'ASC');

        if ($filter) {
            if (!empty($filter['search'])) {
                $query->where('booking_operasi.no_rawat', 'LIKE', '%' . $filter['search'] . '%')
                    ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $filter['search'] . '%')
                    ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $filter['search'] . '%')
                    ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter['search'] . '%')
                    ->orWhere('paket_operasi.nm_perawatan', 'LIKE', '%' . $filter['search'] . '%');
            }

            if (!empty($filter['status'])) {
                if (is_array($filter['status'])) {
                    $query->whereIn('booking_operasi.status', $filter['status']);
                } else {
                    $query->where('booking_operasi.status', $filter['status']);
                }
            }

            if (!empty($filter['status'])) {
                $query->where('booking_operasi.status', $filter['status']);
            }

            if (!empty($filter['tanggal_start']) && !empty($filter['tanggal_end'])) {
                $query->whereBetween('booking_operasi.tanggal',  [$filter['tanggal_start'], $filter['tanggal_end']]);
            }
        }

        return $query;
    }

    function getUpJadwalOperasi($noRawat)
    {
        $query = $this->bookingOperasi
            ->select('booking_operasi.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien','booking_operasi.tanggal','booking_operasi.jam_mulai','booking_operasi.jam_selesai','booking_operasi.status','booking_operasi.kd_dokter','dokter.nm_dokter','booking_operasi.kode_paket','paket_operasi.nm_perawatan',DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),'pasien.jk','poliklinik.nm_poli','booking_operasi.kd_ruang_ok','ruang_ok.nm_ruang_ok')
            ->join('reg_periksa','booking_operasi.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('paket_operasi','booking_operasi.kode_paket','=','paket_operasi.kode_paket')
            ->join('dokter','booking_operasi.kd_dokter','=','dokter.kd_dokter')
            ->join('poliklinik','reg_periksa.kd_poli','=','poliklinik.kd_poli')
            ->join('ruang_ok','booking_operasi.kd_ruang_ok','=','ruang_ok.kd_ruang_ok')
            ->where('booking_operasi.no_rawat','=',$noRawat);

        return $query;
    }
}