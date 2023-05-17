@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')
    @if( (new \App\Http\Traits\AuthFunction)->checkAkses($router_name->uri) )
            <div class="card card-body" style='background:#f2f2f2'>
            <?php
                $bagan_form=\App::call($router_name->base_controller.'@actionCreate');
            ?>
                @if(!empty($bagan_form))
                    {!! $bagan_form !!}
                @endif
            </div>
    @endif
@endsection
