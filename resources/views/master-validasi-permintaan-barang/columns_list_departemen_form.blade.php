<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div class='bagan-data-table-cus' data-url="{{ url('master-validasi-permintaan-barang/ajax?action=list_departemen_master_form') }}">
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
                            <th class="py-3" style="width: 1%">Pil</th>
                            <th class="py-3" style="width: 5%">Kode Departemen</th>
                            <th class="py-3" style="width: 20%">Nama Departemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>