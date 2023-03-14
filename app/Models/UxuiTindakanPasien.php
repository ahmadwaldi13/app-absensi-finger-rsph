<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UxuiTindakanPasien extends Model
{
    public $table = 'uxui_tindakan_pasien';
    public $timestamps = false;
    protected $primaryKey = ['no_rawat', 'no_rkm_medis'];
    public $incrementing = false;
    public $field_value=['pemeriksaan','permintaan_lab','resep','resume'];

    protected function setKeysForSaveQuery(\Illuminate\Database\Eloquent\Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    public function delete_data_kosong($type){
        $query=\DB::table($this->table);
        $query->where('type_akses',$type);
        foreach($this->field_value as $key => $value){
            $query=$query->where($value,'=',0);
        }
        return $query->delete();
    }
}
