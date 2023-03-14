<?php

namespace App\Services;

use App\Models\UxuiSOAPFarmasi;
use App\Models\Pegawai;

use App\Classes\ModulPDF;

use Illuminate\Support\Facades\DB;
use App\Services\GenerateBpjsService;

use App\Services\GlobalService;

use Resources\views\LayoutPdf\SOAPFarmasi\SOAPFarmasi;

class SOAPFarmasiService extends BaseService
{
    public function __construct(
    ) {
        $this->globalService = new GlobalService;
    }

    public function getDataSOAPRanap($params=[],$filter=[],$type=''){
        $query = UxuiSOAPFarmasi::
        select('uxui_soap_farmasi.id_soap_farmasi','uxui_soap_farmasi.no_rawat','uxui_soap_farmasi.subjek','uxui_soap_farmasi.objek','uxui_soap_farmasi.assessment','plan','jns_rawat','bangsal.nm_bangsal','pegawai.nama','pegawai.nik','reg_periksa.no_rkm_medis','pasien.nm_pasien','dokter.nm_dokter','uxui_soap_farmasi.created_at')    
            ->join('pegawai','pegawai.nik','=','uxui_soap_farmasi.nik')
            ->join('reg_periksa','reg_periksa.no_rawat','=','uxui_soap_farmasi.no_rawat')
            ->join('pasien','pasien.no_rkm_medis','=','reg_periksa.no_rkm_medis')
            ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')

            ->join('kamar_inap','reg_periksa.no_rawat','=','kamar_inap.no_rawat')
            ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            


        ->when($filter['bansal'], function ($query, $filter) {
            $query->where('bangsal.kd_bangsal', '=', $filter);
        })
        ->when($filter['search'], function ($query, $filter) {
            $query->where(function ($qb2) use ($filter) {
                $qb2
                    ->Where('dokter.kd_dokter', 'LIKE', '%' . $filter . '%')
                    ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter . '%')
                    ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $filter . '%')
                    ->orWhere('reg_periksa.no_rawat', 'LIKE', '%' . $filter . '%');
            });
        })
        ->orderBy('uxui_soap_farmasi.created_at','DESC');
        
        $list_search=[
            'where_or'=>['pegawai.nik'],
        ];

        // dd($filter);
        if(!empty($filter['tanggal'])){
            $data_tgl=$filter['tanggal'];
            if(!empty($data_tgl[0]) && !empty($data_tgl[1])){

                if($filter['kondisi_waktu']==1){
                    $query->where('kamar_inap.stts_pulang','=','-');
                }elseif($filter['kondisi_waktu']==2){
                    $query->whereBetween('kamar_inap.tgl_masuk', $data_tgl);
                }else if($filter['kondisi_waktu']==3){
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

        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }

        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

    public function getPJSOAPFarmasi($nik){
        return Pegawai::select('nama','nik')->where('nik',$nik)->first();
    }

    public function getPDFData($noRw, $noRm, $fr){
        $paramater=[
            'uxui_soap_farmasi.no_rawat'=> $noRw,
            'uxui_soap_farmasi.jns_rawat'=>  $fr
        ];

        $dataSoap = $this->getDataSOAPRanap($paramater,null,1)->get();
        
        $dataPasien = $this->globalService->getDataPasien($noRm);
        $data = [
            "berkas_list" => $this->getDataSOAPRanap($paramater,null),
            "no_rawat" => $noRw,
            "dataPasien" => $dataPasien,
            "settings" => $this->globalService->getSettingsKhanza(),
            'dataSoap' => $dataSoap,
            'PJSOAPFarmasi' => $this->getPJSOAPFarmasi(getenv('PJ_SOAP_FARMASI'))
        ];
        return $data;
    }

    public function createPdfFile($filename, $pdfData, $optional_download, $file_format){
        $pdf = new ModulPDF();

        SOAPFarmasi::addPDF($pdf, $pdfData);

        return $pdf->Output(public_path($filename), $file_format);

    } 

}
