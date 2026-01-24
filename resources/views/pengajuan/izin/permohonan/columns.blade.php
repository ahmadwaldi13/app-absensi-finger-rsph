<style>

.modal-top-rejected {
    align-items: flex-start !important;
    margin-top: 8vh;
}
.modal-top-approved {
    align-items: flex-start !important;
    margin-top: 8vh;
}

@media (min-width: 992px) {
    .modal-top {
        margin-top: 10vh;
    }
}

@media (max-width: 576px) {
    .btn-persetujuan {
        width: 14vh;
    }

    .border-2 {
        border: 1px solid #dee2e6 !important;
    }
    .permohonan {
        font-size: 15px;
    }
}


</style>

<div class="card border-2 mt-2">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 font-weight-bold text-primary">Permohonan</h6>
    </div>
    <div class="card-body">
        <div class="row justify-content-end mb-3">
            <div class="col-lg-4 col-md-6">
                
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control py-2" name="form_filter_text"
                            value="{{ Request::get('form_filter_text') }}" id="filter_search_text"
                            placeholder="Masukkan kata kunci..." style="border-right: none;">
                        
                        <button type="submit" class="btn btn-primary px-3">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0" style="width:100%; border: 1px solid #dee2e6;">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th style="width: 5%">NIP</th>
                        <th style="width: 20%">Nama</th>
                        <th style="width: 25%">Keterangan</th>
                        <th style="width: 15%">Periode</th>
                        <th style="width: 10%">Permohonan</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 2%">File</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($list_data) && count($list_data) > 0)
                        @foreach($list_data as $item)
                        <tr>
                            <td class="text-center font-monospace">{{ $item->nip ?? '-' }}</td>
                            <td class="fw-bold">{{ $item->nm_karyawan ?? '-' }}</td>
                            <td><small>{{ $item->keterangan ?? '-' }}</small></td>
                            <td class="text-nowrap">
                                <div class="small"><strong>Mulai:</strong> {{ $item->tgl_mulai }}</div>
                                <div class="small"><strong>Selesai:</strong> {{ $item->tgl_selesai }}</div>
                            </td>
                            <td class="text-start">
                                
                                <div class="permohonan">
                                    @if($item->status === 'rejected' && $item->current_level == 1)
                                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    @elseif($item->current_level >= 2)
                                        <i class="fa-solid fa-circle-check text-success"></i>
                                    @elseif($item->current_level == 1 && $item->status === 'pending')
                                        <i class="fa-regular fa-clock text-warning"></i>
                                    @else
                                        <i class="fa-regular fa-circle text-muted"></i>
                                    @endif
                                    Kepala Unit
                                </div>

                                <div class="permohonan">
                                    @if($item->status === 'approved')
                                        <i class="fa-solid fa-circle-check text-success"></i>
                                    @elseif($item->status === 'rejected' && $item->current_level == 2)
                                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    @elseif($item->current_level >= 2 && $item->status === 'pending')
                                        <i class="fa-regular fa-clock text-warning"></i>
                                    @else
                                        <i class="fa-regular fa-circle text-muted"></i>
                                    @endif
                                    SDI
                                </div>
                            </td>

                            <td class="text-center">
                                @if($item->status === 'approved')
                                    <span class="badge bg-success rounded-pill">Approved</span>
                                @elseif($item->status === 'rejected')
                                    <span class="badge bg-danger rounded-pill">Rejected</span>
                                @else
                                    <span class="badge bg-warning rounded-pill">Pending</span>
                                @endif
                            </td>
                            
                            <td class="text-center align-middle">
                                @if(!empty($item->file_pendukung))
                                    <button type="button"
                                        class="btn btn-sm btn-primary px-3 btn-view-file d-inline-flex align-items-center gap-1"
                                        data-file="{{ asset($item->file_pendukung) }}"
                                        data-name="{{ basename($item->file_pendukung) }}">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <span>File</span>
                                    </button>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-3">
                                        <span class="badge bg-light text-dark border">No File</span>
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($item->status === 'approved')
                                    <span class="text-muted fst-italic">
                                        <i class="bi bi-check-circle text-success"></i> Selesai
                                    </span>
                                @elseif($item->status === 'rejected')
                                    <span class="text-muted fst-italic">
                                        <i class="bi bi-x-circle text-danger"></i> Ditolak
                                    </span>
                                @elseif($user_level == 1 && $item->current_level == 1)
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button"
                                                class="btn btn-success btn-sm px-2 btn-persetujuan"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalApprove"
                                                data-id="{{ $item->id }}">
                                            <i class="bi bi-check-circle me-1"></i> Approve
                                        </button>

                                        <button type="button"
                                                class="btn btn-danger btn-sm px-2 btn-persetujuan"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalReject"
                                                data-id="{{ $item->id }}">
                                            <i class="bi bi-x-circle me-1"></i> Reject
                                        </button>
                                    </div>
                                 @elseif($user_level == 2)
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button"
                                                class="btn btn-success btn-sm px-2 btn-persetujuan"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalApprove"
                                                data-id="{{ $item->id }}">
                                            <i class="bi bi-check-circle me-1"></i> Approve
                                        </button>

                                        <button type="button"
                                                class="btn btn-danger btn-sm px-2 btn-persetujuan"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalReject"
                                                data-id="{{ $item->id }}">
                                            <i class="bi bi-x-circle me-1"></i> Reject
                                        </button>
                                    </div>
                                @else
                                    <span class="text-muted fst-italic">
                                        <i class="bi bi-hourglass-split text-warning"></i> Menunggu
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">Data tidak ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if(!empty($list_data))
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <span class="small text-muted">Showing {{ $list_data->count() }} entries</span>
            {{ $list_data->withQueryString()->links() }}
        </div>
        @endif
    </div>
    
</div>

<div class="modal fade" id="modalFile" tabindex="-1" aria-labelledby="modalFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFileLabel">Pratinjau File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="fileContent">
                </div>
            <div class="modal-footer">
                <a href="#" id="btnDownload" class="btn btn-success" download>Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@include('pengajuan.izin.permohonan.modal.approved')
@include('pengajuan.izin.permohonan.modal.rejected')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.btn-view-file', function (e) {
            e.preventDefault();

            const fileUrl = $(this).data('file');
            const fileName = $(this).data('name');
            const extension = fileName.split('.').pop().toLowerCase();
            let content = "";

            $('#fileContent').html('<div class="spinner-border text-primary" role="status"></div>');

            if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                content = `<img src="${fileUrl}" class="img-fluid rounded border shadow-sm">`;
            } else if (extension === 'pdf') {
                content = `<iframe src="${fileUrl}" width="100%" height="500px" style="border:none;"></iframe>`;
            } else {
                content = `
                    <div class="alert alert-warning">
                        Format file <b>${extension}</b> tidak didukung.<br>
                        Silakan download file.
                    </div>`;
            }

            $('#fileContent').html(content);
            $('#btnDownload').attr('href', fileUrl);
            $('#modalFile').modal('show');
        });

        const modalApprove = document.getElementById('modalApprove');
        modalApprove.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const pengajuanId = button.getAttribute('data-id');

            console.log('Approve ID:', pengajuanId);
            document.getElementById('approve_pengajuan_id').value = pengajuanId;
        });

        const modalReject = document.getElementById('modalReject');
        modalReject.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const pengajuanId = button.getAttribute('data-id');

            console.log('Reject ID:', pengajuanId);
            document.getElementById('reject_pengajuan_id').value = pengajuanId;
        });

    });
</script>