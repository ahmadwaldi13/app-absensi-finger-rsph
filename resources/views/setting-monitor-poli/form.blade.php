<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}" enctype="multipart/form-data">
    @csrf
    <?php 
        $kode=!empty($model->kode_setting) ? $model->kode_setting : '';
        $poli = !empty(explode(',',  $model["item_poli"])) ? explode(',' ,$model["item_poli"]) : '';
    ?>

    <input type="hidden" name="key_old" value="{{ $kode }}">
    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-2 mb-3">
            <div class='bagan_form '>
                <label for="kode_setting" class="form-label">kode Setting <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="kode_setting" name='kode_setting' required value="{{ !empty($model->kode_setting) ? $model->kode_setting : '' }}">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
                <label for="kode_template" class="form-label">Pilih Template <span class="text-danger">*</span></label>
                <select class="form-select" name="kode_template" aria-label="Default select example" id="kode_template">
                    <option value="">Semua</option>
                    <option value="1" {{($model['kode_template'] === '1') ? 'Selected' : '1'}}>Default</option>
                    <option value="2" {{($model['kode_template'] === '2') ? 'Selected' : '2'}}>Template Dua</option>
                  </select>
                <div class="message"></div>
            </div>
        </div>
       
        @if ($model['kode_template'] == "2")
            <div class="col-lg-4 mb-3 link_video">
                <div class='bagan_form'>
                    <label for="link_video" class="form-label">Link Youtube / Video</label>
                    <input type="text" class="form-control" id="link_video" name='link_video' required value="{{ !empty($model->link_video) ? $model->link_video : '' }}">
                    <div class="message"></div>
                </div>
            </div>
        @else
            <div class="col-lg-4 mb-3 link_video" style="display: none">
                <div class='bagan_form'>
                    <label for="link_video" class="form-label">Link Youtube / Video</label>
                    <input type="text" class="form-control" id="link_video" name='link_video' required value="{{ !empty($model->link_video) ? $model->link_video : 'https://www.youtube.com/embed/' }}">
                    <div class="message"></div>
                </div>
            </div>
        @endif
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-8 mb-3">
            <div class='bagan_form'>
                <label for="item_poli" class="form-label">Tampilkan Poli <span class="text-danger">*</span></label>
                    <select class="form-control poliklinik" name="item_poli[]" id="item_poli" multiple="multiple" style="width: 100%" required value="{{ !empty($model->item_poli) ? $model->item_poli : ''  }}">
                        @foreach($polikliniks as $key => $item)
                            @if(in_array($item->kd_poli, $poli))
                                <option value="{{ $item->kd_poli }}" selected="true">{{ $item->nm_poli }}</option>
                            @else
                                <option value="{{ $item->kd_poli }}">{{ $item->nm_poli }}</option>
                            @endif 
                        @endforeach
                    </select>
                <div class="message"></div>
            </div>
        </div>
    </div>

    @if ($model['kode_template'] == "2")
        <div class="card w-50 mb-3 peringatan">
            <div class="card-body">
                <label class="form-label"><span class="text-danger">*</span> Peringatan</label>
                <figure>
                    <blockquote class="blockquote">
                        <p style="font-size: 17px">Setting link Youtube dengan benar, ambil id video di Youtube dengan contoh <b>(ju8Zos7ufzk)</b> lalu pastekan dilink berikut https://www.youtube.com/embed/ <b>(pastekan disini)</b>, agar format link youtube berjalan dimonitor.</p>
                    </blockquote>
                </figure>
            </div>
        </div>
    @else
        <div class="card w-50 mb-3 peringatan" style="display: none">
            <div class="card-body">
                <label class="form-label"><span class="text-danger">*</span> Peringatan</label>
                <figure>
                    <blockquote class="blockquote">
                        <p style="font-size: 17px">Setting link Youtube dengan benar, ambil id video di Youtube dengan contoh <b>(ju8Zos7ufzk)</b> lalu pastekan dilink berikut https://www.youtube.com/embed/ <b>(pastekan disini)</b>, agar format link youtube berjalan dimonitor.</p>
                    </blockquote>
                </figure>
            </div>
        </div>
    @endif

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-5">
            <button class="btn btn-primary" type="submit">{{ !empty($kode) ? 'Ubah' : 'Simpan'  }}</button>
        </div>
    </div>
</form>

@push('script-end-2')
    <script src="{{ asset('js/setting-monitor-poli/form.js') }}"></script>
@endpush

