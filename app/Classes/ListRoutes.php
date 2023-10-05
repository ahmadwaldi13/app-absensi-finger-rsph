<?php

namespace App\Classes;

class ListRoutes
{
    function getDataAuth($index = null)
    {
        $data = [
            [
                'title' => 'Sub Menu',
                'item' => [
                    [
                        'type' => ' index ',
                        'method' => 'get',
                        'url' => '/sub-menu',
                        'controller' => 'SubMenuController@index',
                        'name' => 'sub_menu',
                        'middleware' => '',
                    ],
                    [
                        'type' => ' index ',
                        'method' => 'get',
                        'url' => '/sub-menu/list_akses',
                        'controller' => 'SubMenuController@listAkses',
                        'name' => '',
                        'middleware' => '',
                    ]
                ]
            ],
            [
                'title' => 'Halaman Awal',
                'item' => [
                    [
                        'type' => ' index ',
                        'method' => 'get',
                        'url' => '/',
                        'controller' => 'DashboardController@index',
                        'name' => 'dashboard',
                        'middleware' => '',
                    ]
                ]
            ],
            [
                'title' => 'logout',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/logout',
                        'controller' => 'AuthController@logout',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'ajax',
                'item' => [
                    [
                        'type' => 'system',
                        'method' => 'get',
                        'url' => '/ajax',
                        'controller' => 'AjaxController@ajax',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Data Karyawan | Referensi Jabatan Karyawan',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/jabatan',
                        'controller' => 'JabatanController@actionIndex',
                        'name' => 'jabatan',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => ['get', 'post'],
                        'url' => '/jabatan/create',
                        'controller' => 'JabatanController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/jabatan/update',
                        'controller' => 'JabatanController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/jabatan/delete',
                        'controller' => 'JabatanController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Data Karyawan | Referensi Departemen/Bidang',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/departemen',
                        'controller' => 'DepartemenController@actionIndex',
                        'name' => 'departemen',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => ['get', 'post'],
                        'url' => '/departemen/create',
                        'controller' => 'DepartemenController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/departemen/update',
                        'controller' => 'DepartemenController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/departemen/delete',
                        'controller' => 'DepartemenController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Data Karyawan | Data Ruangan',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/data-ruangan',
                        'controller' => 'DataRuanganController@actionIndex',
                        'name' => 'data_ruangan',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => ['get', 'post'],
                        'url' => '/data-ruangan/create',
                        'controller' => 'DataRuanganController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/data-ruangan/update',
                        'controller' => 'DataRuanganController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/data-ruangan/delete',
                        'controller' => 'DataRuanganController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],

            [
                'title' => 'Data Karyawan | Data karyawan',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/data-karyawan',
                        'controller' => 'DataKaryawanController@actionIndex',
                        'name' => 'data_karyawan',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => ['get', 'post'],
                        'url' => '/data-karyawan/create',
                        'controller' => 'DataKaryawanController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/data-karyawan/update',
                        'controller' => 'DataKaryawanController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/data-karyawan/delete',
                        'controller' => 'DataKaryawanController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],

            [
                'title' => 'Data Karyawan | Data Jadwal karyawan',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => ['get', 'post'],
                        'url' => '/data-jadwal-karyawan',
                        'controller' => 'DataJadwalKaryawanController@actionIndex',
                        'name' => 'data_jadwal_karyawan',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'system',
                        'method' => ['get', 'post'],
                        'url' => '/data-jadwal-karyawan/ajax',
                        'controller' => 'DataJadwalKaryawanController@ajax',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],

            [
                'title' => 'Mesin Absensi | Data Mesin',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/data-mesin-absensi',
                        'controller' => 'DataMesinAbsensiController@actionIndex',
                        'name' => 'data_mesin_absensi',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => ['get', 'post'],
                        'url' => '/data-mesin-absensi/create',
                        'controller' => 'DataMesinAbsensiController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/data-mesin-absensi/update',
                        'controller' => 'DataMesinAbsensiController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/data-mesin-absensi/delete',
                        'controller' => 'DataMesinAbsensiController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Mesin Absensi | Sinkronisasi Mesin & Database',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => ['get', 'post'],
                        'url' => '/data-user-mesin-sinkronisasi',
                        'controller' => 'DataUserMesinSinkronisasiController@actionIndex',
                        'name' => 'data_user_mesin_sinkronisasi',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'Sinkronisasi',
                        'method' => 'post',
                        'url' => '/data-user-mesin-sinkronisasi/sinkron',
                        'controller' => 'DataUserMesinSinkronisasiController@actionSinkron',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Mesin Absensi | Data User Pada Database',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/data-user-mesin',
                        'controller' => 'DataUserMesinController@actionIndex',
                        'name' => 'data_user_mesin',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/data-user-mesin/update',
                        'controller' => 'DataUserMesinController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/data-user-mesin/delete',
                        'controller' => 'DataUserMesinController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Mesin Absensi | Copy Data User Mesin',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => ['get', 'post'],
                        'url' => '/data-user-mesin-copy',
                        'controller' => 'DataUserMesinCopyController@actionIndex',
                        'name' => 'data_user_mesin_copy',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'proses',
                        'method' => ['get', 'post'],
                        'url' => '/data-user-mesin-copy/update',
                        'controller' => 'DataUserMesinController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'system',
                        'method' => 'get',
                        'url' => '/data-user-mesin-copy/ajax',
                        'controller' => 'DataUserMesinCopyController@ajax',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Absensi | Jenis Jadwal Absensi',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/jenis-jadwal-absensi',
                        'controller' => 'JenisJadwalAbsensiController@actionIndex',
                        'name' => 'jenis_jadwal_absensi',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => ['get', 'post'],
                        'url' => '/jenis-jadwal-absensi/create',
                        'controller' => 'JenisJadwalAbsensiController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/jenis-jadwal-absensi/update',
                        'controller' => 'JenisJadwalAbsensiController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/jenis-jadwal-absensi/delete',
                        'controller' => 'JenisJadwalAbsensiController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Absensi | Jadwal Absensi',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/jadwal-absensi',
                        'controller' => 'JadwalAbsensiController@actionIndex',
                        'name' => 'jadwal_absensi',
                        'middleware' => '',
                    ],
                    // [
                    // 	'type' => 'create',
                    // 	'method' => ['get', 'post'],
                    // 	'url' => '/jadwal-absensi/create',
                    // 	'controller' => 'JadwalAbsensiController@actionCreate',
                    // 	'name' => '',
                    // 	'middleware' => '',
                    // ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/jadwal-absensi/update',
                        'controller' => 'JadwalAbsensiController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    // [
                    // 	'type' => 'delete',
                    // 	'method' => 'delete',
                    // 	'url' => '/jadwal-absensi/delete',
                    // 	'controller' => 'JadwalAbsensiController@actionDelete',
                    // 	'name' => '',
                    // 	'middleware' => '',
                    // ],
                ]
            ],
            [
                'title' => 'Absensi | Hari Libur Umum',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/hari-libur-umum',
                        'controller' => 'HariLiburUmumController@actionIndex',
                        'name' => 'hari_libur_umum',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => ['get', 'post'],
                        'url' => '/hari-libur-umum/create',
                        'controller' => 'HariLiburUmumController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/hari-libur-umum/update',
                        'controller' => 'HariLiburUmumController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/hari-libur-umum/delete',
                        'controller' => 'HariLiburUmumController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Absensi | Cuti Karyawan',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/cuti-karyawan',
                        'controller' => 'CutiKaryawanController@actionIndex',
                        'name' => 'cuti_karyawan',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => ['get', 'post'],
                        'url' => '/cuti-karyawan/create',
                        'controller' => 'CutiKaryawanController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/cuti-karyawan/update',
                        'controller' => 'CutiKaryawanController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/cuti-karyawan/delete',
                        'controller' => 'CutiKaryawanController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Absensi | Perjalanan Dinas',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/perjalanan-dinas',
                        'controller' => 'PerjalananDinasController@actionIndex',
                        'name' => 'perjalanan_dinas',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => ['get', 'post'],
                        'url' => '/perjalanan-dinas/create',
                        'controller' => 'PerjalananDinasController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/perjalanan-dinas/update',
                        'controller' => 'PerjalananDinasController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/perjalanan-dinas/delete',
                        'controller' => 'PerjalananDinasController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Manajemen Absensi | Tarik Log Absensi Karyawan',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/tarik-data-absensi-karyawan',
                        'controller' => 'TarikDataAbsensiKaryawanController@actionIndex',
                        'name' => 'tarik_data_absensi_karyawan',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'view',
                        'method' => 'get',
                        'url' => '/tarik-data-absensi-karyawan/view',
                        'controller' => 'TarikDataAbsensiKaryawanController@actionView',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'system',
                        'method' => ['get', 'post'],
                        'url' => '/tarik-data-absensi-karyawan/ajax',
                        'controller' => 'TarikDataAbsensiKaryawanController@ajax',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Manajemen | Data Absensi',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/absensi-karyawan',
                        'controller' => 'AbsensiKaryawanController@actionIndex',
                        'name' => 'absensi_karyawan',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'system',
                        'method' => ['get', 'post'],
                        'url' => '/absensi-karyawan/ajax',
                        'controller' => 'AbsensiKaryawanController@ajax',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Manajemen | Laporan Data Absensi',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/laporan-absensi-karyawan',
                        'controller' => 'LaporanAbsensiKaryawanController@actionIndex',
                        'name' => 'laporan_absensi_karyawan',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'cetak',
                        'method' => 'get',
                        'url' => '/laporan-absensi-karyawan/cetak',
                        'controller' => 'LaporanAbsensiKaryawanController@actionCetak',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],

            [
                'title' => 'Absensi | Data Absensi Perkaryawan ',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/absensi-per-karyawan',
                        'controller' => 'AbsensiPerKaryawanController@actionIndex',
                        'name' => 'absensi_per_karyawan',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'view',
                        'method' => 'get',
                        'url' => '/absensi-per-karyawan/view',
                        'controller' => 'AbsensiPerKaryawanController@actionView',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],

            [
                'title' => 'Manajemen User | Group User',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/user-group-app',
                        'controller' => 'UserGroupAppController@actionIndex',
                        'name' => 'user_group_app',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => 'post',
                        'url' => '/user-group-app/create',
                        'controller' => 'UserGroupAppController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => 'post',
                        'url' => '/user-group-app/update',
                        'controller' => 'UserGroupAppController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/user-group-app/delete',
                        'controller' => 'UserGroupAppController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'form',
                        'method' => 'get',
                        'url' => '/user-group-app/form',
                        'controller' => 'UserGroupAppController@form',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Manajemen User | Group User | Permission',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/permission-group-app',
                        'controller' => 'PermissionGroupAppController@actionIndex',
                        'name' => 'permission_group_app',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => 'post',
                        'url' => '/permission-group-app/update',
                        'controller' => 'PermissionGroupAppController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title' => 'Manajemen User | Akses User',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/user-akses',
                        'controller' => 'UserAksesController@actionIndex',
                        'name' => 'user_akses',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/user-akses/update',
                        'controller' => 'UserAksesController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/user-akses/delete',
                        'controller' => 'UserAksesController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'form',
                        'method' => 'get',
                        'url' => '/user-akses/form',
                        'controller' => 'UserAksesController@form',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
            [
                'title'=>'Setting Variabel Aplikasi',
                'item'=>[
                    [
                        'type'=>'index',
                        'method'=>'get',
                        'url'=>'/setting-app-variabel',
                        'controller'=>'SettingAppVariabelController@actionIndex',
                        'name'=>'',
                        'middleware'=>'',
                    ],
                    [
                        'type'=>'create',
                        'method'=>['get','post'],
                        'url'=>'/setting-app-variabel/create',
                        'controller'=>'SettingAppVariabelController@actionCreate',
                        'name'=>'',
                        'middleware'=>'',
                    ],
                    [
                        'type'=>'update',
                        'method'=>['get','post'],
                        'url'=>'/setting-app-variabel/update',
                        'controller'=>'SettingAppVariabelController@actionUpdate',
                        'name'=>'',
                        'middleware'=>'',
                    ],
                    [
                        'type'=>'delete',
                        'method'=>'delete',
                        'url'=>'/setting-app-variabel/delete',
                        'controller'=>'SettingAppVariabelController@actionDelete',
                        'name'=>'',
                        'middleware'=>'',
                    ],
                ]
            ],
        ];

        if (!empty($index)) {
            return !empty($data[$index]) ? $data[$index] : null;
        }
        return $data;
    }

    function getIgnoreType($type = null)
    {
        $data = ['/', 'form', 'ajax', 'system'];
        if (!empty($type)) {
            if (!in_array($type, $data)) {
                return 1;
            }
            return 0;
        }
        return $data;
    }
}