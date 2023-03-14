<?php

namespace App\Services;

use App\Models\DiagnosaPasien;
use App\Models\ResepObat;
use App\Models\UxuiPasienSitb;
use App\Models\Pasien;

use Illuminate\Support\Facades\DB;
use App\Services\GenerateBpjsService;

class TBService extends BaseService
{
    function getPasienTB($params=null)
    {
        // ->selectRaw('max(reg_periksa.no_rawat) as last_no_rawat')
       
        $query = DiagnosaPasien::
        select('reg_periksa.no_rawat','pasien.no_rkm_medis','diagnosa_pasien.kd_penyakit','pasien.no_ktp as NIK',
        'pasien.jk as jenis_kelamin','pasien.alamat as alamat_lengkap','pasien.kd_prop as id_propinsi_pasien',
        'pasien.kd_kab as kd_kabupaten_pasien','diagnosa_pasien.kd_penyakit as kode_icd_x', 'pasien.tgl_lahir',
         'diagnosa_pasien.status_penyakit' )
        
        ->where(function($query) {
                $penyakit =['A15','A15.0','A15.1','A15.2','A15.3','A15.4','A15.5','A15.6','A15.7','A15.8','A15.9',
                    'A16','A16.0','A16.2','A16.3','A16.4','A16.5','A16.6','A16.7','A16.8','A16.9','A17+','A17.0+',
                    'A17.1+','A17.8+','A17.9+','A18','A18.0+','A18.1+','A18.2','A18.3','A18.4','A18.5+','A18.6+','A18.7+',
                    'A18.8+','A19','A19.0','A19.1','A19.2','A19.8','A19.9'
                ];
                foreach($penyakit  as $key => $value){
                    $query->orWhere('diagnosa_pasien.kd_penyakit','like',  $value);
                }
                // ->orWhere('diagnosa_pasien.kd_penyakit','like', "A15%")
                // ->orWhere('diagnosa_pasien.kd_penyakit','like', "A16%")
                // ->orWhere('diagnosa_pasien.kd_penyakit','like', "A17%")
                // ->orWhere('diagnosa_pasien.kd_penyakit','like', "A18%")
                // ->orWhere('diagnosa_pasien.kd_penyakit','like', "A19%");
        })
        ->Where(function($query) {
            $query
                ->orWhere('diagnosa_pasien.no_rawat', 'like', '2022%')
                ->orWhere('diagnosa_pasien.no_rawat', 'like', '2023%');
        })
        ->join('reg_periksa', 'reg_periksa.no_rawat', '=', 'diagnosa_pasien.no_rawat')
        ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')

        // ->from(DB::raw('(SELECT * FROM reg_periksa ORDER BY no_rawat DESC) t'))
        // ->groupBy('t.no_rawat')
        ;
        

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }
        
        
        $query->orderBy('pasien.no_rkm_medis','DESC');
        $query->orderBy('reg_periksa.no_rawat','DESC');
        // $query->groupBy('pasien.no_rkm_medis');
        
        return $query;
    }


    function getObatPasienTB($params=null){
        $query = ResepObat::select('databarang.nama_brng')
        ->join('resep_dokter', 'resep_dokter.no_resep', '=', 'resep_obat.no_resep')
        ->join('databarang', 'databarang.kode_brng', '=', 'resep_dokter.kode_brng');
        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }
        return $query->get();
    }

    function sendDataSITB($send_json){
        try {
            $data_curl=[
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => getenv('SITB_URL'),
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($send_json),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER =>[ 
                    "Content-Type: Application/x-www-form-urlencoded",
                    "X-rs-id:".getenv('X_RS_ID'),
                    "X-pass: ".getenv('X_PASS'),
                    "X-Timestamp: ".GenerateBpjsService::bpjsTimestamp(),
                ],
            ];

            $curl = curl_init();
            curl_setopt_array($curl,$data_curl);
            $response = curl_exec($curl);
            $err      = curl_error($curl);
            curl_close($curl);

            $hasil_respon = json_decode($response, true);
            // $hasil_respon=!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : [];

            $pesan = $hasil_respon;
        }catch (\Throwable $e) {
            // $message=implode('|',$e->errorInfo);
            $pesan=$e;
        }  

        return $pesan;
    }

    function setDataSaveSITB($value, $dataInp, $dataobat=null, $id_tb_03=null,$tujuan=false){
        $data_save=[
            'id_tb_03'=>$id_tb_03,
            'kd_pasien'=>'TESTING',
            'nik'=>$value->NIK,
            'jenis_kelamin'=>$value->jenis_kelamin,
            'alamat_lengkap'=>$value->alamat_lengkap,
            'id_propinsi_faskes'=>'11',
            'kd_kabupaten_faskes'=>'1110',
            'id_propinsi_pasien'=>$value->id_propinsi_pasien,
            'kd_kabupaten_pasien'=>$value->kd_kabupaten_pasien,
            'kd_fasyankes'=>'1110075',
            'kode_icd_x'=>$dataInp->kode_icd_x?$dataInp->kode_icd_x:($value->kode_icd_x?$value->kode_icd_x:''),
            'tipe_diagnosis'=> $dataInp->tipe_diagnosis?$dataInp->tipe_diagnosis:($value->tipe_diagnosis?$value->tipe_diagnosis:''),
            'klasifikasi_lokasi_anatomi'=>$dataInp->klasifikasi_lokasi_anatomi?$dataInp->klasifikasi_lokasi_anatomi:($value->klasifikasi_lokasi_anatomi?$value->klasifikasi_lokasi_anatomi:''),
            'klasifikasi_riwayat_pengobatan'=>$dataInp->klasifikasi_riwayat_pengobatan?$dataInp->klasifikasi_riwayat_pengobatan:($value->klasifikasi_riwayat_pengobatan?$value->klasifikasi_riwayat_pengobatan:''),
            
            'paduan_oat'=> '',
            'sebelum_pengobatan_hasil_mikroskopis'=>$dataInp->sebelum_pengobatan_hasil_mikroskopis?$dataInp->sebelum_pengobatan_hasil_mikroskopis:($value->sebelum_pengobatan_hasil_mikroskopis?$value->sebelum_pengobatan_hasil_mikroskopis:''),
            'sebelum_pengobatan_hasil_tes_cepat'=>$dataInp->sebelum_pengobatan_hasil_tes_cepat?$dataInp->sebelum_pengobatan_hasil_tes_cepat:($value->sebelum_pengobatan_hasil_tes_cepat?$value->sebelum_pengobatan_hasil_tes_cepat:''),
            'sebelum_pengobatan_hasil_biakan'=>$dataInp->sebelum_pengobatan_hasil_biakan?$dataInp->sebelum_pengobatan_hasil_biakan:($value->sebelum_pengobatan_hasil_biakan?$value->sebelum_pengobatan_hasil_biakan:''),
            'hasil_mikroskopis_bulan_2'=>$dataInp->hasil_mikroskopis_bulan_2?$dataInp->hasil_mikroskopis_bulan_2:($value->hasil_mikroskopis_bulan_2?$value->hasil_mikroskopis_bulan_2:''),
            'hasil_mikroskopis_bulan_3'=>$dataInp->hasil_mikroskopis_bulan_3?$dataInp->hasil_mikroskopis_bulan_3:($value->hasil_mikroskopis_bulan_3?$value->hasil_mikroskopis_bulan_3:''),
            'hasil_mikroskopis_bulan_5'=>$dataInp->hasil_mikroskopis_bulan_5?$dataInp->hasil_mikroskopis_bulan_5:($value->hasil_mikroskopis_bulan_5?$value->hasil_mikroskopis_bulan_5:''),
            'akhir_pengobatan_hasil_mikroskopis'=>$dataInp->akhir_pengobatan_hasil_mikroskopis?$dataInp->akhir_pengobatan_hasil_mikroskopis:($value->akhir_pengobatan_hasil_mikroskopis?$value->akhir_pengobatan_hasil_mikroskopis:''),

            'hasil_akhir_pengobatan'=>$dataInp->hasil_akhir_pengobatan?$dataInp->hasil_akhir_pengobatan:($value->hasil_akhir_pengobatan?$value->hasil_akhir_pengobatan:''),
            // 'foto_toraks'=>$value->tgl_lahir,
        ];

        if($tujuan){
            $data_save['tanggal_mulai_pengobatan']=preg_replace("/[-]/", "", $value->tanggal_mulai_pengobatan?$value->tanggal_mulai_pengobatan:$dataInp->tanggal_mulai_pengobatan);
            $tanggal_hasil_akhir_pengobatan = '';
            if($dataInp->tanggal_hasil_akhir_pengobatan){
                $tanggal_hasil_akhir_pengobatan = $dataInp->tanggal_hasil_akhir_pengobatan;
            }elseif($value->tanggal_hasil_akhir_pengobatan && $value->tanggal_hasil_akhir_pengobatan!=null){
                $tanggal_hasil_akhir_pengobatan = $dataInp->tanggal_hasil_akhir_pengobatan;
            }else{
                $tanggal_hasil_akhir_pengobatan = '';
            }
            $data_save['tanggal_hasil_akhir_pengobatan']=preg_replace("/[-]/", "", $tanggal_hasil_akhir_pengobatan);
            $data_save['tgl_lahir']=preg_replace("/[-]/", "", $value->tgl_lahir);
        }else{
            $data_save['no_rkm_medis'] = $value->no_rkm_medis;
            $data_save['tanggal_mulai_pengobatan']= $value->tanggal_mulai_pengobatan?$value->tanggal_mulai_pengobatan:$dataInp->tanggal_mulai_pengobatan;
            $data_save['tanggal_hasil_akhir_pengobatan']=$dataInp->tanggal_hasil_akhir_pengobatan?$dataInp->tanggal_hasil_akhir_pengobatan:($value->tanggal_hasil_akhir_pengobatan?$value->tanggal_hasil_akhir_pengobatan:null);
            $data_save['tgl_lahir']=$value->tgl_lahir;
            $data_save['nip']=$dataInp->nip;
        }
        return $data_save;
    }


    public function checkPasienTB($params, $type=''){
        $query = UxuiPasienSitb::select('uxui_pasien_sitb.*','penyakit.nm_penyakit','pasien.no_ktp as NIK','pasien.nm_pasien',
            'pasien.jk as jenis_kelamin','pasien.alamat as alamat_lengkap','pasien.kd_prop as id_propinsi_pasien',
            'pasien.kd_kab as kd_kabupaten_pasien', 'pasien.tgl_lahir', 'pegawai.nama as penginput'
        )
        ->selectRaw('IF(uxui_pasien_sitb.tanggal_hasil_akhir_pengobatan IS NULL, "BEROBAT", "SELESAI") as status')
        ->join('penyakit', 'penyakit.kd_penyakit','=','uxui_pasien_sitb.kode_icd_x')
        ->join('pasien','uxui_pasien_sitb.no_rkm_medis', '=', 'pasien.no_rkm_medis')
        ->join('pegawai', 'uxui_pasien_sitb.nip', '=', 'pegawai.nik')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }
        $query->orderBy('uxui_pasien_sitb.id_tb_03', 'DESC');
        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

    public function checkPasien($params, $type=''){
        $query = 

        $query = Pasien::select('pasien.no_ktp as NIK', 'pasien.no_rkm_medis',
            'pasien.jk as jenis_kelamin','pasien.alamat as alamat_lengkap','pasien.kd_prop as id_propinsi_pasien',
            'pasien.kd_prop as id_propinsi_pasien','pasien.kd_kab as kd_kabupaten_pasien', 'pasien.kd_kab as kd_kabupaten_pasien','pasien.tgl_lahir'
        );

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }

        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

}
