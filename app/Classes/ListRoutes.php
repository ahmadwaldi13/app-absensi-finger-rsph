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
				'title' => 'Rawat Jalan',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/rawat-jalan',
						'controller' => 'RawatJalanController@index',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Panggilan Suara dan Mute',
						'method' => 'post',
						'url' => '/rawat-jalan/masuk-monitor',
						'controller' => 'RawatJalanController@actionPanggilMute',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Tindakan Rekam Medis',
						'method' => 'get',
						'url' => '/tindakan-rekam-medis/ralan',
						'controller' => 'TindakanRekamMedisController@actionRalan',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Rujukan Poli',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/rujukan-poli',
						'controller' => 'RujukanPoliController@index',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Tindakan Rekam Medis',
						'method' => 'get',
						'url' => '/tindakan-rekam-medis/rujukan-poli',
						'controller' => 'TindakanRekamMedisController@actionRujukanPoli',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Rawat Inap',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/rawat-inap',
						'controller' => 'RawatInapController@index',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Tindakan Rekam Medis',
						'method' => 'get',
						'url' => '/tindakan-rekam-medis/ranap',
						'controller' => 'TindakanRekamMedisController@actionRanap',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Riwayat Pasien',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/riwayat-pasien',
						'controller' => 'RiwayatPasienController@actionIndex',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Detail Data',
						'method' => 'get',
						'url' => '/riwayat-pasien/view',
						'controller' => 'RiwayatPasienController@actionView',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'CPPT/SOAP',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/isi-cppt',
						'controller' => 'CpptController@actionIndex',
						'name' => 'isi_cppt',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/isi-cppt/create',
						'controller' => 'CpptController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/isi-cppt/form_update',
						'controller' => 'CpptController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/isi-cppt/update',
						'controller' => 'CpptController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/isi-cppt/delete',
						'controller' => 'CpptController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/isi-cppt/view',
						'controller' => 'CpptController@actionView',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Permintaan | Patologi Klinis',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/patologi-klinis',
						'controller' => 'PatologiKlinisController@actionIndex',
						'name' => 'patologi_klinis',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/patologi-klinis/create',
						'controller' => 'PatologiKlinisController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/patologi-klinis/delete',
						'controller' => 'PatologiKlinisController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/patologi-klinis/view',
						'controller' => 'PatologiKlinisController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/patologi-klinis/ajax',
						'controller' => 'PatologiKlinisController@ajax',
						'name' => '',
						'middleware' => '',
					],
					[
						'type'=>'Full Akses Admin',
						'method'=>'get',
						'url'=>'/patologi-klinis/fullAkses',
						'controller'=>'PatologiKlinisController@fullAkses',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
			[
				'title' => 'Permintaan | Patologi Anatomi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/patologi-anatomi',
						'controller' => 'PatologiAnatomiController@actionIndex',
						'name' => 'patologi_anatomi',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/patologi-anatomi/create',
						'controller' => 'PatologiAnatomiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/patologi-anatomi/delete',
						'controller' => 'PatologiAnatomiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/patologi-anatomi/view',
						'controller' => 'PatologiAnatomiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type'=>'Full Akses Admin',
						'method'=>'get',
						'url'=>'/patologi-anatomi/fullAkses',
						'controller'=>'PatologiAnatomiController@fullAkses',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
			[
				'title' => 'Permintaan | Pemeriksaan Radiologi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/pemeriksaan-radiologi',
						'controller' => 'PemeriksaanRadiologiController@actionIndex',
						'name' => 'pemeriksaan_radiologi',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/pemeriksaan-radiologi/create',
						'controller' => 'PemeriksaanRadiologiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/pemeriksaan-radiologi/delete',
						'controller' => 'PemeriksaanRadiologiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/pemeriksaan-radiologi/view',
						'controller' => 'PemeriksaanRadiologiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type'=>'Full Akses Admin',
						'method'=>'get',
						'url'=>'/pemeriksaan-radiologi/fullAkses',
						'controller'=>'PemeriksaanRadiologiController@fullAkses',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
			[
				'title' => 'Resep Obat',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/resep',
						'controller' => 'ResepController@actionIndex',
						'name' => 'resep',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/resep/create',
						'controller' => 'ResepController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => 'resep/form_update',
						'controller' => 'ResepController@formUpdate',
						'name' => 'resep_form_update',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/resep/update',
						'controller' => 'ResepController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/resep/delete',
						'controller' => 'ResepController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/resep/view',
						'controller' => 'ResepController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/resep/aturan-pakai',
						'controller' => 'ResepController@getAturanPakai',
						'name' => '',
						'middleware' => '',
					],
					[
						'type'=>'Full Akses Admin',
						'method'=>'get',
						'url'=>'/resep/fullAkses',
						'controller'=>'ResepController@fullAkses',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
			[
				'title' => 'Resep Racikan Obat',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/racikan',
						'controller' => 'RacikanController@actionIndex',
						'name' => 'racikan',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/racikan/create',
						'controller' => 'RacikanController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => 'racikan/form_update',
						'controller' => 'RacikanController@formUpdate',
						'name' => 'racikan_form_update',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/racikan/update',
						'controller' => 'RacikanController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/racikan/delete',
						'controller' => 'RacikanController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/racikan/view',
						'controller' => 'RacikanController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/racikan/ajax',
						'controller' => 'RacikanController@ajax',
						'name' => '',
						'middleware' => '',
					],
					[
						'type'=>'Full Akses Admin',
						'method'=>'get',
						'url'=>'/racikan/fullAkses',
						'controller'=>'RacikanController@fullAkses',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
			[
				'title' => 'Copy Resep Obat',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/copy-resep',
						'controller' => 'CopyResepController@actionIndex',
						'name' => 'copy_resep',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/copy-resep/delete',
						'controller' => 'CopyResepController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Resume Pasien',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/isi-resume',
						'controller' => 'ResumeController@actionIndex',
						'name' => 'isi_resume',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/isi-resume/create',
						'controller' => 'ResumeController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/isi-resume/form_update',
						'controller' => 'ResumeController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/isi-resume/update',
						'controller' => 'ResumeController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/isi-resume/delete',
						'controller' => 'ResumeController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/isi-resume/view',
						'controller' => 'ResumeController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/isi-resume/diagnosa-list',
						'controller' => 'ResumeController@penyakitIndexData',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/isi-resume/prosedur-list',
						'controller' => 'ResumeController@prosedurIndexData',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/isi-resume/ajax',
						'controller' => 'ResumeController@ajax',
						'name' => '',
						'middleware' => '',
					],
					[
						'type'=>'Full Akses Admin',
						'method'=>'get',
						'url'=>'/isi-resume/fullAkses',
						'controller'=>'ResumeController@fullAkses',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
			[
                'title' => 'Jadwal Operasi',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/jadwal-operasi-pasien',
                        'controller' => 'JadwalOperasiPasienController@actionIndex',
                        'name' => 'jadwal-operasi-pasien',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => 'post',
                        'url' => '/jadwal-operasi-pasien/create',
                        'controller' => 'JadwalOperasiPasienController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'form',
                        'method' => 'get',
                        'url' => '/jadwal-operasi-pasien/form_update',
                        'controller' => 'JadwalOperasiPasienController@formUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => 'post',
                        'url' => '/jadwal-operasi-pasien/update',
                        'controller' => 'JadwalOperasiPasienController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/jadwal-operasi-pasien/delete',
                        'controller' => 'JadwalOperasiPasienController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
			[
				'title' => 'Operasi/Vk',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/operasi-vk',
						'controller' => 'LaporanOperasiPasienController@actionIndex',
						'name' => 'operasi-vk',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/operasi-vk/view',
						'controller' => 'LaporanOperasiPasienController@actionView',
						'name' => '',
						'middleware' => '',
					],

				]
			],
			[
				'title' => 'Operasi/Vk Form Input',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/operasi-vk/form-laporan-operasi',
						'controller' => 'LaporanOperasiPasienController@formLaporanOperasi',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/operasi-vk/update',
						'controller' => 'LaporanOperasiPasienController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],

				]
			],
            [
				'title' => 'RM operasi | Check List Pre Operasi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/check-list-pre-operasi',
						'controller' => 'CheckListPreOperasiController@actionIndex',
						'name' => 'check_list_pre_operasi',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/check-list-pre-operasi/create',
						'controller' => 'CheckListPreOperasiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/check-list-pre-operasi/delete',
						'controller' => 'CheckListPreOperasiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'form',
						'method' => 'get',
						'url' => '/check-list-pre-operasi/form_update',
						'controller' => 'CheckListPreOperasiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'update',
						'method' => 'post',
						'url' => '/check-list-pre-operasi/update',
						'controller' => 'CheckListPreOperasiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/check-list-pre-operasi/view',
						'controller' => 'CheckListPreOperasiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/check-list-pre-operasi/ajax',
						'controller' => 'CheckListPreOperasiController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],
            [
				'title' => 'RM operasi | Sign-in Sebelum Anestesi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/signin-sebelum-anestesi',
						'controller' => 'SigninSebelumAnestesiController@actionIndex',
						'name' => 'signin-sebelum-anestesi',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/signin-sebelum-anestesi/create',
						'controller' => 'SigninSebelumAnestesiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'form',
						'method' => 'get',
						'url' => '/signin-sebelum-anestesi/form_update',
						'controller' => 'SigninSebelumAnestesiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'update',
						'method' => 'post',
						'url' => '/signin-sebelum-anestesi/update',
						'controller' => 'SigninSebelumAnestesiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/signin-sebelum-anestesi/delete',
						'controller' => 'SigninSebelumAnestesiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/signin-sebelum-anestesi/view',
						'controller' => 'SigninSebelumAnestesiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/signin-sebelum-anestesi/ajax',
						'controller' => 'SigninSebelumAnestesiController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'RM operasi | Time-Out Sebelum Insisi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/timeout-sebelum-insisi',
						'controller' => 'TimeOutSebelumInsisiController@actionIndex',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/timeout-sebelum-insisi/create',
						'controller' => 'TimeOutSebelumInsisiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/timeout-sebelum-insisi/delete',
						'controller' => 'TimeOutSebelumInsisiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'form',
						'method' => 'get',
						'url' => '/timeout-sebelum-insisi/form_update',
						'controller' => 'TimeOutSebelumInsisiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'update',
						'method' => 'post',
						'url' => '/timeout-sebelum-insisi/update',
						'controller' => 'TimeOutSebelumInsisiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/timeout-sebelum-insisi/view',
						'controller' => 'TimeOutSebelumInsisiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/timeout-sebelum-insisi/ajax',
						'controller' => 'TimeOutSebelumInsisiController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],
            [
				'title' => 'RM operasi | Sign-out Sebelum Menutup Luka',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/sign-out-sebelum-menutup-luka',
						'controller' => 'SignOutSebelumMenutupLukaController@actionIndex',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/sign-out-sebelum-menutup-luka/create',
						'controller' => 'SignOutSebelumMenutupLukaController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'form',
						'method' => 'get',
						'url' => '/sign-out-sebelum-menutup-luka/form_update',
						'controller' => 'SignOutSebelumMenutupLukaController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'update',
						'method' => 'post',
						'url' => '/sign-out-sebelum-menutup-luka/update',
						'controller' => 'SignOutSebelumMenutupLukaController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/sign-out-sebelum-menutup-luka/delete',
						'controller' => 'SignOutSebelumMenutupLukaController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/sign-out-sebelum-menutup-luka/view',
						'controller' => 'SignOutSebelumMenutupLukaController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/sign-out-sebelum-menutup-luka/ajax',
						'controller' => 'SignOutSebelumMenutupLukaController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],
            [
				'title' => 'RM operasi | Check List Post Operasi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/check-list-post-operasi',
						'controller' => 'ChecklistPostOperasiController@actionIndex',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/check-list-post-operasi/create',
						'controller' => 'ChecklistPostOperasiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/check-list-post-operasi/delete',
						'controller' => 'ChecklistPostOperasiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/check-list-post-operasi/form_update',
						'controller' => 'ChecklistPostOperasiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'update',
						'method' => 'post',
						'url' => '/check-list-post-operasi/update',
						'controller' => 'ChecklistPostOperasiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/check-list-post-operasi/view',
						'controller' => 'ChecklistPostOperasiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/check-list-post-operasi/ajax',
						'controller' => 'ChecklistPostOperasiController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],
            [
				'title' => 'RM operasi | Penilaian Pre Operasi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/rmoperasi-nilai-pre-operasi',
						'controller' => 'PenilaianPreOperasiController@actionIndex',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/rmoperasi-nilai-pre-operasi/create',
						'controller' => 'PenilaianPreOperasiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/rmoperasi-nilai-pre-operasi/delete',
						'controller' => 'PenilaianPreOperasiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'form',
						'method' => 'get',
						'url' => '/rmoperasi-nilai-pre-operasi/form_update',
						'controller' => 'PenilaianPreOperasiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'update',
						'method' => 'post',
						'url' => '/rmoperasi-nilai-pre-operasi/update',
						'controller' => 'PenilaianPreOperasiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/rmoperasi-nilai-pre-operasi/view',
						'controller' => 'PenilaianPreOperasiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/rmoperasi-nilai-pre-operasi/ajax',
						'controller' => 'PenilaianPreOperasiController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],
            [
				'title' => 'RM operasi | Penilaian Pre Anestesi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/rmoperasi-nilai-pre-anestesi',
						'controller' => 'PenilaianPreAnestesiController@actionIndex',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/rmoperasi-nilai-pre-anestesi/create',
						'controller' => 'PenilaianPreAnestesiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'form',
						'method' => 'get',
						'url' => '/rmoperasi-nilai-pre-anestesi/form_update',
						'controller' => 'PenilaianPreAnestesiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
                    [
						'type' => 'update',
						'method' => 'post',
						'url' => '/rmoperasi-nilai-pre-anestesi/update',
						'controller' => 'PenilaianPreAnestesiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/rmoperasi-nilai-pre-anestesi/delete',
						'controller' => 'PenilaianPreAnestesiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/rmoperasi-nilai-pre-anestesi/view',
						'controller' => 'PenilaianPreAnestesiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/rmoperasi-nilai-pre-anestesi/ajax',
						'controller' => 'PenilaianPreAnestesiController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Tindakan Petugas',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/tindakan-petugas',
						'controller' => 'TindakanPetugasController@actionIndex',
						'name' => 'tindakan_petugas',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/tindakan-petugas/create',
						'controller' => 'TindakanPetugasController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'post',
						'url' => '/tindakan-petugas/tindakan-action',
						'controller' => 'TindakanPetugasController@tindakanAction',
						'name' => '',
						'middleware' => '',
					],
				],
			],
			[
				'title' => 'Tindakan Dokter',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/tindakan-dokter',
						'controller' => 'TindakanDokterController@actionIndex',
						'name' => 'tindakan_dokter',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/tindakan-dokter/create',
						'controller' => 'TindakanDokterController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'post',
						'url' => '/tindakan-dokter/tindakan-action',
						'controller' => 'TindakanDokterController@tindakanAction',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Rawat Inap Penilaian | Keperawatan Umum',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-perawat-umum',
						'controller' => 'PenilaianPerawatUmumController@actionIndex',
						'name' => 'penilaian_perawat_umum',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-perawat-umum/create',
						'controller' => 'PenilaianPerawatUmumController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-perawat-umum/form_update',
						'controller' => 'PenilaianPerawatUmumController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-perawat-umum/update',
						'controller' => 'PenilaianPerawatUmumController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-perawat-umum/delete',
						'controller' => 'PenilaianPerawatUmumController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-perawat-umum/view',
						'controller' => 'PenilaianPerawatUmumController@actionView',
						'name' => '',
						'middleware' => '',
					],
					// [
					// 	'type' => 'form rencana',
					// 	'method' => 'get',
					// 	'url' => '/penilaian-perawat-umum/form_rencana',
					// 	'controller' => 'PenilaianPerawatUmumController@formRencana',
					// 	'name' => '',
					// 	'middleware' => '',
					// ],
					// [
					// 	'type' => 'form masalah',
					// 	'method' => 'get',
					// 	'url' => '/penilaian-perawat-umum/form_masalah',
					// 	'controller' => 'PenilaianPerawatUmumController@formMasalah',
					// 	'name' => '',
					// 	'middleware' => '',
					// ],
					[
						'type' => 'Full Akses Admin',
						'method' => 'get',
						'url'=> '/penilaian-perawat-umum/fullAkses',
						'controller'=> 'PenilaianPerawatUmumController@fullAkses',
						'name' => '',
						'middleware' => ''
					]
				]
			],
			[
				'title' => 'Rawat Inap Penilaian | Keperawatan Kebidanan & Kandungan',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-perawat-kebidanan',
						'controller' => 'PenilaianPerawatKebidananController@actionIndex',
						'name' => 'penilaian_perawat_kebidanan',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-perawat-kebidanan/create',
						'controller' => 'PenilaianPerawatKebidananController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-perawat-kebidanan/form_update',
						'controller' => 'PenilaianPerawatKebidananController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-perawat-kebidanan/update',
						'controller' => 'PenilaianPerawatKebidananController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-perawat-kebidanan/delete',
						'controller' => 'PenilaianPerawatKebidananController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-perawat-kebidanan/view',
						'controller' => 'PenilaianPerawatKebidananController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Full Akses Admin',
						'method' => 'get',
						'url'=> '/penilaian-perawat-kebidanan/fullAkses',
						'controller'=> 'PenilaianPerawatKebidananController@fullAkses',
						'name' => '',
						'middleware' => ''
					]
				]
			],
			[
				'title' => 'Rawat Jalan | Penilaian | Keperawatan Gigi & Mulut',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-perawat-gigi',
						'controller' => 'PenilaianPerawatGigiController@actionIndex',
						'name' => 'penilaian_perawat_gigi',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-perawat-gigi/create',
						'controller' => 'PenilaianPerawatGigiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-perawat-gigi/form_update',
						'controller' => 'PenilaianPerawatGigiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-perawat-gigi/update',
						'controller' => 'PenilaianPerawatGigiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-perawat-gigi/delete',
						'controller' => 'PenilaianPerawatGigiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-perawat-gigi/view',
						'controller' => 'PenilaianPerawatGigiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Full Akses Admin',
						'method' => 'get',
						'url'=> '/penilaian-perawat-gigi/fullAkses',
						'controller'=> 'PenilaianPerawatGigiController@fullAkses',
						'name' => '',
						'middleware' => ''
					]
				]
			],
			[
				'title' => 'Rawat Jalan | Penilaian | Keperawatan Bayi & Anak',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-perawat-bayi-anak',
						'controller' => 'PenilaianPerawatBayiController@actionIndex',
						'name' => 'penilaian_perawat_bayi_anak',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-perawat-bayi-anak/create',
						'controller' => 'PenilaianPerawatBayiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-perawat-bayi-anak/form_update',
						'controller' => 'PenilaianPerawatBayiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-perawat-bayi-anak/update',
						'controller' => 'PenilaianPerawatBayiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-perawat-bayi-anak/delete',
						'controller' => 'PenilaianPerawatBayiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-perawat-bayi-anak/view',
						'controller' => 'PenilaianPerawatBayiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Full Akses Admin',
						'method' => 'get',
						'url'=> '/penilaian-perawat-bayi-anak/fullAkses',
						'controller'=> 'PenilaianPerawatBayiController@fullAkses',
						'name' => '',
						'middleware' => ''
					]
				]
			],
			[
				'title' => 'Rawat Jalan | Penilaian | Keperawatan Psikiatri',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-perawat-psikiatri',
						'controller' => 'PenilaianPerawatPsikiatriController@actionIndex',
						'name' => 'penilaian_perawat_psikiatri',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-perawat-psikiatri/create',
						'controller' => 'PenilaianPerawatPsikiatriController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-perawat-psikiatri/form_update',
						'controller' => 'PenilaianPerawatPsikiatriController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-perawat-psikiatri/update',
						'controller' => 'PenilaianPerawatPsikiatriController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-perawat-psikiatri/delete',
						'controller' => 'PenilaianPerawatPsikiatriController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-perawat-psikiatri/view',
						'controller' => 'PenilaianPerawatPsikiatriController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Full Akses Admin',
						'method' => 'get',
						'url'=> '/penilaian-perawat-psikiatri/fullAkses',
						'controller'=> 'PenilaianPerawatPsikiatriController@fullAkses',
						'name' => '',
						'middleware' => ''
					]
				]
			],
			[
				'title' => 'Rawat Inap Penilaian | Medis Umum',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-umum',
						'controller' => 'PenilaianMedisUmumController@actionIndex',
						'name' => 'penilaian_medis_umum',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-umum/create',
						'controller' => 'PenilaianMedisUmumController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-umum/form_update',
						'controller' => 'PenilaianMedisUmumController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-umum/update',
						'controller' => 'PenilaianMedisUmumController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-umum/delete',
						'controller' => 'PenilaianMedisUmumController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-umum/view',
						'controller' => 'PenilaianMedisUmumController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Full Akses Admin',
						'method' => 'get',
						'url'=> '/penilaian-medis-umum/fullAkses',
						'controller'=> 'PenilaianMedisUmumController@fullAkses',
						'name' => '',
						'middleware' => ''
					]
				]
			],
			[
				'title' => 'Rawat Jalan | Penilaian | Medis IGD',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-igd',
						'controller' => 'PenilaianMedisIGDController@actionIndex',
						'name' => 'penilaian_medis_igd',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-igd/create',
						'controller' => 'PenilaianMedisIGDController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-igd/form_update',
						'controller' => 'PenilaianMedisIGDController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-igd/update',
						'controller' => 'PenilaianMedisIGDController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-igd/delete',
						'controller' => 'PenilaianMedisIGDController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-igd/view',
						'controller' => 'PenilaianMedisIGDController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Full Akses Admin',
						'method' => 'get',
						'url'=> '/penilaian-medis-igd/fullAkses',
						'controller'=> 'PenilaianMedisIGDController@fullAkses',
						'name' => '',
						'middleware' => ''
					]
				]
			],
			[
				'title' => 'Rawat Jalan | Penilaian | Medis Bayi & Anak',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-bayi',
						'controller' => 'PenilaianMedisBayiController@actionIndex',
						'name' => 'penilaian_medis_bayi',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-bayi/create',
						'controller' => 'PenilaianMedisBayiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-bayi/form_update',
						'controller' => 'PenilaianMedisBayiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-bayi/update',
						'controller' => 'PenilaianMedisBayiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-bayi/delete',
						'controller' => 'PenilaianMedisBayiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-bayi/view',
						'controller' => 'PenilaianMedisBayiController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Full Akses Admin',
						'method' => 'get',
						'url'=> '/penilaian-medis-bayi/fullAkses',
						'controller'=> 'PenilaianMedisBayiController@fullAkses',
						'name' => '',
						'middleware' => ''
					]
				]
			],
			[
				'title' => 'Rawat Inap Penilaian | Medis Kebidanan',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-kebidanan',
						'controller' => 'PenilaianMedisKebidananController@actionIndex',
						'name' => 'penilaian_medis_kebidanan',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-kebidanan/create',
						'controller' => 'PenilaianMedisKebidananController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-kebidanan/form_update',
						'controller' => 'PenilaianMedisKebidananController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-kebidanan/update',
						'controller' => 'PenilaianMedisKebidananController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-kebidanan/delete',
						'controller' => 'PenilaianMedisKebidananController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-kebidanan/view',
						'controller' => 'PenilaianMedisKebidananController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Full Akses Admin',
						'method' => 'get',
						'url'=> '/penilaian-medis-kebidanan/fullAkses',
						'controller'=> 'PenilaianMedisKebidananController@fullAkses',
						'name' => '',
						'middleware' => ''
					]
				]
			]
			,
			[
				'title' => 'Rawat Jalan Penilaian | Medis Psikiatri',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-psikiatri',
						'controller' => 'PenilaianMedisPsikiatriController@actionIndex',
						'name' => 'penilaian_medis_psikiatri',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-psikiatri/create',
						'controller' => 'PenilaianMedisPsikiatriController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-psikiatri/form_update',
						'controller' => 'PenilaianMedisPsikiatriController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-psikiatri/update',
						'controller' => 'PenilaianMedisPsikiatriController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-psikiatri/delete',
						'controller' => 'PenilaianMedisPsikiatriController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-psikiatri/view',
						'controller' => 'PenilaianMedisPsikiatriController@actionView',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'Rawat Jalan Penilaian | Medis THT',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-tht',
						'controller' => 'PenilaianMedisThtController@actionIndex',
						'name' => 'penilaian_medis_tht',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-tht/create',
						'controller' => 'PenilaianMedisThtController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-tht/form_update',
						'controller' => 'PenilaianMedisThtController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-tht/update',
						'controller' => 'PenilaianMedisThtController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-tht/delete',
						'controller' => 'PenilaianMedisThtController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-tht/view',
						'controller' => 'PenilaianMedisThtController@actionView',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'Rawat Jalan Penilaian | Medis Mata',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-mata',
						'controller' => 'PenilaianMedisMataController@actionIndex',
						'name' => 'penilaian_medis_Mata',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-mata/create',
						'controller' => 'PenilaianMedisMataController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-mata/form_update',
						'controller' => 'PenilaianMedisMataController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-mata/update',
						'controller' => 'PenilaianMedisMataController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-mata/delete',
						'controller' => 'PenilaianMedisMataController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-mata/view',
						'controller' => 'PenilaianMedisMataController@actionView',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'Rawat Jalan Penilaian | Medis Penyakit Dalam',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-penyakit-dalam',
						'controller' => 'PenilaianMedisPenyakitDalamController@actionIndex',
						'name' => 'penilaian_medis_penyakit-dalam',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-penyakit-dalam/create',
						'controller' => 'PenilaianMedisPenyakitDalamController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-penyakit-dalam/form_update',
						'controller' => 'PenilaianMedisPenyakitDalamController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-penyakit-dalam/update',
						'controller' => 'PenilaianMedisPenyakitDalamController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-penyakit-dalam/delete',
						'controller' => 'PenilaianMedisPenyakitDalamController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-penyakit-dalam/view',
						'controller' => 'PenilaianMedisPenyakitDalamController@actionView',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'Rawat Jalan Penilaian | Medis Penyakit Neurologi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-neurologi',
						'controller' => 'PenilaianMedisNeurologiController@actionIndex',
						'name' => 'penilaian_medis_neurologi',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-neurologi/create',
						'controller' => 'PenilaianMedisNeurologiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-neurologi/form_update',
						'controller' => 'PenilaianMedisNeurologiController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-neurologi/update',
						'controller' => 'PenilaianMedisNeurologiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-neurologi/delete',
						'controller' => 'PenilaianMedisNeurologiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-neurologi/view',
						'controller' => 'PenilaianMedisNeurologiController@actionView',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'Rawat Jalan Penilaian | Medis Penyakit Bedah',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-bedah',
						'controller' => 'PenilaianMedisBedahController@actionIndex',
						'name' => 'penilaian_medis_bedah',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-bedah/create',
						'controller' => 'PenilaianMedisBedahController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-bedah/form_update',
						'controller' => 'PenilaianMedisBedahController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-bedah/update',
						'controller' => 'PenilaianMedisBedahController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-bedah/delete',
						'controller' => 'PenilaianMedisBedahController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-bedah/view',
						'controller' => 'PenilaianMedisBedahController@actionView',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'Rawat Jalan Penilaian | Medis Geriatri',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-geriatri',
						'controller' => 'PenilaianMedisGeriatriController@actionIndex',
						'name' => 'penilaian_medis_geriatri',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-geriatri/create',
						'controller' => 'PenilaianMedisGeriatriController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-geriatri/form_update',
						'controller' => 'PenilaianMedisGeriatriController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-geriatri/update',
						'controller' => 'PenilaianMedisGeriatriController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-geriatri/delete',
						'controller' => 'PenilaianMedisGeriatriController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-geriatri/view',
						'controller' => 'PenilaianMedisGeriatriController@actionView',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'Rawat Jalan Penilaian | Medis Orthopedi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/penilaian-medis-orthopedi',
						'controller' => 'PenilaianMedisOrthopediController@actionIndex',
						'name' => 'penilaian_medis_orthopedi',
						'middleware' => '',
					], [
						'type' => 'create',
						'method' => 'post',
						'url' => '/penilaian-medis-orthopedi/create',
						'controller' => 'PenilaianMedisOrthopediController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/penilaian-medis-orthopedi/form_update',
						'controller' => 'PenilaianMedisOrthopediController@formUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/penilaian-medis-orthopedi/update',
						'controller' => 'PenilaianMedisOrthopediController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/penilaian-medis-orthopedi/delete',
						'controller' => 'PenilaianMedisOrthopediController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/penilaian-medis-orthopedi/view',
						'controller' => 'PenilaianMedisOrthopediController@actionView',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'Antrian Farmasi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/antrian-farmasi-petugas',
						'controller' => 'AntrianFarmasiController@index',
						'name' => 'antrian-farmasi-petugas',
						'middleware' => '',
					],
					[
						'type' => 'Penyerahan Obat',
						'method' => 'post',
						'url' => '/antrian-farmasi-petugas/penyerahan-resep',
						'controller' => 'AntrianFarmasiController@penyerahanResep',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Berkas digital | Berkas digital',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/berkas-digital',
						'controller' => 'BerkasDigitalController@index',
						'name' => 'berkas-digital',
						'middleware' => '',
					],
					[
						'type' => 'Data Klaim',
						'method' => 'get',
						'url' => '/berkas-digital/data-klaim',
						'controller' => 'BerkasDigitalController@actionViewKlaim',
						'name' => '',
						'middleware' => '',
					],

					[
						'type' => 'Upload Berkas',
						'method' => 'post',
						'url' => '/berkas-digital/unggah',
						'controller' => 'BerkasDigitalController@actionUploadFile',
						'name' => '',
						'middleware' => '',
					],

					[
						'type' => 'Hapus Data Upload',
						'method' => 'post',
						'url' => '/berkas-digital/hapus',
						'controller' => 'BerkasDigitalController@actionDeleteFile',
						'name' => '',
						'middleware' => '',
					],

					[
						'type' => 'Dowload Data Klaim',
						'method' => 'get',
						'url' => '/berkas-digital/unduh_klaim_berkas',
						'controller' => 'BerkasDigitalController@actionDownloadViewKlaimPDF',
						'name' => '',
						'middleware' => '',
					],

					[
						'type' => 'Dowload Data Upload',
						'method' => 'get',
						'url' => '/berkas-digital/unduh_berkas',
						'controller' => 'BerkasDigitalController@actionDownloadPatientFiles',
						'name' => '',
						'middleware' => '',
					],

					[
						'type' => 'Dowload Semua Berkas',
						'method' => 'get',
						'url' => '/berkas-digital/unduh_semua_berkas',
						'controller' => 'BerkasDigitalController@actionDownloadAllViewKlaim',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Berkas digital | Master Berkas Digital',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/berkas-digital-master-berkas',
						'controller' => 'MasterBerkasDigitalController@actionIndex',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/berkas-digital-master-berkas/create',
						'controller' => 'MasterBerkasDigitalController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/berkas-digital-master-berkas/update',
						'controller' => 'MasterBerkasDigitalController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/berkas-digital-master-berkas/delete',
						'controller' => 'MasterBerkasDigitalController@actionDelete',
						'name' => '',
						'middleware' => '',
					],

				]
			],
			[
				'title' => 'Berkas digital | Setting Berkas Klaim',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/berkas-digital-berkas-klaim',
						'controller' => 'SettingBerkasKlaimController@actionIndex',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/berkas-digital-berkas-klaim/update',
						'controller' => 'SettingBerkasKlaimController@actionUpdate',
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
						'method' => 'post',
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
				'title' => 'Inventori | Setting Verifikasi Permintaan Barang',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/master-validasi-permintaan-barang',
						'controller' => 'MasterValidasiPermintaanBarangController@actionIndex',
						'name' => 'master_validasi_permintaan_barang',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/master-validasi-permintaan-barang/create',
						'controller' => 'MasterValidasiPermintaanBarangController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/master-validasi-permintaan-barang/update',
						'controller' => 'MasterValidasiPermintaanBarangController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/master-validasi-permintaan-barang/delete',
						'controller' => 'MasterValidasiPermintaanBarangController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/master-validasi-permintaan-barang/ajax',
						'controller' => 'MasterValidasiPermintaanBarangController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],

			[
				'title' => 'Inventori | Kode Barang Non Medis',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/kode-barang-non-medis-penunjang',
						'controller' => 'KodeBarangNonMedisPenunjangController@actionIndex',
						'name' => 'kode_barang_non_medis_penunjang',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/kode-barang-non-medis-penunjang/create',
						'controller' => 'KodeBarangNonMedisPenunjangController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/kode-barang-non-medis-penunjang/update',
						'controller' => 'KodeBarangNonMedisPenunjangController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/kode-barang-non-medis-penunjang/delete',
						'controller' => 'KodeBarangNonMedisPenunjangController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Inventori | Data Barang Non Medis',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/barang-non-medis',
						'controller' => 'BarangNonMedisController@actionIndex',
						'name' => 'barang_non_medis',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/barang-non-medis/create',
						'controller' => 'BarangNonMedisController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/barang-non-medis/update',
						'controller' => 'BarangNonMedisController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/barang-non-medis/delete',
						'controller' => 'BarangNonMedisController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
				]
			],

			[
				'title' => 'Inventori | Permintaan Barang Non Medis',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/permintaan-barang-non-medis',
						'controller' => 'PermintaanBarangNonMedisController@actionIndex',
						'name' => 'permintaan_barang_non_medis',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/permintaan-barang-non-medis/create',
						'controller' => 'PermintaanBarangNonMedisController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/permintaan-barang-non-medis/update',
						'controller' => 'PermintaanBarangNonMedisController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Verikasi',
						'method' => ['get', 'post'],
						'url' => '/permintaan-barang-non-medis/verifikasi',
						'controller' => 'PermintaanBarangNonMedisController@actionVerifikasi',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/permintaan-barang-non-medis/delete',
						'controller' => 'PermintaanBarangNonMedisController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/permintaan-barang-non-medis/view',
						'controller' => 'PermintaanBarangNonMedisController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/permintaan-barang-non-medis/ajax',
						'controller' => 'PermintaanBarangNonMedisController@ajax',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'cetak',
						'method' => 'get',
						'url' => '/permintaan-barang-non-medis/unduh_berkas',
						'controller' => 'PermintaanBarangNonMedisController@actionUnduhBerkas',
						'name' => '',
						'middleware' => '',
					]
					// [
					// 	'type'=>'Full Akses Admin',
					// 	'method'=>'get',
					// 	'url'=>'/permintaan-barang-non-medis/fullAkses',
					// 	'controller'=>'PermintaanBarangNonMedisController@fullAkses',
					// 	'name'=>'',
					// 	'middleware'=>'',
					// ],
				]
			],
            [
				'title' => 'Inventori | Stok Opname Barang Non Medis',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/stokopname-barang-non-medis',
						'controller' => 'StokOpnameBarangNonMedisController@actionIndex',
						'name' => 'stokopname_barang_non_medis',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/stokopname-barang-non-medis/create',
						'controller' => 'StokOpnameBarangNonMedisController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/stokopname-barang-non-medis/update',
						'controller' => 'StokOpnameBarangNonMedisController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/stokopname-barang-non-medis/delete',
						'controller' => 'StokOpnameBarangNonMedisController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/stokopname-barang-non-medis/view',
						'controller' => 'StokOpnameBarangNonMedisController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/stokopname-barang-non-medis/ajax',
						'controller' => 'StokOpnameBarangNonMedisController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Inventori | Verifikasi Barang Non Medis',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/verifikasi-permintaan-barang-non-medis',
						'controller' => 'VerifikasiPermintaanBarangNonMedisController@actionIndex',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'view',
						'method' => 'get',
						'url' => '/verifikasi-permintaan-barang-non-medis/view',
						'controller' => 'VerifikasiPermintaanBarangNonMedisController@actionView',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Verikasi',
						'method' => ['get', 'post'],
						'url' => '/verifikasi-permintaan-barang-non-medis/verifikasi',
						'controller' => 'VerifikasiPermintaanBarangNonMedisController@actionVerifikasi',
						'name' => '',
						'middleware' => '',
					],
					[
						'type'=>'system',
						'method'=>'get',
						'url'=>'/verifikasi-permintaan-barang-non-medis/ajax',
						'controller'=>'VerifikasiPermintaanBarangNonMedisController@ajax',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type' => 'cetak',
						'method' => 'get',
						'url' => '/verifikasi-permintaan-barang-non-medis/unduh_berkas',
						'controller' => 'VerifikasiPermintaanBarangNonMedisController@actionUnduhBerkas',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title'=>'Inventori | Verifikasi Inventori Barang Non Medis',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/verifikasi-inventori-permintaan-barang-non-medis',
						'controller'=>'VerifikasiInventoriPermintaanBarangNonMedisController@actionIndex',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'view',
						'method'=>'get',
						'url'=>'/verifikasi-inventori-permintaan-barang-non-medis/view',
						'controller'=>'VerifikasiInventoriPermintaanBarangNonMedisController@actionView',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'Verikasi',
						'method'=>['get','post'],
						'url'=>'/verifikasi-inventori-permintaan-barang-non-medis/verifikasi',
						'controller'=>'VerifikasiInventoriPermintaanBarangNonMedisController@actionVerifikasi',
						'name'=>'',
						'middleware'=>'',
					],
					// [
					// 	'type'=>'Ubah Verifikasi',
					// 	'method'=>'get',
					// 	'url'=>'/verifikasi-inventori-permintaan-barang-non-medis/fullAkses',
					// 	'controller'=>'VerifikasiInventoriPermintaanBarangNonMedisController@fullAkses',
					// 	'name'=>'',
					// 	'middleware'=>'',
					// ],
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/verifikasi-inventori-permintaan-barang-non-medis/ajax',
						'controller' => 'VerifikasiInventoriPermintaanBarangNonMedisController@ajax',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'cetak',
						'method' => 'get',
						'url' => '/verifikasi-inventori-permintaan-barang-non-medis/unduh_berkas',
						'controller' => 'VerifikasiInventoriPermintaanBarangNonMedisController@actionUnduhBerkas',
						'name' => '',
						'middleware' => '',
					]

				]
			],
			[
				'title'=>'Daftar List Display Monitor',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/daftar-list-display-monitor',
						'controller'=>'DaftarListDisplayMonitorController@actionIndex',
						'name'=>'',
						'middleware'=>'',
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
			[
				'title'=>'Setting API Aplikasi',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/setting-api-aplikasi',
						'controller'=>'SettingApiAplikasiController@actionIndex',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
            [
				'title'=>'Setting Tarif Buffer',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/setting-tarif-buffer',
						'controller'=>'SettingBufferController@actionIndex',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'create',
						'method'=>['get','post'],
						'url'=>'/setting-tarif-buffer/create',
						'controller'=>'SettingBufferController@actionCreate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'update',
						'method'=>['get','post'],
						'url'=>'/setting-tarif-buffer/update',
						'controller'=>'SettingBufferController@actionUpdate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'delete',
						'method'=>'delete',
						'url'=>'/setting-tarif-buffer/delete',
						'controller'=>'SettingBufferController@actionDelete',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
            [
				'title'=>'Master Data Diagnosa',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/master-data-diagnosa',
						'controller'=>'MasterDataDiagnosaController@actionIndex',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'create',
						'method'=>['get','post'],
						'url'=>'/master-data-diagnosa/create',
						'controller'=>'MasterDataDiagnosaController@actionCreate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'update',
						'method'=>['get','post'],
						'url'=>'/master-data-diagnosa/update',
						'controller'=>'MasterDataDiagnosaController@actionUpdate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'delete',
						'method'=>'delete',
						'url'=>'/master-data-diagnosa/delete',
						'controller'=>'MasterDataDiagnosaController@actionDelete',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
            [
				'title'=>'Data Pasien Grouper',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/tarif-grouper-pasien',
						'controller'=>'TarifGrouperPasienController@actionIndex',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'create',
						'method'=>['get','post'],
						'url'=>'/tarif-grouper-pasien/create',
						'controller'=>'SettingAppVariabelController@actionCreate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'update',
						'method'=>['get','post'],
						'url'=>'/tarif-grouper-pasien/update',
						'controller'=>'SettingAppVariabelController@actionUpdate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'delete',
						'method'=>'delete',
						'url'=>'/tarif-grouper-pasien/delete',
						'controller'=>'SettingAppVariabelController@actionDelete',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
			[
				'title'=>'Setting Data Monitor Poli',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/setting-monitor-poli',
						'controller'=>'SettingMonitorPoliController@actionIndex',
						'name'=>'set_poli',
						'middleware'=>'',
					],
					[
						'type'=>'create',
						'method'=>['get','post'],
						'url'=>'/setting-monitor-poli/create',
						'controller'=>'SettingMonitorPoliController@actionCreate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'update',
						'method'=>['get','post'],
						'url'=>'/setting-monitor-poli/update',
						'controller'=>'SettingMonitorPoliController@actionUpdate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'delete',
						'method'=>'delete',
						'url'=>'/setting-monitor-poli/delete',
						'controller'=>'SettingMonitorPoliController@actionDelete',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],

			[
				'title'=>'Antrian Poliklinik',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/antrian-poliklinik-petugas',
						'controller'=>'AntrianPoliController@actionIndex',
						'name'=>'antrian-poliklinik-petugas',
						'middleware'=>'',
					],
					[
						'type' => 'Panggilan Suara dan Mute',
						'method' => 'post',
						'url' => '/antrian-poliklinik-petugas/masuk-monitor',
						'controller' => 'AntrianPoliController@actionPanggilMute',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'Berkas Diterima',
						'method' => 'delete',
						'url' => '/antrian-poliklinik-petugas/update',
						'controller' => 'AntrianPoliController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
                'title' => 'SOAP Farmasi',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/soap-farmasi',
                        'controller' => 'SOAPFarmasiController@actionIndex',
                        'name' => 'soap-farmasi',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'create',
                        'method' => 'post',
                        'url' => '/soap-farmasi/create',
                        'controller' => 'SOAPFarmasiController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'form',
                        'method' => 'get',
                        'url' => '/soap-farmasi/form_update',
                        'controller' => 'SOAPFarmasiController@formUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => 'post',
                        'url' => '/soap-farmasi/update',
                        'controller' => 'SOAPFarmasiController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/soap-farmasi/delete',
                        'controller' => 'SOAPFarmasiController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'view',
                        'method' => 'get',
                        'url' => '/soap-farmasi/view',
                        'controller' => 'SOAPFarmasiController@actionView',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
			[
                'title' => 'Berkas Soap Farmasi',
                'item' => [
                    [
                        'type' => 'index',
                        'method' => 'get',
                        'url' => '/soap-farmasi-berkas',
                        'controller' => 'SOAPFarmasiBerkasController@actionIndex',
                        'name' => 'soap-farmasi-berkas',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'Data SOAP',
                        'method' => 'get',
                        'url' => '/soap-farmasi-berkas/data-soap-farmasi',
                        'controller' => 'SoapFarmasiBerkasController@actionViewSOAP',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'Dowload Data SOAP Farmasi',
                        'method' => 'get',
                        'url' => '/soap-farmasi-berkas/unduh_soap_farmasi',
                        'controller' => 'SoapFarmasiBerkasController@actionDownloadViewSOAPPDF',
                        'name' => '',
                        'middleware' => '',
                    ],
                ]
            ],
			[
				'title'=>'Antrean Online Perhari',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/antrol-pertanggal',
						'controller'=>'ListAntrolBpjsController@actionIndex',
						'name'=>'antrol-pertanggal',
						'middleware'=>'',
					],
				]
			],
			[
				'title'=>'TaskID Manual',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/taskid-bpjs-manual',
						'controller'=>'TaskidBpjsManualController@actionIndex',
						'name'=>'taskid-bpjs-manual',
						'middleware'=>'',
					],
					[
						'type'=>'Kirim TaskID',
						'method'=>'delete',
						'url'=>'/taskid-bpjs-manual/kirim',
						'controller'=>'TaskidBpjsManualController@actionCreate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'Insert Antrean',
						'method'=>'post',
						'url'=>'/taskid-bpjs-manual/insert',
						'controller'=>'TaskidBpjsManualController@actionInsertAntrean',
						'name'=>'',
						'middleware'=>'',
					],
					[
                        'type' => 'form',
                        'method' => 'get',
                        'url' => '/taskid-bpjs-manual/form_taskid_all',
                        'controller' => 'TaskidBpjsManualController@formTaskIDAll',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'update',
                        'method' => 'post',
                        'url' => '/taskid-bpjs-manual/update_all',
                        'controller' => 'TaskidBpjsManualController@updateAll',
                        'name' => '',
                        'middleware' => '',
                    ],
				]
			],
			[
				'title'=>'TaskID Mobile JKN',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/taskid-antrol',
						'controller'=>'ListTaskidBpjsController@actionIndex',
						'name'=>'taskid-antrol',
						'middleware'=>'',
					],
				]
			],
			[
				'title'=>'Jadwal Dokter HFIS',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/jadwal-dokter-hfis',
						'controller'=>'JadwalDokterHfisBpjsController@actionIndex',
						'name'=>'jadwal-dokter-hfis',
						'middleware'=>'',
					],
				]
			],
			[
				'title'=>'Dashboard Antrol BPJS Per Hari',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/dashboard-antrol-perhari',
						'controller'=>'DashboardAntrolBpjsPerhariController@actionIndex',
						'name'=>'dashboard-antrol-perhari',
						'middleware'=>'',
					],
				]
			],
			[
				'title'=>'Dashboard Antrol BPJS Per Bulan',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/dashboard-antrol-perbulan',
						'controller'=>'DashboardAntrolBpjsPebulanController@actionIndex',
						'name'=>'dashboard-antrol-perbulan',
						'middleware'=>'',
					],
				]
			],

			[
				'title'=>'Olah Data Tagihan | Billing Pasien Ralan',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/billing-list-tagihan-pasien-ralan',
						'controller'=>'BillingListTagihanPasienRalanController@actionIndex',
						'name'=>'billing-list-tagihan-pasien-ralan',
						'middleware'=>'',
					],
				]
			],

			[
				'title'=>'Olah Data Tagihan | Billing Pasien Ranap',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/billing-list-tagihan-pasien-ranap',
						'controller'=>'BillingListTagihanPasienRanapController@actionIndex',
						'name'=>'billing_list_tagihan_pasien_ranap',
						'middleware'=>'',
					],
					[
                        'type' => 'view',
                        'method' => 'get',
                        'url' => '/billing-list-tagihan-pasien-ranap/view',
                        'controller' => 'BillingListTagihanPasienRanapController@actionView',
                        'name' => '',
                        'middleware' => '',
                    ],
					[
						'type' => 'Pindah Kamar',
						'method'=>['get','post','delete'],
						'url' => '/pindah-kamar-pasien-ranap',
						'controller' => 'PindahKamarPasienRanapController@actionIndex',
						'name' => 'pindah_kamar_pasien_ranap',
						'middleware' => '',
					],
					[
						'type'=> 'Cetak Struk Pindah Kamar',
						'method' => 'get',
						'url' => '/pindah-kamar-pasien-ranap/cetak',
						'controller' => 'PindahKamarPasienRanapController@actionCetak',
						'name' => '',
						'middleware' => ''
					],
				]
			],
			[
                'title' => 'TB',
                'item' => [
                    [
                        'type' => 'create',
                        'method' => 'post',
                        'url' => '/TB/create',
                        'controller' => 'TBController@actionCreate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'view',
                        'method' => 'get',
                        'url' => '/TB/view',
                        'controller' => 'TBController@actionView',
                        'name' => '',
                        'middleware' => '',
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
