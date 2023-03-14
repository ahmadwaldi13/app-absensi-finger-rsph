<table class="table table-striped table-number mt-1">
    <thead>
        <tr>
            <th class="text-center ">No.</th>
            <th>User</th>
            <th class="w-25">Nama User</th>
            <th>Jenis Akun</th>
            <th class="w-40">Level Akses</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_list as $key => $value)
        <?php
            $kode = $value->id_user_;
        ?>
            <tr>
                <td class="text-center">{{ $key+1 }}</td>
                <td>{{ $value->id_user_ }}</td>
                <td class="w-25">{{ $value->nama }}</td>
                <td>{{ $value->status }}</td>
                <td class="w-40">{{ $value->alias_group }}</td>
                <td class="text-center">
                    <a href="{{ url('user-akses/form') }}" class='btn btn-warning modal-remote' data-modal-key='{{ $kode }}' data-modal-width='50%' data-modal-title='Setting Level Akses'>Level Akses</a>
                    <a href="{{ url('user-akses/delete') }}" class='btn btn-danger modal-remote-delete' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?">Hapus Akses</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="col-12 col-md-6 d-flex justify-content-end">
    {{ $data_list->withQueryString()->onEachSide(0)->links() }}
</div>
