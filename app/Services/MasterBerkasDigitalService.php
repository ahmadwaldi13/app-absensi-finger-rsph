<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\MasterBerkasDigital;

class MasterBerkasDigitalService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->masterBerkasDigital = new MasterBerkasDigital;
    }

    function getList($params = [], $type = '')
    {

        $query = $this->masterBerkasDigital
            ->select('master_berkas_digital.*', 'prefix', 'type')
            ->join('uxui_berkas_jenis', 'master_berkas_digital.kode', '=', 'uxui_berkas_jenis.kode')
            ->orderBy('master_berkas_digital.kode', 'ASC');
        $list_search = [
            'where_or' => ['master_berkas_digital.kode', 'master_berkas_digital.nama'],
        ];

        if ($params) {
            $query = (new \App\Models\MyModel)->set_where($query, $params, $list_search);
        }
        if (empty($type)) {
            return $query->get();
        } else {
            return $query;
        }
    }
}