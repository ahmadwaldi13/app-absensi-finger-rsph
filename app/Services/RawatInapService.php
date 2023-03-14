<?php

namespace App\Services;

use App\Models\Kabupaten;
use App\Models\PoliKlinik;
use App\Models\RawatJl;
use App\Models\RegPeriksa;
use App\Models\KamarInap;
use App\Models\Bangsal;
use App\Services\BaseService;
use App\Models\PemeriksaanRanap;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

class RawatInapService extends BaseService
{
    protected $rawatJl;
    protected $regPeriksa;
    protected $poliKlinik;
    protected $city;
    protected $kamarInap;
    protected $bangsal;
    protected $pemeriksaanRanap;
    protected $pasien;
    public function __construct(RawatJl $rawatJl,
    RegPeriksa $regPeriksa, PoliKlinik $poliKlinik, Kabupaten $city, KamarInap $kamarInap,
    Bangsal $bangsal,
    Pasien $pasien,
    PemeriksaanRanap $pemeriksaanRanap
    )
    {
        parent::__construct();
        $this->rawatJl = $rawatJl;
        $this->regPeriksa = $regPeriksa;
        $this->poliKlinik = $poliKlinik;
        $this->city = $city;
        $this->kamarInap = $kamarInap;
        $this->bangsal = $bangsal;
        $this->pasien = $pasien;
    }

    /**
     * Get all rawat jalan
     *
     * @param array $filter array filter ['city', 'poli', 'status', 'start']
     *
     * @return Model
     * @throws Exception
     **/

    function getRanapList($params=[])
    {
        $query= $this->kamarInap
            ->select('kamar_inap.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien',DB::raw('concat(pasien.alamat,\', \',kelurahan.nm_kel,\', \',kecamatan.nm_kec,\', \',kabupaten.nm_kab) as alamat'),'reg_periksa.p_jawab','reg_periksa.hubunganpj','penjab.png_jawab',DB::raw('concat(kamar_inap.kd_kamar,\' \',bangsal.nm_bangsal) as kamar'),'kamar_inap.trf_kamar','kamar_inap.diagnosa_awal','kamar_inap.diagnosa_akhir','kamar_inap.tgl_masuk','kamar_inap.jam_masuk',DB::raw('if(kamar_inap.tgl_keluar=\'0000-00-00\',\'\',kamar_inap.tgl_keluar) as tgl_keluar'),DB::raw('if(kamar_inap.jam_keluar=\'00:00:00\',\'\',kamar_inap.jam_keluar) as jam_keluar'),'kamar_inap.ttl_biaya','kamar_inap.stts_pulang','kamar_inap.lama','dokter.nm_dokter','kamar_inap.kd_kamar','reg_periksa.kd_pj',DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),'reg_periksa.status_bayar','pasien.agama',
            'bangsal.nm_bangsal',
            DB::raw(
                'concat(uxui_tindakan_pasien.pemeriksaan,\'-\',uxui_tindakan_pasien.permintaan_lab,\'-\',uxui_tindakan_pasien.resep,\'-\',uxui_tindakan_pasien.resume) as tindakan_pasien'.
                (empty($params["dpjp_ranap.kd_dokter"]) ? ',concat(uxui_tindakan_pasien_perawat.pemeriksaan) as tindakan_pasien_perawat': '')))
            ->join('reg_periksa','kamar_inap.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            ->join('kelurahan','pasien.kd_kel','=','kelurahan.kd_kel')
            ->join('kecamatan','pasien.kd_kec','=','kecamatan.kd_kec')
            ->join('kabupaten','pasien.kd_kab','=','kabupaten.kd_kab')
            ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->join('dpjp_ranap', 'dpjp_ranap.no_rawat', '=', 'kamar_inap.no_rawat')
            ->leftJoin('uxui_tindakan_pasien', function ($join) {
                $join->on('uxui_tindakan_pasien.no_rawat', '=', 'reg_periksa.no_rawat');
                $join->on('uxui_tindakan_pasien.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis');
                $join->where('uxui_tindakan_pasien.type_akses', '=', 'ri');
            })
            ->orderBy('reg_periksa.no_rawat', 'ASC')
            ->groupBy('reg_periksa.no_rkm_medis','reg_periksa.no_rawat')
        ;
        if(empty($params['dpjp_ranap.kd_dokter'])){
            $query->leftJoin('uxui_tindakan_pasien_perawat', function ($join) {
                $join->on('uxui_tindakan_pasien_perawat.no_rawat', '=', 'reg_periksa.no_rawat');
                $join->on('uxui_tindakan_pasien_perawat.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis');
                $join->where('uxui_tindakan_pasien_perawat.type_akses', '=', 'ri');
            });
        }
        if($params){

            if(!empty($params['status'])){
                $query->where('reg_periksa.status_bayar','like','%' . $params['status'] . '%');
            }

            if(!empty($params['bangsal'])){
                $query->where('bangsal.kd_bangsal','=',$params['bangsal']);
            }

            if(!empty($params['tanggal'])){
                $data_tgl=$params['tanggal'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){

                    if($params['kondisi_waktu']==1){
                        $query->where('stts_pulang','=','-');
                    }elseif($params['kondisi_waktu']==2){
                        $query->whereBetween('kamar_inap.tgl_masuk', $data_tgl);
                    }else if($params['kondisi_waktu']==3){
                        $query->whereBetween('kamar_inap.tgl_keluar', $data_tgl);
                    }else{
                        $query->where(function ($qb2) use ($data_tgl) {
                            $qb2->whereBetween('kamar_inap.tgl_masuk', $data_tgl)
                                ->orWhereBetween('kamar_inap.tgl_keluar', $data_tgl)
                            ;
                        });
                    }

                }
            }

            foreach($params as $key =>$value){
                if($key!='search' and $key!='status' and $key!='bangsal' and $key!='tanggal' and $key!='kondisi_waktu'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('kamar_inap.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('kamar_inap.kd_kamar', 'LIKE', '%' . $search . '%')
                        ->orWhere('bangsal.nm_bangsal', 'LIKE', '%' . $search . '%')
                        ->orWhere('kamar_inap.diagnosa_awal', 'LIKE', '%' . $search . '%')
                        ->orWhere('kamar_inap.diagnosa_akhir', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('kamar_inap.stts_pulang', 'LIKE', '%' . $search . '%')
                        ->orWhere('kamar_inap.tgl_masuk', 'LIKE', '%' . $search . '%')
                        ->orWhere('kamar_inap.tgl_keluar', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.agama', 'LIKE', '%' . $search . '%')
                        ->orwhereRaw('concat(pasien.alamat,\', \',kelurahan.nm_kel,\', \',kecamatan.nm_kec,\', \',kabupaten.nm_kab) LIKE ? ', ['%' . $search . '%'])
                    ;
                });
            }
            
        }
        return $query;
    }

    public function getListRawatInap(array $filter)
    {
        $data = $this->kamarInap
            ->select(
                'kamar_inap.no_rawat',
                'reg_periksa.no_rkm_medis',
                'pasien.nm_pasien',
                DB::raw('concat(pasien.alamat,\', \',kelurahan.nm_kel,\', \',kecamatan.nm_kec,\', \',kabupaten.nm_kab) as alamat'),
                'reg_periksa.p_jawab',
                'reg_periksa.hubunganpj',
                'penjab.png_jawab',
                DB::raw('concat(kamar_inap.kd_kamar,\' \',bangsal.nm_bangsal) as kamar'),
                'kamar_inap.trf_kamar',
                'kamar_inap.diagnosa_awal',
                'kamar_inap.diagnosa_akhir',
                'kamar_inap.tgl_masuk',
                'kamar_inap.jam_masuk',
                DB::raw('kamar_inap.tgl_keluar as tgl_keluar'),
                DB::raw('kamar_inap.jam_keluar as jam_keluar'),
                'kamar_inap.ttl_biaya',
                'kamar_inap.stts_pulang',
                'kamar_inap.lama',
                'dokter.nm_dokter',
                'kamar_inap.kd_kamar',
                'reg_periksa.kd_pj',
                DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),
                'reg_periksa.status_bayar',
                'pasien.agama'
            )
            ->join('reg_periksa', 'kamar_inap.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('kamar', 'kamar_inap.kd_kamar', '=', 'kamar.kd_kamar')
            ->join('bangsal', 'kamar.kd_bangsal', '=', 'bangsal.kd_bangsal')
            ->join('kelurahan', 'pasien.kd_kel', '=', 'kelurahan.kd_kel')
            ->join('kecamatan', 'pasien.kd_kec', '=', 'kecamatan.kd_kec')
            ->join('kabupaten', 'pasien.kd_kab', '=', 'kabupaten.kd_kab')
            ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('penjab', 'reg_periksa.kd_pj', '=', 'penjab.kd_pj')

            ->join('dpjp_ranap', 'dpjp_ranap.no_rawat', '=', 'kamar_inap.no_rawat')

            ->when($filter['city'], function ($query, $filter) {
                $query->where('pasien.kd_kab', '=', $filter);
            })
            ->when($filter['room'], function ($query, $filter) {
                $query->where('bangsal.kd_bangsal', '=', $filter);
            })
            ->when($filter['status'], function ($query, $filter) {
                $query->where('reg_periksa.status_bayar', '=', $filter);
            })
            ->when([$filter['start'], $filter['end'],$filter['kondisi_waktu']], function ($query, $filter) {
                $text='kamar_inap.tgl_masuk';
                if($filter[2]==2){
                    $text='kamar_inap.tgl_keluar';
                }
                if ($filter[0] != null) {
                    // $query->whereBetween('reg_periksa.tgl_registrasi',  [$filter[0], $filter[1]]);
                    $query->whereBetween($text,  [$filter[0], $filter[1]]);
                }
            })
            ->when($filter['search'], function ($query, $filter) {
                $query->where(function ($qb2) use ($filter) {
                    $qb2->where('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter . '%')
                        ->orWhere('kamar_inap.no_rawat', 'LIKE', '%' . $filter . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $filter . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.stts', 'LIKE', '%' . $filter . '%');
                });
            });
            if(!empty($filter['kd_dokter'])){
                $data=$data->when($filter['kd_dokter'], function ($query, $filter) {
                    $query->where('dpjp_ranap.kd_dokter','=', $filter);
                });
            }
            $data->groupBy('kamar_inap.no_rawat');
            $data->groupBy('reg_periksa.no_rkm_medis');

        return $data;
    }

    /**
     * Get list register status
     *
     * @return Model
     * @throws conditon
     **/

    public function getListRegisterStatusBayar()
    {
        return $this->regPeriksa->getPossibleEnumValues("status_bayar");
    }
    /**
     * Get list city
     *
     * @return Model
     * @throws conditon
     **/
    public function getListCity()
    {
        return $this->city->get();
    }

    /**
     * Get list bangsal
     *
     * @return Model
     * @throws conditon
     **/
    public function getListBangsal()
    {            
        return $this->bangsal->get();
    }

    public function insertPemeriksaanRanap($data)
    {
        return PemeriksaanRanap::Create($data);
    }
}
