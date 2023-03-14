@extends('layouts.master2')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')
    <div class="card card-body">
        <div class="row justify-content-start">
            <div class="col-lg-6">
                <table class="table border table-responsive-tablet">
                    <tbody>
                        <tr>
                            <td style="width: 20%">NIP</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 79%">{{ !empty($data_pegawai->nik) ? $data_pegawai->nik : ''  }}</td>
                        </tr>

                        <tr>
                            <td style="width: 20%">Nama</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 79%">{{ !empty($data_pegawai->nama) ? $data_pegawai->nama : ''  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-lg-6">
                <table class="table border table-responsive-tablet">
                    <tbody>
                        <tr>
                            <td style="width: 20%">Jabatan</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 79%">{{ !empty($data_pegawai->jnj_jabatan) ? $data_pegawai->jnj_jabatan : ''  }}</td>
                        </tr>

                        <tr>
                            <td style="width: 20%">Departemen</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 79%">{{ !empty($data_pegawai->departemen_nama) ? $data_pegawai->departemen_nama : ''  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    @include($router_name->path_base.'.columns')

@endsection