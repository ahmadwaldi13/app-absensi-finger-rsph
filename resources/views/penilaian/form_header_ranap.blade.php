<input type="text" hidden class="form-control" name="fr" value="{{$data_params->fr}}">
<div class="col-3 mb-2">
    <label for="no_rawat" class="form-label">No.Rawat</label>
    <input type="text" class="form-control" name="no_rawat" id='no_rawat' value="{{$data_params->no_rawat}}" readonly>
</div>
<div class="col-2 mb-2">
    <label for="no_rkm_medis" class="form-label">No. Rekam Medis</label>
    <input type="text" class="form-control" name="no_rm" id='no_rm' value="{{$data_pasien->no_rkm_medis}}" readonly>:
</div>
<div class="col-3 mb-2">
    <label for="nm_pasien" class="form-label">Nama Pasien</label>
    <input type="text" class="form-control"  id='nm_pasien' value="{{!empty($data_pasien->nm_pasien) ? $data_pasien->nm_pasien : ''}}" readonly>
</div>
<div class="col-2 mb-2">
    <label for="tgl_lahir" class="form-label">Tanggal Lahir: </label>
    <input type="text" class="form-control " id='tgl_lahir' readonly value="{{!empty($data_pasien->tgl_lahir) ? $data_pasien->tgl_lahir : ''}}">
</div>
<div class="col-2 mb-2">
    <label for="jk" class="form-label">Jenis Kelamin</label>
    @php
        $jenis_kelamin = !empty($data_pasien->jk) ? ($data_pasien->jk == 'P' ? "Perempuan" : "Laki-Laki") : ''
    @endphp
    <input  id="jk" type="text" class="form-control" value="{{$jenis_kelamin}}" readonly>
</div>

<div class="col-6 mb-2">
    <label for="nip1" class="form-label">Pengkaji 1 : </label>
    <div class="button-icon-inside bagan-metode-racik" style='background:#ccc'>
        <input style='background:#ccc' type="text" class="input-text kode-dokter readonly" id="namaPetugas1" readonly  placeholder="Petugas" required value='{{ $nama_pj  }}'>
        <input type="hidden" id="nip1" name="nip1" value='{{$kode_pj }}' />
        @if(empty($readonly) )
            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_pegawai') }}" data-modal-key="{{ $data_params->fr.'@'.$data_params->no_rawat }}" data-modal-pencarian='true' data-modal-title='daftar petugas' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nip1|#namaPetugas1@data-btn-close=#closeModalData">
            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
            </span>
        @endif
    </div>
</div>  
<div class="col-6 mb-2">
    <label for="nip2" class="form-label">Pengkaji 2 : </label>
    <div class="button-icon-inside bagan-metode-racik" style='background:#ccc'>
        <input style='background:#ccc' type="text" class="input-text kode-dokter readonly" id="namaPetugas2" readonly  placeholder="Petugas" required value='{{!empty($nama_pj_2) ? $nama_pj_2 : ''}}'>
        <input type="hidden" id="nip2" name="nip2" value='{{!empty($kode_pj_2) ? $kode_pj_2 : ''}}' />
        @if(empty($readonly) )
            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_pegawai') }}" data-modal-key="{{ $data_params->fr.'@'.$data_params->no_rawat }}" data-modal-pencarian='true' data-modal-title='daftar petugas' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nip2|#namaPetugas2@data-btn-close=#closeModalData">
            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
            </span>
        @endif
    </div>
</div><div class="col-6 mb-2">
    <label for="kd_dokter" class="form-label">DPJP  : </label>
    <div class="button-icon-inside bagan-metode-racik" style='background:#ccc'>
        <input style='background:#ccc' type="text" class="input-text kode-dokter readonly" id="nm_dokter" readonly  placeholder="DPJP" required value='{{!empty($nama_dpjp) ? $nama_dpjp : ''}}'>
        <input type="hidden" id="kd_dokter" name="kd_dokter" value='{{!empty($kode_dpjp) ? $kode_dpjp : ''}}' />
        @if(empty($readonly) )
            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_dokterPJ') }}" data-modal-key="{{$data_params->no_rawat }}" data-modal-pencarian='true'data-modal-title='okw' data-modal-action-change="function=.set-data-list-from-modal@data-target=#kd_dokter|#nm_dokter@data-btn-close=#closeModalData">
            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
            </span>
        @endif
    </div>
</div>