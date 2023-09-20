<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefJenisJadwal extends \App\Models\MyModel
{
    public $table = 'ref_jenis_jadwal';
    public $timestamps = false;
    public $incrementing = true;

    function type_jenis_jadwal($id=null){
        $data=[1=>"Rutin",2=>"Shift"];
        if(!empty($id)){
            return !empty($data[$id]) ? $data[$id] : '';
        }
        return $data;
    }
}
