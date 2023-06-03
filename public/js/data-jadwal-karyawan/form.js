$.fn.editable.defaults.mode = 'inline';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.pil_jadwal').editable({
    mode: 'popup',
});