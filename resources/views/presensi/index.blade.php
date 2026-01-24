@extends('layouts.master')

@section('title-header', 'Presensi Fingerprint')

@section('content') 
<div class="container-fluid px-2 px-md-4">
    
    <div class="row g-3 mb-4">
        <div class="col-12 col-xl-4">
            <div class="card border-dark-subtle h-100" style="border-radius: 0px;">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="m-0 font-weight-bold  text-dark text-uppercase small">Ringkasan Bulan Ini</h6>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 200px; width: 100%;">
                        <canvas id="chartKehadiranBulanan"></canvas>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="small"><i class="fa-solid fa-square me-2" style="color: #2ecc71;"></i>Tepat Waktu</span>
                            <span class="fw-bold small">18 Hari</span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span class="small"><i class="fa-solid fa-square me-2" style="color: #e74c3c;"></i>Terlambat</span>
                            <span class="fw-bold small">2 Hari</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="small"><i class="fa-solid fa-square me-2" style="color: #f1c40f;"></i>Alpa</span>
                            <span class="fw-bold small">1 Hari</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-8">
            <div class="card border-dark-subtle h-100" style="border-radius: 0px;">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h6 class="m-0 font-weight-bold text-dark text-uppercase small">Log Fingerprint Terakhir</h6>
                    <span class="badge border text-dark fw-normal small" style="border-radius: 0px;">STATUS: ONLINE</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" style="min-width: 500px;">
                            <thead class="thead-custom text-center small">
                                <tr>
                                    <th class="py-3">TANGGAL</th>
                                    <th>MASUK</th>
                                    <th>PULANG</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody class="text-center small">
                                <tr>
                                    <td class="fw-bold">15 Jan 2024</td>
                                    <td>07:55:12</td>
                                    <td>17:05:44</td>
                                    <td><span class="text-success fw-bold">HADIR</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">14 Jan 2024</td>
                                    <td>08:15:00</td>
                                    <td>17:00:21</td>
                                    <td><span class="text-danger fw-bold">TELAT</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">13 Jan 2024</td>
                                    <td>--:--:--</td>
                                    <td>--:--:--</td>
                                    <td><span class="text-warning fw-bold">ALPA</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12">
            <div class="card border-dark-subtle bg-light" style="border-radius: 0px;">
                <div class="card-body p-3 p-md-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 mb-3 mb-md-0 text-center text-md-start">
                            <h6 class="fw-bold text-uppercase mb-1 small text-primary">Status Presensi Hari Ini</h6>
                            <p class="mb-0 text-muted fw-bold small">{{ date('l, d F Y') }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-column flex-sm-row justify-content-md-end gap-2">
                                <div class="border bg-white p-2 flex-fill text-center" style="min-width: 120px;">
                                    <small class="text-muted d-block small-label">SCAN MASUK</small>
                                    <span class="fw-bold d-block">08:05:22</span>
                                </div>
                                <div class="border bg-white p-2 flex-fill text-center" style="min-width: 120px;">
                                    <small class="text-muted d-block small-label">SCAN PULANG</small>
                                    <span class="fw-bold d-block text-muted">--:--:--</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-center">
                <p class="text-muted mb-0" style="font-size: 11px;">* Sinkronisasi otomatis dari mesin fingerprint ke sistem pada {{ date('H:i') }} WIB</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Reset Shadow & Rounding */
    .card { box-shadow: none !important; border-radius: 0px !important; }
    .table-responsive { border: 0 !important; }
    
    /* Custom Responsive Label */
    .small-label { font-size: 10px; font-weight: bold; letter-spacing: 0.5px; }

    /* Thead Gray Custom */
    .thead-custom {
        background-color: #a8b0b7ff !important;
        color: #ffffff !important;
    }

    .card-header {
        background-color: #f3f4f5ff !important;
        
    }
    
    
    .thead-custom th {
        background-color: #a3abb3ff !important;
        color: #ffffff !important;
        border-color: #a8abadff !important;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        #chartKehadiranBulanan { height: 180px !important; }
        .card-header h6 { 
            font-size: 12px; 
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartKehadiranBulanan').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Tepat Waktu', 'Terlambat', 'Alpa'],
            datasets: [{
                data: [18, 2, 1],
                backgroundColor: ['#2ecc71', '#e74c3c', '#f1c40f'],
                borderWidth: 1,
                borderColor: '#ffffff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endsection