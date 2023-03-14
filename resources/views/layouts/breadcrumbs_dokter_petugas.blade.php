<?php

    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
    if(!empty($item_pasien)){
        $no_rawat=!empty($item_pasien->no_rawat) ? $item_pasien->no_rawat : '';
        $no_rm=!empty($item_pasien->no_rm) ? $item_pasien->no_rm : '';
        $no_fr=!empty($item_pasien->no_fr) ? $item_pasien->no_fr : '';
        $set_url = "no_rawat=" . $no_rawat . "&no_rm=". $no_rm ."&fr=". $no_fr;
    }
// fungsi buat menghasilkan key dan sub_active secara dinamis berdasarkan string
    function breadcrumb_header_handler($key){
        $regex = sprintf("/^\/%s[\w\-]*$/i", $key);
        $matches_routes  = preg_grep($regex, (new \App\Http\Traits\AuthFunction)->getUser()->auth_user);
        $header = array_pop($matches_routes);

        // dd($header);

        function strip_special_chars($v)
        {
            return str_replace('/','',$v);
        }
        $sub_active=array_map('strip_special_chars', array_values($matches_routes));


        return empty($header) ? ['penilaian-perawat-umum', []] : [$header, $sub_active];
    }

    $penilaian_header = breadcrumb_header_handler("penilaian");

    $data_header = [
        [
            "key" => "riwayat-pasien",
            "url" => url('/')."/riwayat-pasien?".$set_url,
            "title" => "Riwayat Pasien",
            "sub_active" => null,
        ],
        [
            "key" => str_replace("/", "", $penilaian_header[0]),
            "url" => url($penilaian_header[0].'?'. $set_url),
            "title" => "Penilaian Pasien",
            "sub_active" =>$penilaian_header[1]
        ],
        [
            "key" => "isi-cppt",
            "url" => url('/')."/isi-cppt?".$set_url,
            "title" => "Isi CPPT",
            "sub_active" => ["laporan-operasi-pasien"],
        ],
        [
            "key" => "resep",
            "url" => url('/')."/resep?".$set_url,
            "title" => "Isi Resep",
            "sub_active" => ["racikan", "copy-resep"],
        ],
        [
            "key" => "patologi-klinis",
            "url" => url('/')."/patologi-klinis?".$set_url,
            "title" => "Permintaan",
            "sub_active" => ["patologi-klinis","patologi-anatomi", "pemeriksaan-radiologi"],
        ],
        [
            "key" => "tindakan-petugas",
            "url" => url('/')."/tindakan-petugas?".$set_url,
            "title" => "Tindakan Petugas",
            "sub_active" => null,
        ],
        [
            "key" => "tindakan-dokter",
            "url" => url('/')."/tindakan-dokter?".$set_url,
            "title" => "Tindakan Dokter",
            "sub_active" => null,
        ],
        [
            "key" => "jadwal-operasi-pasien",
            "url" => url('/')."/jadwal-operasi-pasien?".$set_url,
            "title" => "Jadwal Operasi",
            "sub_active" => ["laporan-operasi-pasien"],
        ],
        [
            "key" => "operasi-vk",
            "url" => url('/')."/operasi-vk?".$set_url,
            "title" => "Operasi / VK",
            "sub_active" => null,
        ],
        [
            "key" => "isi-resume",
            "url" => url('/')."/isi-resume?".$set_url,
            "title" => "Isi Resume",
            "sub_active" => null,
        ],
        [
            "key" => "check-list-pre-operasi",
            "url" => url('/')."/check-list-pre-operasi?".$set_url,
            "title" => "RM-operasi",
            "sub_active" => ["check-list-pre-operasi","signin-sebelum-anestesi","timeout-sebelum-insisi","sign-out-sebelum-menutup-luka","data-check-list-post-operasi"],
        ],
        [
            "key" => "soap-farmasi",
            "url" => url('/')."/soap-farmasi?".$set_url,
            "title" => "SOAP Farmasi",
            "sub_active" => ["laporan-operasi-pasien"],
        ],
    ];

    if($item_pasien->no_fr=='rp'){
        foreach($data_header as $key_v => $val){
            if(!empty($val['title'])){
                if(trim(str_replace(" ",'',strtolower($val['title'])))  =='penilaianpasien' ){
                    unset($data_header[$key_v]);
                }
            }
        }
        $data_header = array_values($data_header);
    }

    $data_header=(new \App\Http\Traits\AuthFunction)->checkMenuAkses($data_header);
?>
<style>
    .breadcrumbs ul li a{
        margin-top:5px;
        padding: 13px 0px 13px 28px;
        text-align: left;
        min-width: auto;
    }
</style>
<div>
    <div class="text-warning">
        <span class="hover-pointer btn-back">
            <img src="{{ asset('') }}icon/backwards.png" alt="">
            <span class="mx-2">Kembali ke List Pasien</span>
        </span>
    </div>

    <div class="breadcrumbs mt-3">
        <ul>
            @foreach($data_header as $key => $item)
                <?php
                    $item=(object)$item;
                    $class="";
                    if(!Request::is($item->key)){
                        if(!empty($item->sub_active)){
                            // var_dump($item->sub_active);
                            if(in_array(basename(url()->current()),$item->sub_active)){
                                $class="breadcrumbs-active";
                            }
                        }
                    }else{
                        $class="breadcrumbs-active";
                    }
                ?>
                <li class="hover-pointer"><a  href="{{ $item->url }}" class="{{ $class }}">{{ $item->title }} </a></li>
            @endforeach
        </ul>
    </div>
</div>
