<hr style="margin-top:0px">
<div>
    <div class="row d-flex justify-content-between">
        <div>
            {{-- <form action="" method="GET">
                <input type="hidden" id="filter_id_mesin" name="filter_id_mesin" value="{{ Request::get('filter_id_mesin') }}" />
                
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control" name='form_filter_text'
                            value="{{ Request::get('form_filter_text') }}" id='filter_search_text'
                            placeholder="Masukkan Kata">
                    </div>

                    <div class="col-lg-1 col-md-1">
                        <div class="d-grid grap-2">
                            <button type="submit" name='searchbydb' class="btn btn-primary" value=1>
                                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form> --}}
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control" name='form_filter_text'
                            value="{{ Request::get('form_filter_text') }}" id='filter_search_text'
                            placeholder="Masukkan Kata">
                    </div>

                    <div class="col-lg-3 col-md-10">
                        <div class='bagan_form'>
                            <label for="filter_nama_mesin" class="form-label">Pilih Data Mesin</label>
                            <div class="button-icon-inside">
                                <input type="text" class="input-text" id='filter_nama_mesin' name='filter_nama_mesin' value="{{ Request::get('filter_nama_mesin') }}" />
                                <input type="hidden" id="filter_id_mesin" name="filter_id_mesin" value="{{ Request::get('filter_id_mesin') }}" />
                                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_mesih_absensi') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_id_mesin|#filter_ip_mesin|null|#filter_nama_mesin@data-key-bagan=0@data-btn-close=#closeModalData">
                                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                </span>
                                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                            </div>
                            <div class="message"></div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-10">
                        <div class='bagan_form'>
                            <label for="filter_nm_jabatan" class="form-label">Jabatan</label>
                            <div class="button-icon-inside">
                                <input type="text" class="input-text" id='filter_nm_jabatan' name="filter_nm_jabatan" value="{{ Request::get('filter_nm_jabatan') }}" />
                                <input type="hidden" id="filter_id_jabatan" name='filter_id_jabatan' value="{{ Request::get('filter_id_jabatan') }}">
                                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_jabatan') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jabatan' data-modal-width='30%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_id_jabatan|#filter_nm_jabatan@data-key-bagan=0@data-btn-close=#closeModalData">
                                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                </span>
                                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                            </div>
                            <div class="message"></div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-10">
                        <div class='bagan_form'>
                            <label for="filter_nm_departemen" class="form-label">Departemen</label>
                            <div class="button-icon-inside">
                                <input type="text" class="input-text" id='filter_nm_departemen' name="filter_nm_departemen" value="{{ Request::get('filter_nm_departemen') }}" />
                                <input type="hidden" id="filter_id_departemen" name='filter_id_departemen' value="{{ Request::get('filter_id_departemen') }}">
                                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_departemen') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Departemen' data-modal-width='30%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_id_departemen|#filter_nm_departemen@data-key-bagan=0@data-btn-close=#closeModalData">
                                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                </span>
                                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>                            
                            </div>
                            <div class="message"></div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-1">
                        <div class="d-grid grap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>


            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 15%">Id User</th>
                            <th class="py-3" style="width: 15%">Nama Karyawan</th>
                            <th class="py-3" style="width: 15%">Tanggal & Jam</th>
                            <th class="py-3" style="width: 15%">Verifikasi</th>
                            <th class="py-3" style="width: 15%">Status</th>
                            {{-- <th class="py-3" style="width: 15%">Database</th>
                            <th class="py-3" style="width: 15%">Nama User Tersimpan</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                            dd($list_data);
                        @endphp --}}
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                            <?php
                                $check_database="<span style='color:RED'>Belum Ada</span>";
                                if(!empty($item->ready)){
                                    $check_database="<span style='color:#128628'>Ada</span>";
                                }

                                // $get_privil=(new \App\Models\RefUserInfo())->get_privilege($item->privilege);

                            ?>
                            <tr>
                                <td>{{ !empty($item->id_user) ? $item->id_user : ''  }}</td>
                                <td>{{ !empty($item->nm_karyawan) ? $item->nm_karyawan : ''  }}</td>
                                <td>{{ !empty($item->datetime) ? $item->datetime : ''  }}</td>
                                <td>{{ !empty($item->verified) ? $item->verified : ''  }}</td>
                                <td>{{ !empty($item->status) ? $item->status : ''  }}</td>    
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @if(!empty($list_data))
            <div class="d-flex justify-content-end">
                {{ $list_data->withQueryString()->onEachSide(0)->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
