<?php

namespace App\Services\UserManagement;

use Illuminate\Support\Facades\DB;

use App\Models\UserManagement\UxuiAuthGroup;
use App\Models\UserManagement\UxuiAuthRoutes;
use App\Models\UserManagement\UxuiAuthPermission;
use Illuminate\Support\Str;

class UserGroupAppService extends \App\Services\BaseService
{
    public function __construct(
        UxuiAuthGroup $uxuiAuthGroup,
        UxuiAuthRoutes $uxuiAuthRoutes,
        UxuiAuthPermission $uxuiAuthPermission
    ) {
        $this->uxuiAuthGroup = $uxuiAuthGroup;
        $this->uxuiAuthRoutes = $uxuiAuthRoutes;
        $this->uxuiAuthPermission = $uxuiAuthPermission;
    }

    function getUxuiAuthGroup($params = null)
    {
        $query = $this->uxuiAuthGroup->orderBy('id', 'DESC');

        if ($params) {
            foreach ($params as $key => $value) {

                if ($key != 'search') {
                    $type = is_numeric($value) ? '=' : 'like';
                    $query = $query->where($key, $type, $value);
                }
            }

            if (!empty($params['search'])) {
                $search = $params['search'];
                $query = $query->where(function ($qb2) use ($search) {
                    $qb2->where('name', 'LIKE', '%' . $search . '%')
                        ->where('alias', 'LIKE', '%' . $search . '%')
                        ->where('keterangan', 'LIKE', '%' . $search . '%');
                });
            }
        }
        return $query->get();
    }

    public function insertAuthGroup($data)
    {
        foreach ($data as $key => $field) {
            $field == null ? $data[$key] = "" : "";
        }
        return $this->uxuiAuthGroup->insert($data);
    }

    function updateAuthGroup($params, $set, $type = '')
    {
        
        $query = $this->uxuiAuthGroup;
        foreach ($params as $key => $value) {
            if ($type == 'raw') {
                $query = $query->whereRaw($key . ' = ? ', [$value]);
            } else {
                $query = $query->where($key, '=', $value);
            }
        }
        return $query->update($set);
    }

    function deleteAuthGroup($params, $type = '')
    {
        $query = $this->uxuiAuthGroup;
        foreach ($params as $key => $value) {
            if ($type == 'raw') {
                $query = $query->whereRaw($key . ' = ? ', [$value]);
            } else {
                $query = $query->where($key, '=', $value);
            }
        }
        return $query->delete();
    }

    public function getAllRouters()
    {
        return $this->uxuiAuthRoutes
            ->select(
                DB::raw(
                    "title, 
                            GROUP_CONCAT(url order by id separator ',') as urls,
                            GROUP_CONCAT(`type` order by id separator ',') as types,
                            GROUP_CONCAT(id order by id separator ',') as type_ids
                            "
                )
            )
            ->groupBy("title")
            ->orderBy('id')
            ->get();
    }

    public function getAllUserGroupAccess(string $alias)
    {
        $uar = $this->uxuiAuthRoutes->table;
        $uap = $this->uxuiAuthPermission->table;

        return $this->uxuiAuthPermission
            ->select($uar . ".id")
            ->join($uar, $uap . ".url", "=", $uar . ".url")
            ->where($uap . ".alias_group", "=", $alias)
            ->get()
            ->toArray();
    }
}