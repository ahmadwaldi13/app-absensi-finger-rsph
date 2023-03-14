<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\RegPeriksa;
use App\Models\RujukMasuk;

use App\Models\ResepObat;
use App\Models\Kamar;
use App\Models\Jadwal;
use App\Models\PoliKlinik;
use App\Models\UxuiLokasiEmergensi;
use App\Models\Pasien;

use App\Services\ResponseFormatter;
use App\Services\RegistrasiService;
use App\Services\RekamMedisService;


class ApiBridgingEPasien extends Controller
{
    public function __construct(
    ){
        $this->responseFormatter = new ResponseFormatter;
        $this->registrasiService = new RegistrasiService;
        $this->rekamMedisService = new RekamMedisService;
    }

    public function cek_login(Request $request){
        $token = $request->header('X-key');
        
        if(md5($token)=='a5ad4addc8dd5ed3d7d66f4cf93bf9e3'){
            $RM = $request->no_rkm_medik;
            $nik = $request->nik;
            $tgl_lahir = $request->tgl_lahir;
            $query = $this->registrasiService->cek_pasien($RM,$nik,$tgl_lahir);
            return $this->responseFormatter->success($query,'Ok');
        }else{
            return $this->responseFormatter->error(null,'Token Salah',201);
        }
    }

    // ============================ Pendaftaran Berobat ===============================
    public function pendaftaran_berobat(Request $request){
        $token = $request->header('X-key');
        if($token=='majumundurok'){
            $message_default=[
                'success'=>'Data berhasil disimpan',
                'error'=>'Terjadi kesalahan saat pemrosesan data'
            ];
            DB::beginTransaction();

            $no_rkm_medis 	= $request->no_rkm_medis;
            $birthday     	= $request->tgl_lahir;
            $tgl_registrasi	= $request->tgl_rencana_berobat;
            $kd_poli		= $request->kd_poli;
            $kd_dokter		= $request->kd_dokter;
            $kd_pj		    = $request->referensi_jns_bayar;
            $asalrujukan    = $request->asalrujukan?$request->asalrujukan:'-';
            
            $messages = [
                'required' => ':attribute wajib diisi!!!',
                'tgl_lahir' => ':attribute wajib diisi dengan format Y-m-d',
                'tgl_rencana_berobat' => ':attribute wajib diisi dengan format Y-m-d'

            ];

            $val = Validator::make(
                $request->all(),
                [
                    'no_rkm_medis' => 'required',
                    'tgl_lahir' => 'date_format:"Y-m-d"|required',
                    'tgl_rencana_berobat' => 'date_format:"Y-m-d"|required',
                    'kd_poli' => 'required',
                    'kd_dokter' => 'required',
                    'referensi_jns_bayar' => 'required',
                    'asalrujukan' => 'required'
                ],$messages
            );

            if ($val->fails()) {
                return $this->responseFormatter->error($val->errors(),'Token Salah',201);
            }

            if($tgl_registrasi < date('Y-m-d')){
                return $this->responseFormatter->error(null,'Tanggal berobat tidak terhitung mundur',201);
            }

            try {
                if($kd_pj!=='BPJ'){
                    $paramater=[
                        'no_rkm_medis'=>$no_rkm_medis
                    ];

                    $cekpasien   = $this->registrasiService->getPasien($paramater,1)->where('tgl_lahir',$birthday)->first();
                    if(!$cekpasien)
                    return $this->responseFormatter->error(null,'No rekam medis tidak terdaftar, cek kembali no rekam medis dan tanggal lahir pasien',201);
                    
                    //====================================== Status Daftar ===================================//
                    $cek_daftar   = $this->rekamMedisService->getRegPeriksa($paramater,1)->first();
                    
                    // return $this->responseFormatter->success('no rawat',$cek_daftar);
                    $stts_daftar = null;
                    if ($cek_daftar) {
                        if($cek_daftar->no_reg > 0){
                            $stts_daftar = 'Lama';
                        }else{
                            $stts_daftar = 'Baru';
                        }
                    }else{
                        $stts_daftar = 'Baru';
                    }

                    
                    //===================================== Hitung Umur ======================================//
                    $biday = new \DateTime($birthday);
                    $today = new \DateTime();
                    $diff = $today->diff($biday);
                    if ($diff->y < 0) {
                        $umur 		= $diff->m;
                        $stts_umur  = 'Bl';
                    }elseif ($diff->m < 0) {
                        $umur = $diff->d;
                        $stts_umur  = 'Hr';
                    }else{
                        $umur = $diff->y;
                        $stts_umur  = 'Th';
                    }

                    //=================================== No Registrasi =======================================//
        
                    $no_reg_akhir   = $this->rekamMedisService->getRegPeriksa(['kd_dokter'=>$kd_dokter],1)->first();
            
                    $no_urut_reg = sprintf('%03d', $no_reg_akhir->max('no_reg')+1);
                    $null = 0;
                    if ($no_urut_reg == $null ){
                        $no_urut_reg = 1;
                    } else {
                        $no_urut_reg = sprintf("%03d", $no_urut_reg);
                    } 

                    $no_reg = sprintf("%03d", $no_urut_reg);

                    //===================================== No Rawat =================================================//
                    $no_rawat_akhir = $this->rekamMedisService->getRegPeriksa(['tgl_registrasi'=>$tgl_registrasi],1)->first();
                    $no_rawat       = str_replace('-', '/', $tgl_registrasi).'/'.sprintf('%06d',$no_rawat_akhir->no_rawat_max + 1); 
                            
                    //======================================= Status Poli =============================================//
                    $status_poli   = $this->rekamMedisService->getRegPeriksa(['kd_poli'=>$kd_poli,'no_rkm_medis'=>$no_rkm_medis],1,'and')->first();
                    if ($status_poli->no_rawat > 0) {
                        $status_poli = 'Lama';
                    } else {
                        $status_poli = 'Baru';
                    }

                    //======================================= Biaya Registrasi ========================================//

                    $query = $this->registrasiService->getPoliklinik(['kd_poli'=> $kd_poli],1)->first();
                    if ($stts_daftar == 'Lama') {
                        $reg_biaya = $query->registrasilama; 
                    } else {
                        $reg_biaya = $query->registrasi; 
                    }

                    $pasien      = Pasien::where('no_rkm_medis',$no_rkm_medis)->first();

                    //======================================= Data Array ==============================================//

                    $data = [	
                        'no_reg'       		=> $no_reg,
                        'no_rawat'	   		=> $no_rawat,
                        'tgl_registrasi'	=> $tgl_registrasi,
                        'jam_reg'			=> date('H:i:s'),
                        'kd_dokter'	   		=> $kd_dokter, 
                        'no_rkm_medis' 		=> $pasien->no_rkm_medis,
                        'kd_poli'      		=> $kd_poli,
                        'p_jawab'			=> $pasien->namakeluarga,
                        'almt_pj'			=> $pasien->alamatpj,
                        'hubunganpj'		=> $pasien->keluarga,
                        'biaya_reg'			=> $reg_biaya,
                        'stts'				=> 'Belum',
                        'stts_daftar'  		=> $stts_daftar,
                        'status_lanjut'		=> 'Ralan',
                        'kd_pj'        		=> $kd_pj,
                        'umurdaftar'   		=> $umur,
                        'sttsumur'    		=> $stts_umur,
                        'status_bayar'		=> 'Belum Bayar',
                        'status_poli'		=> $status_poli
                    ];

                    $DataRujukan = [
                        'no_rawat' 		=> $no_rawat,
                        'perujuk'		=> $asalrujukan,
                        'alamat'		=> '-',
                        'no_rujuk' 		=> '-',
                        'jm_perujuk'	=> '0',	
                        'dokter_perujuk'=> '-',	
                        'kd_penyakit'	=> null,
                        'kategori_rujuk'=> '-',
                        'keterangan'	=> '-',
                        'no_balasan'	=> '-'
                    ];

                    $check_save = 0;
                    $req_periksa = new RegPeriksa();
                    $req_periksa->set_model_with_data($data);


                    $rujukan = new RujukMasuk();
                    $rujukan->set_model_with_data($DataRujukan);

                    if($req_periksa->save() && $rujukan->save()){
                        $check_save=1;     
                    }
                    $response =
                        (object)[
                            'no_reg'       		=> $no_reg,
                            'no_rawat'	   		=> $no_rawat,
                            'tgl_registrasi'	=> $tgl_registrasi
                        ]
                    ;

                    if($check_save){
                        DB::commit();
                        return $this->responseFormatter->success($response, $message_default['success']);
                    }else{
                        DB::rollBack();
                        return $this->responseFormatter->error(null,$message_default['error'],201);
                    }
                }else{
                    return $this->responseFormatter->error(null,'Pasien BPJS harap mendaftar melalui mobile JKN',201);
                }
            } catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                if($e->errorInfo[1] == '1062'){
                }
                return $this->responseFormatter->error(null,$message_default['error'],201);
            
            } catch (\Throwable $e) {
                DB::rollBack();
                return $this->responseFormatter->error(null,$message_default['error'],201);
            }
        }
        
        else{
            return $this->responseFormatter->error(null,'Token Salah',201);
        }
    }


    //=================================================== Cek Antrian Poli =========================================//

    public function cek_antrian_poli(Request $request,$no_rkm_medis){
        $token = $request->header('X-key');
        if(md5($token)=='a5ad4addc8dd5ed3d7d66f4cf93bf9e3'){
            $tgl_registrasi = date('Y-m-d');
            $paramater=[
                'reg_periksa.no_rkm_medis'=>$no_rkm_medis,
                'reg_periksa.tgl_registrasi'=>$tgl_registrasi,
            ];
            $data   = $this->registrasiService->cek_antrian_poli($paramater,'and')->first();

            if (is_null($data)) {
                return $this->responseFormatter->error(null ,'Tidak Ada Antrian, Atau Mungkin Antrian Sudah Lewat',202);
	        } else {
                $poli_cod = $data->kd_poli;
		        $tgl_reg2 = $data->tgl_registrasi;

                //Nomor Urut Antri //
                $get_call_in = RegPeriksa::where('kd_poli',$poli_cod)->where('tgl_registrasi',$tgl_reg2)->where('stts','Belum')->orderBy('no_reg','DESC')->get();
                $call_in=$get_call_in->max('no_reg');

                $call_in1 = $call_in;
		        $no_reg   = $data->no_reg;
                
                
                //End Nomor Urut Antri //
		        $max_antri = $get_call_in->max('no_reg');

                if (empty($max_antri)) {
		            $sisa_antrian2 = 0;
		        }else if($data->stts == 'Sudah'){
		            $sisa_antrian2 = 'Sudah Dilayani';
		        } else {
		            $sisa_antrian2 = abs($no_reg - $max_antri -1);
		        }
		        
		        if ($data['stts'] == 'Sudah') {
		            $sedengan_panggil = 'Sudah Selesai';
		        } else {
		            $sedengan_panggil = $data->kd_poli."-".$call_in1;
		        }

                $response = 
                    (object)[
                        'nomorantrean'   => $data->kd_poli."-".$data->no_reg,
                        'namapoli'       => $data->nm_poli,
                        'namadokter'     => $data->nm_dokter,
                        'sisaantrean'    => $sisa_antrian2,
                        'antreanpanggil' => $sedengan_panggil,
                        'statusantrian'  => $data->stts,
                        'keterangan'     => "Datanglah Minimal 30 Menit, Dan Segera Melakukan Chekin ke RSUD Aceh Tamiang"
                    ];
            }
            return $this->responseFormatter->success($response ,'Ok');
        }
        else{
            return $this->responseFormatter->error(null,'Token Salah',201);
        }
    }

    //=================================================== Cek Antrian Resep =========================================//
    public function cek_antrian_resep(Request $request,$no_rkm_medis){
        $token = $request->header('X-key');
        if(md5($token)=='a5ad4addc8dd5ed3d7d66f4cf93bf9e3'){
            // $no_rkm_medis 	= $request->no_rkm_medis;
            $tgl_registrasi = date('Y-m-d');
            
		    $getno_rawat = RegPeriksa::where('no_rkm_medis',$no_rkm_medis)
            ->where('tgl_registrasi',$tgl_registrasi)
            ->orderBy('tgl_registrasi','DESC')
            ->first();
            if($getno_rawat){
                $query = ResepObat::where('no_rawat',$getno_rawat->no_rawat)
                ->select('resep_obat.*','dokter.nm_dokter')
                ->join('dokter','resep_obat.kd_dokter', '=', 'dokter.kd_dokter')
                ->orderBy('tgl_peresepan','DESC')
                ->first();
            }else{
                $query =null;
            }
            
            if (empty($query)) {
                return $this->responseFormatter->error(null ,'Antrian Resep Tidak Ditemukan, Atau Tidak Ada Antrian Resep',202);
				
			}else{
               
				if ($query->status_resep == 'Belum') {
					$stts_resep = 'Belum Selesai';
				} else {
					$stts_resep = 'Sudah Selesai';
				}

                $response =[
                    (object)[
                        'no_resep'      => $query->no_resep,
                        'tgl_peresepan' => $query->tgl_peresepan,
                        'jam'           => $query->jam,
                        'status_resep'  => $stts_resep,
                        'dokter_peresep'=> $query->nm_dokter
                    ],
                ];
                return $this->responseFormatter->success($response ,'Ok');
			}
        }
        else{
            return $this->responseFormatter->error(null,'Token Salah',201);
        }
    }

    //=================================================== Informasi Kamar =========================================//
    public function informasi_kamar(Request $request){
        $token = $request->header('X-key');
        if(md5($token)=='a5ad4addc8dd5ed3d7d66f4cf93bf9e3'){

            $query= kamar::
                select('kamar.kd_kamar','kamar.trf_kamar','kamar.status','bangsal.kd_bangsal','bangsal.nm_bangsal')
                ->join('bangsal','bangsal.kd_bangsal','=','kamar.kd_bangsal')
                ->orderBy('bangsal.kd_bangsal','DESC')
            ;
            
			if (empty($query)) {
                return $this->responseFormatter->error(null,'Tidak ada kamar yang tersedia',202);
			}else{
                return $this->responseFormatter->success($query->get() ,'Ok');
			}

		}else{
			return $this->responseFormatter->error(null,'Token Salah',201);
		}
	}
    //=================================================== Referensi Dokter =========================================//
    function get_referensi_dokter_poli($hari_kerja, $kd_poli){
        $query = Jadwal::
            select('jadwal.kd_dokter','poliklinik.nm_poli','dokter.nm_dokter','jadwal.hari_kerja','jadwal.jam_mulai','jadwal.jam_selesai')
            ->join('dokter', 'jadwal.kd_dokter','=','dokter.kd_dokter')
            ->join('poliklinik', 'poliklinik.kd_poli','=','jadwal.kd_poli')
            ->where('jadwal.hari_kerja', $hari_kerja)
            ->where('jadwal.kd_poli', $kd_poli);

        return $query->get();
    
    }
    public function referensi_dokter(Request $request){
        $token = $request->header('X-key');
        if(md5($token)=='a5ad4addc8dd5ed3d7d66f4cf93bf9e3'){
            $hari 	= $request->tgl_rencana_berobat;
	    	$kd_poli = $request->kd_poli;
            
            $cekpoli = PoliKlinik::where('kd_poli',$kd_poli)->first();
            if(!$cekpoli){
                return $this->responseFormatter->error(null,'Poli Tidak Tersedia',202);
            }
            $date = Carbon::createFromFormat('Y-m-d', $hari);
			$hari = (new \App\Http\Traits\GlobalFunction)->hari($date->format('D'));
            $query = $this->get_referensi_dokter_poli($hari, $kd_poli);

            return $this->responseFormatter->success($query,'Ok');
		}else{
			return $this->responseFormatter->error(null,'Token Salah',201);
		}
	}

    //=================================================== Referensi Poliklinik =========================================//
    public function referensi_poliklinik(Request $request){
        $token = $request->header('X-key');
        if(md5($token)=='a5ad4addc8dd5ed3d7d66f4cf93bf9e3'){
            $hari 	= $request->tgl_rencana_berobat;
	    	$kd_poli = $request->kd_poli;
            
            $cekpoli = PoliKlinik::where('kd_poli',$kd_poli)->first();
            if(!$cekpoli){
                return $this->responseFormatter->error(null,'Poli Tidak Tersedia',202);
            }
            $date = Carbon::createFromFormat('Y-m-d', $hari);
			$hari = (new \App\Http\Traits\GlobalFunction)->hari($date->format('D'));
            $query = $this->get_referensi_dokter_poli($hari, $kd_poli);

            return $this->responseFormatter->success($query,'Ok');
		}else{
			return $this->responseFormatter->error(null,'Token Salah',201);
		}
	}

    //=================================================== Call Ambulance ================================================//

	public function ambulance(Request $request){
        $token = $request->header('X-key');
        if(md5($token)=='a5ad4addc8dd5ed3d7d66f4cf93bf9e3'){
            DB::beginTransaction();
            try {
                

                $message_default=[
                    'success'=>'Data berhasil disimpan',
                    'error'=>'Terjadi kesalahan saat pemrosesan data'
                ];
                
                $cekRegPeriksa = RegPeriksa::where('no_rkm_medis', $request->no_rkm_medis)->first();
                if(!$cekRegPeriksa){
                    return $this->responseFormatter->error(null,'Gagal Menyimpan Data No Rekam Medis tidak terdaftar',202);
                }
                $check_save = 0;

                $emergensi = new UxuiLokasiEmergensi();

                $max = DB::table('uxui_lokasi_emergensi')->max('id') + 1; 
                DB::statement("ALTER TABLE uxui_lokasi_emergensi AUTO_INCREMENT =  $max");

                $dataEmergensi = [
                    'no_rkm_medis' 	=> $request->no_rkm_medis,
                    'longitude'		=> $request->longitude,
                    'latitude'		=> $request->latitude,
                    'keluhan' 		=> $request->keluhan,
                    'created'       => '2023-02-08 15:58:19'
                ];
                $emergensi->set_model_with_data($dataEmergensi);

                if($emergensi->save()){
                    $check_save=1;     
                }

                $response =
                    (object)[
                        'no_rkm_medis' 	=> $request->no_rkm_medis,
                        'longitude'		=> $request->longitude,
                        'latitude'		=> $request->latitude,
                        'keluhan' 		=> $request->keluhan,
                     ]
                ;

                // (object)$response;

                if($check_save){
                    DB::commit();
                    return $this->responseFormatter->success($response ,'Tetap tenang dan jangan lupa berdoa, Petugas akan segera tiba dilokasi anda');
                }
                else{
                    DB::rollBack();
                    return $this->responseFormatter->error(null,'Gagal Menyimpan Data Harap Mengulangi Kembali, Pastikan anda sudah mengaktifkan GPS',201);
                }
                   
                
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                if ($e->errorInfo[1] == '1062') {
                    return $this->responseFormatter->error(null,'Maaf tidak dapat menyimpan data yang sama',201);
                }
                return $this->responseFormatter->error(null,$message_default['error'],201);
            } catch (\Throwable $e) {
                DB::rollBack();
                return $this->responseFormatter->error(null,$message_default['error'],201);
            }

		}else{
            return $this->responseFormatter->error(null,'Token Salah',201);
		}
	}
}
