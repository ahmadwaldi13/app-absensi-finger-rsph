<?php

namespace App\Services;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class PermohonanIzinService extends BaseService
{
    public function getListData($params = [])
    {
        $query = DB::table('pengajuan_izin as pi')
            ->select(
                'pi.id',
                'pi.id_karyawan',
                'pi.keterangan',
                'pi.tgl_mulai',
                'pi.tgl_selesai',
                'pi.status',
                'pi.current_level',
                'pi.file_pendukung',
                'pi.created_at',
                'k.nip',
                'k.nm_karyawan'
            )
            ->join('ref_karyawan as k', 'k.id_karyawan', '=', 'pi.id_karyawan')
            ->orderBy('pi.created_at', 'desc');

        if (empty($params['is_super_admin']) || $params['is_super_admin'] === false) {
            $hasGlobalMapping = DB::table('approval_mappings')
                ->where('jenis_pengajuan', 'izin')
                ->where('approver_type', 'jabatan')
                ->where('approver_value', $params['id_jabatan'])
                ->where('scope_id', $params['id_ruangan'])
                ->where('scope_type', 'global')
                ->where('aktif', 1)
                ->exists();

            $query->where(function ($q) use ($params, $hasGlobalMapping) {
                if (!empty($params['id_jabatan'])) {
                    $q->whereExists(function ($sub) use ($params, $hasGlobalMapping) {
                        $sub->select(DB::raw(1))
                            ->from('approval_mappings as am')
                            ->where('am.jenis_pengajuan', 'izin')
                            ->where('am.approver_type', 'jabatan')
                            ->where('am.approver_value', $params['id_jabatan'])
                            ->where('am.scope_id', $params['id_ruangan'])
                            ->where('am.aktif', 1);

                        if ($hasGlobalMapping) {
                            $sub->where('am.scope_type', 'global')
                                ->whereColumn('pi.current_level', '>=', 'am.level');
                        } else {
                            $sub->where('am.scope_type', 'ruangan')
                                ->whereColumn('am.scope_id', 'pi.id_ruangan');
                        }
                    });
                }
            });
        }

        if (!empty($params['search'])) {
            $query->where(function ($q) use ($params) {
                $q->where('k.nm_karyawan', 'like', '%'.$params['search'].'%')
                ->orWhere('k.nip', 'like', '%'.$params['search'].'%');
            });
        }

        return $query;
    }

    public function approved($params=[])
    {
        DB::beginTransaction();

        try {

            $pengajuan_id = $params['data_req']['pengajuan_id'];

            $pengajuan = DB::table('pengajuan_izin')
                ->where('id', $pengajuan_id)
                ->lockForUpdate()
                ->first();

            if (!$pengajuan) {
                throw new \Exception('Pengajuan tidak ditemukan');
            }

            if (empty($params['is_super_admin']) || $params['is_super_admin'] === false) {

                $valid = DB::table('approval_mappings')
                ->where('jenis_pengajuan', 'izin')
                ->where('level', $pengajuan->current_level)
                ->where('approver_type', 'jabatan')
                ->where('approver_value', $params['id_jabatan'])
                ->where('aktif', 1)
                ->exists();

                if (!$valid) {
                    throw new \Exception('Anda tidak berhak approve pengajuan ini');
                }

                DB::table('approval_histories')->insert([
                    'jenis_pengajuan' => 'izin',
                    'pengajuan_id'    => $pengajuan_id,
                    'level'           => $pengajuan->current_level,
                    'approver_id'     => $params['id_karyawan'],
                    'status'          => 'approved',
                    'approved_at'     => now(),
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);

                $nextLevelExists = DB::table('approval_mappings')
                    ->where('jenis_pengajuan', 'izin')
                    ->where('level', $pengajuan->current_level + 1)
                    ->where('aktif', 1)
                    ->exists();

                if ($nextLevelExists) {
                    DB::table('pengajuan_izin')
                        ->where('id', $pengajuan_id)
                        ->update([
                            'current_level' => $pengajuan->current_level + 1,
                            'updated_at'    => now(),
                        ]);
                } else {
                    DB::table('pengajuan_izin')
                        ->where('id', $pengajuan_id)
                        ->update([
                            'status'        => 'approved',
                            'updated_at'    => now(),
                        ]);
                }

            }else {
                throw new \Exception('Anda tidak berhak approve pengajuan ini');
            }

            DB::commit();
            return true;

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return false;
        }
    }

    public function rejected($params = []) {
        DB::beginTransaction();

        try {

            $pengajuan_id = $params['data_req']['pengajuan_id'];
            $reason = $params['data_req']['reason'];

            $pengajuan = DB::table('pengajuan_izin')
                ->where('id', $pengajuan_id)
                ->lockForUpdate()
                ->first();

            if (!$pengajuan) {
                throw new \Exception('Pengajuan tidak ditemukan');
            }

            if (empty($params['is_super_admin']) || $params['is_super_admin'] === false) {

                $valid = DB::table('approval_mappings')
                ->where('jenis_pengajuan', 'izin')
                ->where('level', $pengajuan->current_level)
                ->where('approver_type', 'jabatan')
                ->where('approver_value', $params['id_jabatan'])
                ->where('aktif', 1)
                ->exists();

                if (!$valid) {
                    throw new \Exception('Anda tidak berhak approve pengajuan ini');
                }

                DB::table('approval_histories')->insert([
                    'jenis_pengajuan' => 'izin',
                    'pengajuan_id'    => $pengajuan_id,
                    'level'           => $pengajuan->current_level,
                    'approver_id'     => $params['id_karyawan'],
                    'catatan'         => $reason,
                    'status'          => 'rejected',
                    'approved_at'     => now(),
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);

                DB::table('pengajuan_izin')
                ->where('id', $pengajuan_id)
                ->update([
                    'status'     => 'rejected',
                    'updated_at' => now(),
                ]);

            }else {
                throw new \Exception('Anda tidak berhak approve pengajuan ini');
            }

            DB::commit();
            return true;

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return false;
        }
    }

    public function userLevel1($id_jabatan, $id_ruangan)
    {
        return DB::table('approval_mappings')
            ->select('level')
            ->where('jenis_pengajuan', 'izin')
            ->where('approver_type', 'jabatan')
            ->where('approver_value', $id_jabatan)
            ->where('scope_id', $id_ruangan)
            ->where('level', 1)
            ->where('aktif', 1)
            ->first();
    }

    public function userLevel2($id_jabatan, $id_ruangan)
    {
        return DB::table('approval_mappings')
            ->select('level')
            ->where('jenis_pengajuan', 'izin')
            ->where('approver_type', 'jabatan')
            ->where('approver_value', $id_jabatan)
            ->where('scope_id', $id_ruangan)
            ->where('level', 2)
            ->where('aktif', 1)
            ->first();
    }

}
