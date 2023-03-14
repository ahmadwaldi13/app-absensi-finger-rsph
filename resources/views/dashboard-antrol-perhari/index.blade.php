@extends('layouts.master2')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')
    
    @include($router_name->path_base.'.columns')

@endsection

@push('script-end-2')
    <script src="{{ asset('js/antrol-bpjs/form.js') }}"></script>
@endpush