<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

use App\Models\PermintaanLabPA;
use App\Models\PermintaanLab;
use App\Models\PermintaanRadiologi;
use App\Models\ResepObat;

use App\Services\RawatJalanService;
use App\Services\ResepService;
use App\Services\GlobalService;
use App\Services\PatologiKlinisService;
use App\Services\PatologiAnatomiService;
use App\Services\PemeriksaanRadiologiService;
use App\Services\JadwalOperasiService;
use App\Services\RacikObatService;
use App\Services\LaporanOperasiPasienService;
use App\Services\BpjsService;



class RawatJalanController extends Controller
{
    protected $rawatJalanService;
    protected $globalService;
    protected $resepService;
    protected $permintaanLabPA;
    protected $permintaanLab;
    protected $permintaanRadiologi;
    protected $patologiKlinisService;
    protected $patologiAnatomiService;
    protected $pemeriksaanRadiologiService;
    protected $jadwalOperasiService;
    protected $RacikObatService;
    public function __construct(
        RawatJalanService $rawatJalanService,
        GlobalService $globalService,
        ResepService $resepService,
        PermintaanLabPA $permintaanLabPA,
        PermintaanLab $permintaanLab,
        PermintaanRadiologi $permintaanRadiologi,
        PatologiKlinisService $patologiKlinisService,
        PatologiAnatomiService $patologiAnatomiService,
        PemeriksaanRadiologiService $pemeriksaanRadiologiService,
        JadwalOperasiService $jadwalOperasiService,
        RacikObatService $racikObatService,
        LaporanOperasiPasienService $laporanOperasiPasienService
    ) {
        $this->rawatJalanService = $rawatJalanService;
        $this->globalService = $globalService;
        $this->resepService = $resepService;
        $this->permintaanLabPA = $permintaanLabPA;
        $this->permintaanLab = $permintaanLab;
        $this->permintaanRadiologi = $permintaanRadiologi;
        $this->patologiKlinisService = $patologiKlinisService;
        $this->patologiAnatomiService = $patologiAnatomiService;
        $this->pemeriksaanRadiologiService = $pemeriksaanRadiologiService;
        $this->jadwalOperasiService = $jadwalOperasiService;
        $this->racikObatService = $racikObatService;
        $this->laporanOperasiPasienService = $laporanOperasiPasienService;
        $this->bpjsService = new BpjsService;
    }

    function index(Request $request)
    {
        $filter = [
            'city' => '',
            'poli' => $request->poli,
            'status' => $request->status,
            'start' => $request->start,
            'end' => $request->end,
            'per_page' => intval($request->per_page),
            'search' => $request->search,
        ];

        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

        if($get_user->type_user=='dokter'){
            $filter['kd_dokter']=$get_user->id_user;
            
            $norawat_operasi=$this->laporanOperasiPasienService->getLaporanOperasiCheckByDoketer($get_user->id_user,[$request->start,$request->end]);
        }

        $rawatJalans = $this->rawatJalanService->getListRawatJalan($filter)
            ->paginate($filter['per_page'] ? 10 : $filter['per_page']);

        $poliKliniks =  $this->rawatJalanService->getListPoliklinik()->where('status','1')->get();
        $regStatuses = $this->rawatJalanService->getListRegisterStatus();

        // (new \App\Http\Traits\GlobalFunction)->delete_session(['item_pasien_rj','item_pasien_filter_tgl_rj']);
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
        $tindakan_pasien_model = $get_user->type_user=='dokter' ?  new \App\Models\UxuiTindakanPasien : new \App\Models\UxuiTindakanPasienPerawat;
        $tindakan_pasien_model->delete_data_kosong('rj');

        $parameter_view=[
            'rawatJalans' => $rawatJalans,
            'poliKliniks' => $poliKliniks,
            'statuses' => $regStatuses,
            'norawat_operasi'=>!empty($norawat_operasi) ? $norawat_operasi : null,
            'perPage' => $filter['per_page'],
        ];

        return view('rawat-jalan/index',$parameter_view);
    }

    function noResep(Request $request)
    {

        return $this->sendSuccess($this->rawatJalanService->getNoResep($request->tgl), "Success");
    }

    function filter_jadwal_operasi($fields, $fieldsOld = [])
    {
        $error_message = '';

        if (empty($fields['no_rawat']) or empty($fields['tanggal']) or empty($fields['kd_kamar_operasi']) or empty($fields['jam_mulai']) or empty($fields['status'])) {
            return $error_message = 'Maaf ada form inputan belum terisi';
        }

        $av_status = [strtolower('Menunggu'), strtolower('Proses Operasi')];
        if (in_array(strtolower($fields['status']), $av_status)) {

            if ($fieldsOld) {

                $jam_new = $fields['jam_mulai'];
                $jam_new_val = strtotime($jam_new);
                if ($jam_new_val == false) {
                    return $error_message = 'Format waktu tidak valid';
                }

                $tgl_new = $fields['tanggal'];
                $tgl_new = explode('-', $tgl_new);
                if (count($tgl_new) >= 3) {
                    $tgl_new = trim($tgl_new[0]) . '/' . trim($tgl_new[1]) . '/' . trim($tgl_new[2]) . ' ' . $jam_new;
                } else {
                    $tgl_new = false;
                }
                $tgl_new_val = strtotime($tgl_new);
                if ($tgl_new_val == false) {
                    return $error_message = 'Format tanggal tidak valid';
                }


                $jam_old = $fieldsOld['jam_mulai'];
                $jam_old_val = strtotime($jam_old);
                if ($jam_old_val == false) {
                    return $error_message = 'Format waktu tidak valid';
                }

                $tgl_old = $fieldsOld['tanggal'];
                $tgl_old = explode('-', $tgl_old);
                if (count($tgl_old) >= 3) {
                    $tgl_old = trim($tgl_old[0]) . '/' . trim($tgl_old[1]) . '/' . trim($tgl_old[2]) . ' ' . $jam_old;
                } else {
                    $tgl_old = false;
                }
                $tgl_old_val = strtotime($tgl_old);
                if ($tgl_old_val == false) {
                    return $error_message = 'Format tanggal tidak valid';
                }

                if ($tgl_old_val == $tgl_new_val) {
                    return null;
                }
            }

            $jam_input = $fields['jam_mulai'];
            $jam_input_val = strtotime($jam_input);
            if ($jam_input_val == false) {
                return $error_message = 'Format waktu tidak valid';
            }

            $tgl_input = $fields['tanggal'];
            $tgl_input = explode('-', $tgl_input);
            if (count($tgl_input) >= 3) {
                $tgl_input = trim($tgl_input[0]) . '/' . trim($tgl_input[1]) . '/' . trim($tgl_input[2]) . ' ' . $jam_input;
            } else {
                $tgl_input = false;
            }
            $tgl_input_val = strtotime($tgl_input);
            if ($tgl_input_val == false) {
                return $error_message = 'Format tanggal tidak valid';
            }
            $tgl_now = date('Y/m/d H:i:s');
            $tgl_now_val = strtotime($tgl_now);

            if ($tgl_input_val < $tgl_now_val) {
                return $error_message = 'Maaf tanggal dan waktu yang anda pilih, harus lebih besar dari tanggal saat ini';
            }
        }
    }

    private function prosesCreate($request)
    {
        $req=$request->all();
        $kode=!empty($req['key_old']) ? $req['key_old'] : '';
        DB::beginTransaction();
        $pesan=[];
        $link_back_param=[];
        $message_default=[
            'success'=>!empty($kode) ? 'Data berhasil diubah' : 'Data berhasil dipanggil',
            'error'=>!empty($kode) ? 'Data tidak berhasil diubah' : 'Data tidak berhasil dipanggil'
        ];
        try {
            $model = (new \App\Models\UxuiPanggilMonitorPoli)->where('no_rawat', '=', $kode)->first();
            if(empty($model)){
                $model=(new \App\Models\UxuiPanggilMonitorPoli);
            }
            $data_save=$req;
            $data_save['no_rawat'] = $data_save['no_rawat'];
            $data_save['no_reg'] = $data_save['no_reg'];
            $data_save['nm_pasien'] = $data_save['nm_pasien'];
            $data_save['poli'] = $data_save['nm_poli'];
            $data_save['tanggal'] = $data_save['tgl_registrasi'];
            $model->set_model_with_data($data_save);
            
            $is_save=0;
            
            if($model->save()){
                $is_save=1; 
            }

            $tindakan_pasien_model = new \App\Models\UxuiTindakanPasienPerawat;
                $model_tindakan=$tindakan_pasien_model::where('no_rawat', $data_save['no_rawat'])
                ->where('no_rkm_medis', $data_save['no_rkm_medis'])
                ->where('type_akses', 'rj')
                ->first();

                if(empty($model_tindakan)){
                    $model_tindakan=$tindakan_pasien_model;
                    $model_tindakan->no_rawat=$data_save['no_rawat'];
                    $model_tindakan->no_rkm_medis=$data_save['no_rkm_medis'];
                    $model_tindakan->type_akses='rj';
                }
                $model_tindakan->pemeriksaan=1;

                if($model_tindakan->save()){
                    $is_save=1;
                }
            if($is_save){
                DB::commit();
                $pesan=['success',$message_default['success'],2];
            }else{
                DB::rollBack();
                $pesan=['error',$message_default['error'],3];
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                
            }
            $pesan=['error',$message_default['error'],3];
        
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }

        return redirect()->back()->with([$pesan[0]=>$pesan[1]]);
    }

    private function prosesDelete($request)
    {
        DB::beginTransaction();
        $pesan=[];
        $link_back_param=[];
        $message_default=[
            'success'=>'Pasien sudah dibisukan',
            'error'=>'Maaf data tidak berhasil dibisukan'
        ];
        
        $kode = !empty($request->no_rawat) ? $request->no_rawat : null;
        try {
            $model = (new \App\Models\UxuiPanggilMonitorPoli)->where('no_rawat', '=', $kode)->first();
            if(empty($model)){
                return redirect()->route($this->url_name, $link_back_param)->with(['error','Data tidak ditemukan']);
            }

            $is_save=0;
            
            $tindakan_pasien_model = new \App\Models\UxuiTindakanPasienPerawat;
            $model_tindakan=$tindakan_pasien_model::where('no_rawat', '=' ,$kode)
            ->where('type_akses', 'rj')
            ->first();
            $model_tindakan->pemeriksaan=0;

            if($model_tindakan->save()){
                $is_save=1;
            }

            $action_beforebb=$this->bpjsService->actionBeforeTaskId($kode,4);
            if($action_beforebb){
                if($action_beforebb[0]=='success'){
                    $is_save=1;
                }
            }

            $hasil=$this->bpjsService->taskId($kode,4);
            if($hasil){
                if($hasil){
                    $is_save=1;
                }
            }

            if($model->delete()){
                $is_save=1;
            }

            if($is_save){
                DB::commit();
                $pesan=['success',$message_default['success'],2];
            }else{
                DB::rollBack();
                $pesan=['error',$message_default['error'],3];
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                
            }
            $pesan=['error',$message_default['error'],3];
        
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }

        return redirect()->back()->with([$pesan[0]=>$pesan[1]]);
    }

    public function actionPanggilMute(Request $request)
    {
        if($request->tindakan_pasien_perawat==1){
            return $this->prosesDelete($request);
        }
        else {
            return $this->prosesCreate($request);
        }
    }

}
class TemplateLab
{
    public $pemeriksaanName;
    public $template;
}