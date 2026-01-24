@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
@include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')

@include('pengajuan.tab_pengajuan', ["active"=>2])

@section('content')
    <h1>
        Pengajuan Cuti
    </h1>
@endsection

@endsection
