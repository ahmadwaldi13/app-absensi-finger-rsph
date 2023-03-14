<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" name="key_old" value="{{ $kode }}">
    <div class="row justify-content-start">
        <div class="row justify-content-left">
            <div class="col-lg-12">
                <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
            </div>
        </div>
    </div>

    <div class="row justify-content-end align-items-end mt-1">
        <div class="col-md-3 text-center">
            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
        </div>
    </div>
</form>