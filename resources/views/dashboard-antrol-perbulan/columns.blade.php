<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-1 col-md-10">
                        <label for="bulan" class="form-label">Bulan <span class="text-danger">*</span></label>
                        <select class='form-control form-select' id='bulan' name="bulan">
                            <option value="01" <?php if(date('m') == '01'){echo 'selected';} ?>>01</option>
                            <option value="02" <?php if(date('m') == '02'){echo 'selected';} ?>>02</option>
                            <option value="03" <?php if(date('m') == '03'){echo 'selected';} ?>>03</option>
                            <option value="04" <?php if(date('m') == '04'){echo 'selected';} ?>>04</option>
                            <option value="05" <?php if(date('m') == '05'){echo 'selected';} ?>>05</option>
                            <option value="06" <?php if(date('m') == '06'){echo 'selected';} ?>>06</option>
                            <option value="07" <?php if(date('m') == '07'){echo 'selected';} ?>>07</option>
                            <option value="08" <?php if(date('m') == '08'){echo 'selected';} ?>>08</option>
                            <option value="09" <?php if(date('m') == '09'){echo 'selected';} ?>>09</option>
                            <option value="10" <?php if(date('m') == '10'){echo 'selected';} ?>>10</option>
                            <option value="11" <?php if(date('m') == '11'){echo 'selected';} ?>>11</option>
                            <option value="12" <?php if(date('m') == '12'){echo 'selected';} ?>>12</option>
                        </select>
                    </div>
                    <div class="col-lg-1 col-md-10">
                        <select class='form-control form-select' id='tahun' name="tahun">
                        <?php 
                            $now = date('Y');
                            for($x = $now; $x >= 2010; $x--){
                            ?>
                                <option value="{{ $x }}">{{ $x }}</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-10">
                        <label for="waktu" class="form-label">Periode Waktu</label>
                        <select class='form-control form-select' id='waktu' name="waktu">
                            <option value="server">Waktu Server</option>
                            <option value="rs"> Waktu Rumah Sakit</option>
                        </select>
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
                <table class="table border table-striped table-responsive">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 8%">Poliklinik</th>
                            <th class="py-3" style="width: 4%">Jumlah</th>
                            <th class="py-3" style="width: 6%">Task 1</th>
                            <th class="py-3" style="width: 6%">AVG Taks 1</th>
                            <th class="py-3" style="width: 6%">Taks 2</th>
                            <th class="py-3" style="width: 6%">AVG Taks 2</th>
                            <th class="py-3" style="width: 6%">Taks 3</th>
                            <th class="py-3" style="width: 6%">AVG Taks 3</th>
                            <th class="py-3" style="width: 6%">Taks 4</th>
                            <th class="py-3" style="width: 6%">AVG Task 4</th>
                            <th class="py-3" style="width: 6%">Taks 5</th>
                            <th class="py-3" style="width: 6%">AVG Taks 5</th>
                            <th class="py-3" style="width: 6%">Taks 6</th>
                            <th class="py-3" style="width: 6%">AVG Taks 6</th>
                            <th class="py-3" style="width: 8%">Tanggal Insert</th>
                            <th class="py-3" style="width: 8%">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                <?php 
                                    $item = (array) $item;
                                    $poli = strtolower(!empty($item["namapoli"])) ? strtolower($item["namapoli"]) : '';
                                ?>
                                <tr>
                                    <td>{{ ucfirst($poli) ? ucfirst($poli) : ''  }}</td>
                                    <td>{{ !empty($item["jumlah_antrean"]) ? $item["jumlah_antrean"] : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s', $item["waktu_task1"])) ? date('H:i:s',$item["waktu_task1"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["avg_waktu_task1"])) ? date('H:i:s',$item["avg_waktu_task1"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["waktu_task2"])) ? date('H:i:s',$item["waktu_task2"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["avg_waktu_task2"])) ? date('H:i:s',$item["avg_waktu_task2"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["waktu_task3"])) ? date('H:i:s',$item["waktu_task3"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["avg_waktu_task3"])) ? date('H:i:s',$item["avg_waktu_task3"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["waktu_task4"])) ? date('H:i:s',$item["waktu_task4"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["avg_waktu_task4"])) ? date('H:i:s',$item["avg_waktu_task4"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["waktu_task5"])) ? date('H:i:s',$item["waktu_task5"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["avg_waktu_task5"])) ? date('H:i:s',$item["avg_waktu_task5"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["waktu_task6"])) ? date('H:i:s',$item["waktu_task6"]) : ''  }}</td>
                                    <td>{{ !empty(date('H:i:s',$item["avg_waktu_task6"])) ? date('H:i:s',$item["avg_waktu_task6"]) : ''  }}</td>
                                    <td>{{ !empty(date("Y-m-d H:i:s", $item["insertdate"] / 1000 )) ?  date("Y-m-d H:i:s", $item["insertdate"] / 1000 ) : ''  }}</td>
                                    <td>{{ !empty($item["tanggal"]) ? $item["tanggal"] : ''  }}</td>
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
<div class="col-lg-12">
    <p class="mb-auto" style="font-size: 19px"><b>Catatan:</b></p>
    <p>
      a)  Waktu Task 1 = Waktu tunggu admisi dalam detik <br>
      b)  Waktu Task 2 = Waktu layan admisi dalam detik <br>
      c)  Waktu Task 3 =  Waktu tunggu poli dalam detik <br>
      d)  Waktu Task 4 = Waktu layan poli dalam detik <br>
      e)  Waktu Task 5 = Waktu tunggu farmasi dalam detik <br>
      f)  Waktu Task 6 = Waktu layan farmasi dalam detik <br>
      g)  Insertdate = Waktu pengambilan data, timestamp dalam milisecond <br>
      h)  Waktu server adalah data waktu (task 1-6) yang dicatat oleh server BPJS Kesehatan setelah RS mengimkan data, sedangkan waktu rs adalah data waktu (task 1-6) yang dikirimkan oleh RS 
    </p>
  </div>