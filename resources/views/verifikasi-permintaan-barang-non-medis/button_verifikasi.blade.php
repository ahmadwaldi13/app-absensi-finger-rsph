<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
    $check_status=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)->get_status_verifikasi($model->status_veri,$model->status,$model->no_permintaan);
    $check_status_diterima=($check_status->status==1) ? 1 : 0;
?>

@if( (new \App\Http\Traits\AuthFunction)->checkAkses($router_name->uri.'/verifikasi') )
    <?php 
        $kode=$model->no_permintaan;
    ?>
    <div class="row justify-content-end align-items-end mt-1">
        @if(in_array($check_status->status, [0]))
            <div class="col-md-1 text-center">
                <a href="{{ url($router_name->uri.'/verifikasi') }}" class="btn btn-success modal-remote-confir" 
                data-modal-key={{ $kode.'@2' }}
                data-modal-width="30%" 
                data-modal-title="Info" 
                data-confirm-message="Apakah anda menyetujui nya ?">Disetujui</a>
            </div>
        @endif

        @if(in_array($check_status->status, [0, 2]))
            <div class="col-md-1 text-center">
                <a href="{{ url($router_name->uri.'/verifikasi') }}" 
                    class="btn btn-danger modal-remote" 
                    data-modal-key={{ $kode.'@3' }} 
                    data-modal-width="50%" 
                    data-modal-title="Keterangan" 
                    data-confirm-message="Apakah anda menolak nya ?"
                >Ditolak</a>
            </div>
        @endif    
    </div>
@endif