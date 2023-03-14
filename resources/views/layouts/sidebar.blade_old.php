<?php
    if(isset($_GET['fr'])){
        $rw = $_GET['fr'] == 'rj';
        $rp = $_GET['fr'] == 'rp';
        $ri = $_GET['fr'] == 'ri';
    } else if(!isset($_GET['fr'])) {
        $rw = "/rawat-jalan";
        $rp = "/rujukan-poli";
        $ri = "/rawat-inap";
    } 

    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<div class="sidebar bg-dark">
    <div class="
    d-flex
    justify-content-center
    align-items-center
    my-3 mb-md-0
    text-white text-decoration-none
    " data-bs-scroll="true" data-bs-backdrop="false">
        @php
            $sidebar_header_1='';
            $sidebar_header_2='';
            $sidebar_header_3='';
            if($get_user->type_user=='dokter'){
                $sidebar_header_1='Dokter';
                $sidebar_header_2='Spesialis';
                $sidebar_header_3='DS';
            }elseif($get_user->type_user=='petugas'){
                $sidebar_header_1='Petugas';
                $sidebar_header_2='RSUD';
                $sidebar_header_3='PE';
            }

        @endphp
        <span id="title" class="fs-4 fw-semibold text-center md-show">{{ $sidebar_header_1  }} <br> {{ $sidebar_header_2 }}</span>
        <span id="title" class="fs-4 mt-3 fw-semibold text-center sm-show">{{ $sidebar_header_3 }}</span>
    </div>
    <hr class="mx-4 line" />
    <div style="height: 80vh;" classd="d-flex justify-content-center">
        <ul class="nav flex-column mt-5 mb-auto">
            <li class="nav-item">
                <a href="{{ url('/') }}" onclick="removeLocalStrg()" class="nav-link menu {{ Request::is('/') ? 'active' : '' }} text-white p-4 mb-4 fw-semibold" aria-current="page">
                    <img src="{{ asset('') }}icon/sidebar/{{ Request::is('/')  ? 'dashboard_active.png' : 'dashboard.png'}}" class="icon-sidebar" alt="">
                    <span id="menu5">Dashboard</span>
                </a>
            </li>
            @if($get_user->type_user=='dokter')
                <li class="nav-item">
                    <a href="{{ url('/') }}/rawat-jalan?start={{ date('Y-m-d') }}&end={{ date('Y-m-d') }}" id="rawatjalan" onclick="removeLocalStrg()" class="nav-link menu {{ Request::is($rw, 'rawat-jalan') ? 'active' : '' }} text-white p-4 mb-4 fw-semibold" aria-current="page">
                        <img src="{{ asset('') }}icon/sidebar/{{ Request::is($rw, 'rawat-jalan')  ? 'rawat_jalan_active.png' : 'rawat_jalan.png'}}" class="icon-sidebar" alt="">
                        <span id="menu1">Rawat Jalan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/') }}/rujukan-poli?start={{ date('Y-m-d') }}&end={{ date('Y-m-d') }}" id="rujukanpoli" onclick="removeLocalStrg()" class="nav-link menu {{ Request::is($rp, 'rujukan-poli') ? 'active' : '' }} text-white p-4 mb-4 fw-semibold" aria-current="page">
                        <img src="{{ asset('') }}icon/sidebar/{{ Request::is($rp, 'rujukan-poli')  ? 'rujukan_poli_active.png' : 'rujukan_poli.png'}}" class="icon-sidebar" alt="">
                        <span id="menu6">Rujukan Poli</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/') }}/rawat-inap?start={{ date('Y-m-d') }}&end={{ date('Y-m-d') }}" id="rawatinap" onclick="removeLocalStrg()" class="nav-link menu {{ Request::is($ri, 'rawat-inap') ? 'active' : '' }} text-white p-4 mb-4 fw-semibold">
                        <img src="{{ asset('') }}icon/sidebar/{{ Request::is($ri, 'rawat-inap')  ? 'rawat_inap_active.png' : 'rawat_inap.png'}}" class="icon-sidebar" alt="">
                        <span id="menu2">Rawat Inap</span>
                    </a>
                </li>
            @elseif($get_user->type_user=='petugas')
                <li class="nav-item">
                    <a href="{{ url('/') }}/rawat-jalan?start={{ date('Y-m-d') }}&end={{ date('Y-m-d') }}" id="rawatjalan" onclick="removeLocalStrg()" class="nav-link menu {{ Request::is($rw, 'rawat-jalan') ? 'active' : '' }} text-white p-4 mb-4 fw-semibold" aria-current="page">
                        <img src="{{ asset('') }}icon/sidebar/{{ Request::is($rw, 'rawat-jalan')  ? 'rawat_jalan_active.png' : 'rawat_jalan.png'}}" class="icon-sidebar" alt="">
                        <span class="menu-sidebar" id="menu1">Rawat Jalan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/') }}/rujukan-poli?start={{ date('Y-m-d') }}&end={{ date('Y-m-d') }}" id="rujukanpoli" onclick="removeLocalStrg()" class="nav-link menu {{ Request::is($rp, 'rujukan-poli') ? 'active' : '' }} text-white p-4 mb-4 fw-semibold" aria-current="page">
                        <img src="{{ asset('') }}icon/sidebar/{{ Request::is($rp, 'rujukan-poli')  ? 'rujukan_poli_active.png' : 'rujukan_poli.png'}}" class="icon-sidebar" alt="">
                        <span class="menu-sidebar" id="menu6">Rujukan Poli</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/') }}/rawat-inap?start={{ date('Y-m-d') }}&end={{ date('Y-m-d') }}" id="rawatinap" onclick="removeLocalStrg()" class="nav-link menu {{ Request::is($ri, 'rawat-inap') ? 'active' : '' }} text-white p-4 mb-4 fw-semibold">
                        <img src="{{ asset('') }}icon/sidebar/{{ Request::is($ri, 'rawat-inap')  ? 'rawat_inap_active.png' : 'rawat_inap.png'}}" class="icon-sidebar" alt="">
                        <span class="menu-sidebar" id="menu2">Rawat Inap</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{ url('/') }}/antrian-farmasi-petugas?start={{ date('Y-m-d') }}&end={{ date('Y-m-d') }}" id="antrianFarmasi" onclick="removeLocalStrg()" class="nav-link menu {{ Request::is($ri, 'antrian-farmasi-petugas') ? 'active' : '' }} text-white p-4 mb-4 fw-semibold">
                        <img src="{{ asset('') }}icon/sidebar/{{ Request::is($ri, 'antrian-farmasi-petugas')  ? 'antrian_farmasi_active.png' : 'antrian_farmasi.png'}}" class="icon-sidebar" alt="">
                        <span class="menu-sidebar" id="menu2">Antrian Farmasi</span>
                    </a>
                </li> -->
                @endif
                <li class="nav-item">
                <a href="{{ url('/') }}/logout" onclick="removeLocalStrg()" class="nav-link menu text-white p-4 mb-4 fw-semibold">
                    <img src="{{ asset('') }}icon/sidebar/logout.png" class="icon-sidebar" alt="">
                    <span class="menu-sidebar" id="menu3">Keluar</span>
                </a>
            </li>
            <li class="nav-item minimize" style="display: none;">
                <a id="minimize" class="nav-link hover-pointer text-white p-4 mb-4 fw-semibold" onclick="minimize()">
                    <img src="{{ asset('') }}icon/sidebar/minimize.png" class="icon-sidebar" alt="">
                    <span class="menu-sidebar" id="menu4">Minimize</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ url('/user-management') }}" onclick="removeLocalStrg()" class="nav-link menu {{ Request::is('user-management') ? 'active' : '' }} text-white p-4 mb-4 fw-semibold" aria-current="page">
                    <img src="{{ asset('') }}icon/sidebar/dashboard_active.png" class="icon-sidebar" alt="">
                    <span id="menu5">Manajemen User</span>
                </a>
            </li>
        </ul>
    </div>
</div>
@push('link-script')
<script src="{{ asset('js/sidebars.js') }}"></script>
@endpush