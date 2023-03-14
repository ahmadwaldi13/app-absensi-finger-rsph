@extends('layouts.master2')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

@push('custom-style')
    <style>
        .select2-selection {
            height: 2.3em !important;
            padding-top: 4px;
        }

        .select2 {
            /* padding: 0.375rem 0.75rem !important; */
            width: 100% !important;
        }

        .select2-results > ul.select2-results__options {
            width: auto !important;
            min-height: auto !important;
            max-height: 75vh !important;
        }
    </style>
@endpush

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')

    @include($router_name->path_base.'.columns')

@endsection

@push('script-end-2')
    <script src="{{ asset('js/antrol-bpjs/form.js') }}"></script>
    <script src="{{ asset('js/antrol-bpjs/search_poli.js') }}"></script>
@endpush