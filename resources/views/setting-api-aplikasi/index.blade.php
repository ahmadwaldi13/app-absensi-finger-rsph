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
        @include('setting-api-aplikasi.tab_api_aplikasi',['active'=>$type])

        @if($type==1)
            @include('setting-api-aplikasi.form',['action_form'=>'create'])
        @endif

    </div>

@endsection