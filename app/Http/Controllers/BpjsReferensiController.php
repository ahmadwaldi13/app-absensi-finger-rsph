<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Vclaim\BridgeVclaimService;
use App\Services\Antrol\BridgeAntrolService;
use App\Services\BpjsService;

class BpjsReferensiController extends Controller
{
    public function __construct()
    {
        $this->bridgeVclaim = new BridgeVclaimService;
        $this->bridgeAntrol = new BridgeAntrolService;
        $this->bpjsService = new BpjsService;
    }

    public function jadwalHfis(Request $request)
    {
        $kode = !empty($request->poli) ? $request->poli : '';

        $endpoint = 'referensi/poli/'. $kode;

        $data_tmp_tmp = $this->bridgeVclaim->getRequest($endpoint);
        $response = json_decode($data_tmp_tmp, true);
        $convert = $response['response'];
        $hasil = $convert['poli'];
    
        return response()->json($hasil,200);
    }

    public function actionNoka(Request $request)
    {
        $noKartu = $request->noKartu;
        if (empty($noKartu)) {
            $fail['metadata'] = ['code' => '401', 'message' => 'Data No kartu harus diisi dengan benar, jangan malas yaa'];
            return response()->json($fail);
        }
        $tanggal = date('Y-m-d');
        $endpoint = "Peserta/nokartu/{$noKartu}/tglSEP/{$tanggal}";
        $data_tmp = $this->bridgeVclaim->getRequest($endpoint);
        $response = json_decode($data_tmp, true);
        if (empty($response)) {
            $fail['metadata'] = ['code' => '1', 'message' => 'Server BPJS lagi Error'];
            return response()->json($fail);
        }
        $convert = $response['response'];
        $data['metadata']  = $response['metaData'];
        $data['peserta']   = $convert['peserta'];

        return response()->json($data,200);
    }

    public function actionNik(Request $request)
    {
        $nik = $request->nik;
        if (empty($nik)) {
            $fail['metadata'] = ['code' => '401', 'message' => 'Data NIK harus diisi dengan benar, jangan malas yaa'];
            return response()->json($fail);
        }
        $tanggal = date('Y-m-d');
        $endpoint = "Peserta/nik/{$nik}/tglSEP/{$tanggal}";
        $data_tmp = $this->bridgeVclaim->getRequest($endpoint);
        $response = json_decode($data_tmp, true);
        $convert = $response['response'];
        $data['metadata']  = $response['metaData'];
        $data['peserta']   = $convert['peserta'];

        return response()->json($data,200);
    }

    public function actionRujukan(Request $request)
    {
        $noKartu = $request->noka;
        $endpoint = "Rujukan/List/Peserta/{$noKartu}";
        $data_tmp_tmp = $this->bridgeVclaim->getRequest($endpoint);
        $response = json_decode($data_tmp_tmp, true);
        $convert = $response['response'];
        $hasil = $convert['rujukan'];

        return response()->json($hasil,200);
    }

    public function actionRujukanRs(Request $request)
    {
        $noKartu = $request->noka;
        $endpoint = "Rujukan/RS/List/Peserta/{$noKartu}";
        $data_tmp_tmp = $this->bridgeVclaim->getRequest($endpoint);
        $response = json_decode($data_tmp_tmp, true);
        $convert = $response['response'];
        $hasil = $convert['rujukan'];

        return response()->json($hasil,200);
    }

    public function actionCekSuratKontrol(Request $request)
    {
        $tglAwal = $request->tgl_sep;
        $tglAkhir = $request->tgl_sep;
        $filter = '2';
        $endpoint = "RencanaKontrol/ListRencanaKontrol/tglAwal/{$tglAwal}/tglAkhir/{$tglAkhir}/filter/{$filter}";
        $data_tmp_tmp = $this->bridgeVclaim->getRequest($endpoint);
        $response = json_decode($data_tmp_tmp, true);
        $convert = $response['response'];
        $hasil = $convert['list'];

        return response()->json($hasil,200);
    }

    public function actionPoliLocal(Request $request){
        $poliklinik = $request->jkn_kodepolili;
        $data  = $this->bpjsService->referensi_poliklinik($poliklinik);
       
        return response()->json($data,200);
    }

    public function actionHfis(Request $request)
    {
        $fields = $request->all();
        $exp = explode('@',$fields['poli']);
        $kd_poli = !empty($exp[0]) ? $exp[0] : 0;
        $tanggal = date('Y-m-d');
        $endpoint = "jadwaldokter/kodepoli/{$kd_poli}/tanggal/{$tanggal}";
        $data_tmp_tmp = $this->bridgeAntrol->getRequest($endpoint);
        $response = json_decode($data_tmp_tmp, true);
        $convert = $response['response'];

        return response()->json($convert,200);

    }
}
