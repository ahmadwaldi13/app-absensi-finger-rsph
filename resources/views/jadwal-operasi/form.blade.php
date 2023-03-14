<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-2 bagan_form">
            <label for="norawatOperasi" class="form-label">No.Rawat</label>
            <input type="text" class="form-control error-border-form" id="norawatOperasi" required name="no_rawat" value="{{ Request::get('no_rawat') }}">
            <span class="error-message text-danger"></span>
        </div>
    </div>
</form>