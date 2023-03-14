@extends('layouts.master2')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')
    @include('billing-list-tagihan-pasien-ralan.tab_billing')
    
    @include($router_name->path_base.'.columns')
@endsection