<?php

use Illuminate\Support\Facades\Session;
?>

@extends('layouts.master')

@section('breadcrumbs')
@include('layouts.breadcrumbs_dokter_petugas')
@endsection

@section('content')
<div>
    @include('penilaian.tab_penilaian')

    <div class="card border-top-0 px-4 py-5">
        <div class='card-body'>
            <h4 class='text-center'>Akses Hanya di berikan kepada Perawat</h4>
        </div>
    </div>
        
</div>
@endsection