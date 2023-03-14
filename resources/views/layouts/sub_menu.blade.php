@extends('layouts.master')

@section('title-header', '')

@push('custom-style')
<style>
    .item_menu {
        display: block;
        float: left;
        background-color: #2d75ad;
        text-align: left;
        padding: 13px 5px 13px 30px;
        position: relative;
        margin: 0 10px 0 0;
        font-size: 20px;
        text-decoration: none;
        color: #fff;
        min-width: 150px;
    }

    .item_menu:after {
        content: "";
        border-top: 31px solid transparent;
        border-bottom: 25px solid transparent;
        border-left: 20px solid #2d75ae;
        position: absolute;
        right: -20px;
        top: 0;
        z-index: 1;
    }

    .item_menu:hover {
        background-color: #5a9cd0;
        color: #fff;
    }

    .item_menu:hover:after {
        border-left: 20px solid #5a9cd0;
    }

</style>
@endpush

@section('content')
<div class="row d-flex justify-content-between">
    <div class='bagan-data-table'>
        <form action="" method="GET">
            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-8 col-md-10">
                    <input type="text" class="form-control search-data-table" placeholder="Cari Menu">
                </div>
            </div>
        </form>

        <table class="data-table table-responsive-tablet">
            <thead style='display:none'>
                <tr>
                    <th>.</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($menu))
                @foreach ($menu as $key => $item)
                <?php
                            $item=(object)$item;
                        ?>
                <tr>
                    <td>
                        <a class='item_menu' href="{{ $item->url }}">{{ $item->title }}</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('script-end-1')
<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\jquery.dataTables.min.js' )}}"></script>
@endpush
