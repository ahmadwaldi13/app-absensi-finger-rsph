<?php

namespace App\Http\Traits;
use Illuminate\Support\Facades\Auth;

trait ItemPasienTraits {

    protected $type_akeses_arr=['rj','rp','ri'];
    protected $name_item_pasien='item_pasien_';
    protected $name_item_pasien_tgl='item_pasien_filter_tgl_';
    
    public function setItemPasien($data,$type_akses){
        $kode_item_pasien=json_encode($data);
        $name_sess=$this->name_item_pasien;
        if(!empty(in_array($type_akses,$this->type_akeses_arr))){
            $name_sess_type=$name_sess.$type_akses;
            if(\Session::has($name_sess_type)){
                (new \App\Http\Traits\GlobalFunction)->delete_session($name_sess_type);
            }
            $data['no_fr']=$type_akses;
            \Session::put($name_sess_type,(object)$data);
        }
    }

    public function setItemPasienFilterTgl($type_akses,$form_filter_start,$form_filter_end){
        $name_sess=$this->name_item_pasien_tgl;
        if(!empty(in_array($type_akses,$this->type_akeses_arr))){
            $name_sess_type=$name_sess.$type_akses;
            if(\Session::has($name_sess_type)){
                $data=\Session::get($name_sess_type);

                $filter_1=!empty($form_filter_start) ? $form_filter_start : '';
                $filter_2=!empty($filter_1) ? $filter_1 : $data->filter_start;
                $filter_start=!empty($filter_2) ? $filter_2 : date('Y-m-d');

                $filter_1=!empty($form_filter_end) ? $form_filter_end : '';
                $filter_2=!empty($filter_1) ? $filter_1 : $data->filter_end;
                $filter_end=!empty($filter_2) ? $filter_2 : date('Y-m-d');
                (new \App\Http\Traits\GlobalFunction)->delete_session($name_sess.$type_akses);
            }else{
                $filter_start=date('Y-m-d');
                $filter_end=date('Y-m-d');  
            }

            $data_sent=(object)[
                'filter_start'=>$filter_start,
                'filter_end'=>$filter_end
            ];

            \Session::put($name_sess_type,$data_sent);
            return $data_sent;
        }
    }

    public function getItemPasien($type_akses){

        $item=[];
        if(!empty(in_array($type_akses,$this->type_akeses_arr))){
            $name_sess_type=$this->name_item_pasien.$type_akses;
            if(\Session::has($name_sess_type)){
                $tmp=(array)\Session::get($name_sess_type);
                if(!empty($item)){
                    $item=array_merge($item,$tmp);
                }else{
                    $item=$tmp;
                }
            }

            $name_sess_type=$this->name_item_pasien_tgl.$type_akses;
            if(\Session::has($name_sess_type)){
                $tmp=(array)\Session::get($name_sess_type);
                if(!empty($item)){
                    $item=array_merge($item,$tmp);
                }else{
                    $item=$tmp;
                }
            }
        }

        if(!empty($item)){
            return (object)$item;
        }
        return '';
    }

    function cariRegistrasi($no_rawat)
    {
        $angka=0;

        $data_billing=\App\Models\Billing::where('no_rawat', '=', $no_rawat)->count('no_rawat');
        $data_reg_periksa=\App\Models\RegPeriksa::where('no_rawat', '=', $no_rawat)->where('stts','=','Batal')->count('no_rawat');
        $angka=$data_billing+$data_reg_periksa;
        return $angka;
    }
}

class ItemPasienFunction {
    use itemPasienTraits;
}

?>