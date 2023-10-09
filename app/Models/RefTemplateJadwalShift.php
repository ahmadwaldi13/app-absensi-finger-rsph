<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefTemplateJadwalShift extends \App\Models\MyModel
{
    public $table = 'ref_template_jadwal_shift';
    public $timestamps = false;

    function list_type_periode($id=null){
        $data=[1=>"Hari",2=>"Minggu",3=>'Bulan'];
        if(!empty($id)){
            return !empty($data[$id]) ? $data[$id] : '';
        }
        return $data;
    }

    function list_type_periode_system($id=null){
        $data=[1=>"day",2=>"week",3=>'month'];
        if(!empty($id)){
            return !empty($data[$id]) ? $data[$id] : '';
        }
        return $data;
    }
}
