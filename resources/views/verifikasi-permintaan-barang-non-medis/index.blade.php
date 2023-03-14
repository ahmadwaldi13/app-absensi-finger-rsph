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
            <div class="col-lg-12">
                <table class="table border table-responsive-tablet">
                    <tbody>
                        <tr>
                            <td style="width: 20%">Nama</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 79%">( {{ !empty($verifikator->nip) ? $verifikator->nip : ''  }} ) {{ !empty($verifikator->nm_pegawai) ? $verifikator->nm_pegawai : ''  }}</td>
                        </tr>

                        <tr>
                            <td style="width: 20%">Area Persetujuan</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 79%">{{ !empty($verifikator->list_departemen) ? $verifikator->list_departemen : ''  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    @include($router_name->path_base.'.columns')

@endsection