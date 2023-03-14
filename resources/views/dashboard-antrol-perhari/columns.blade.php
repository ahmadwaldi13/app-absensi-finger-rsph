<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-2 col-md-10">
                        <label for="daterange" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control input-daterange" required id="daterange">
                        <input type="text" hidden id="tgl" required name="tanggal">
                    </div>
                    
                    <div class="col-lg-2 col-md-10">
                        <label for="waktu" class="form-label">Periode Waktu</label>
                        <select class='form-control form-select' id='waktu' name="waktu">
                            <option value="server">Waktu Server</option>
                            <option value="rs">Waktu Rumah Sakit</option>
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