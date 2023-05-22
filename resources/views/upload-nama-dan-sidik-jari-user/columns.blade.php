<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div class='bagan-data-table-cus' data-url="{{ url('/upload-nama-dan-sidik-jari-user/ajax?action=list_nama_dan_sidikjari_master_form') }}">
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control" name='form_filter_text' value="{{ Request::get('form_filter_text') }}" id='filter_search_text' placeholder="Masukkan Kata">
                    </div>
                    <div class="col-lg-1 col-md-1">
                        <div class="d-grid grap-2">
                            <button class="btn btn-primary">
                                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet data-table-cus">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 4%">Aksi</th>
                            <th class="py-3" style="width: 8%">Id Karyawan</th>
                            <th class="py-3" style="width: 15%">Nama Karyawan</th>
                            <th class="py-3" style="width: 8%">Jabatan</th>
                            <th class="py-3" style="width: 8%">Finger Id</th>
                            <th class="py-3" style="width: 8%">Finger</th>
                            <th class="py-3" style="width: 15%">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
