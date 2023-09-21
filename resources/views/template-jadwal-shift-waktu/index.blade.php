@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
@include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')

@if (!empty($url_back_index))
    <div class="text-warning">
        <a href="{{ url($url_back_index) }}" class="hover-pointer btn-back">
            <span class="hover-pointer btn-back text-warning">
                <img src="{{ asset('') }}icon/backwards.png" alt="">
                <span class="mx-2">Kembali ke Halaman Sebelumnya</span>
            </span>
        </a>    
    </div>
@endif

@include($router_name->path_base.'.columns')

@endsection
