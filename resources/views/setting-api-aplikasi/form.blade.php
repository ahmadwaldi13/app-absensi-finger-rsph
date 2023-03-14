<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model->id_variable) ? $model->id_variable : '';
    ?>
    <input type="text" name="key_old" value="{{ $kode }}">

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Api BPJS</td>
                <td>:</td>
                <td>
                    <a href="#" id="username" data-type="text" data-pk="1" data-url="/post" data-title="Enter username">superuser</a>
                </td>
            </tr>
            
            <tr>
                <td>Status API</td>
                <td>:</td>
                <td>
                    <a href="#" id="status" data-type="select" data-pk="1" data-url="/post" data-title="Select status"></a>
                </td>
            </tr>
        </tbody>
    </table>
</form>


@push('link-end-1')
    <link href="{{ asset('libs\editable\bootstrap5-editable\css\bootstrap-editable.css' )}}" rel="stylesheet" />
@endpush

@push('script-end-1')
<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.bundle.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\editable\bootstrap5-editable\js\bootstrap-editable.min.js' )}}"></script>
@endpush

@push('script-end-2')
<script>
    $.fn.editable.defaults.mode = 'inline';
    $('#username').editable({
        mode: 'popup',
    });

    $('#status').editable({
        value: 2,    
        source: [
              {value: 1, text: 'Tidak Aktif'},
              {value: 2, text: 'Aktif'},
           ]
    });
</script>
@endpush