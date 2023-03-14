<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Dokter;
use App\Models\Petugas;
use App\User;
use App\Models\UxuiUsers;

class AuthService extends BaseService
{
    protected $user;
    protected $uxui_users;

    public function __construct(User $user,UxuiUsers $uxui_users)
    {
        $this->user = $user;
        $this->uxui_users = $uxui_users;
    }

    public function getUserByCredential(string $idUser, string $password)
    {

        $check_user=0;
        $type_user='';
        $nm_user='';

        $user = $this->user
            ->whereRaw("id_user = AES_ENCRYPT(?,'nur')", [$idUser])
            ->whereRaw("password = AES_ENCRYPT(?,'windi')", [$password])
            ->first();

        if(!empty($user)){
            $dokter = Dokter::where('kd_dokter', '=', $idUser)->where('status', '=', '1')->first();
            $petugas = Petugas::where('nip', '=', $idUser)->where('status', '=', '1')->first();

            if (!empty($dokter)) {
                // throw new \Exception("User tidak ditemukan", 404);
                $nm_user=$dokter->nm_dokter;
                $type_user='dokter';
                $check_user=1;
            }else if (!empty($petugas)) {
                // throw new \Exception("User tidak ditemukan", 404);
                $nm_user=$petugas->nama;
                $type_user='petugas';
                $check_user=1;
            }
        }
        
        if(empty($user)){
            $user = (new \App\Models\UserAdmin)
                ->select('usere as id_user','passworde as password')
                ->whereRaw("usere = AES_ENCRYPT(?,'nur')", [$idUser])
                ->whereRaw("passworde = AES_ENCRYPT(?,'windi')", [$password])
                ->first();

            if(!empty($user)){
                $nm_user='Admin';
                $type_user='petugas';
                $check_user=1;
            }
        }

        if(empty($user) or empty($check_user)){
            throw new \Exception("User tidak ditemukan", 404);
        }

        if($user && $check_user){
            DB::beginTransaction();
            try {
                $jlh_save=0;
                $uxui_users = $this->uxui_users->where('id','=',$idUser)->first();
                if(empty($uxui_users)){
                    $uxui_users = $this->uxui_users;
                    $uxui_users->id=$idUser;
                    $uxui_users->id_user=$user->id_user;
                }
                $uxui_users->name=!empty($nm_user) ? $nm_user : '';
                $uxui_users->type_user=!empty($type_user) ? $type_user : '';
                
                if($uxui_users->save()){
                    DB::commit();
                }else{
                    DB::rollBack();
                    throw new \Exception("Terjadi kesalahan pada sistem", 404);
                }
            } catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                throw new \Exception("Terjadi kesalahan pada database", 404);
            } catch (\Throwable $e) {
                DB::rollBack();
                throw new \Exception("Terjadi kesalahan", 404);
            }
        }

        return !empty($uxui_users) ? $uxui_users : [];
    }
}
