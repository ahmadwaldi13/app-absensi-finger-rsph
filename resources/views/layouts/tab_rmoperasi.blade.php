<?php
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction())->getItemPasien(Request::get('fr'));

    $link_param = [
        'no_rawat' => (!empty($item_pasien->no_rawat) ? $item_pasien->no_rawat : ''),
        'no_rm' => (!empty($item_pasien->no_rm) ? $item_pasien->no_rm : ''),
        'fr' => !empty($_GET['fr']) ? $_GET['fr'] : '',
    ];

    $item=[
        1=>(object)[
            'nama'=>'Check List Pre Operasi',
            'key'=>'check-list-pre-operasi',
            'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('check-list-pre-operasi')),
            'fr' => ['ri', 'rj'],
        ],
        2=>(object)[
            'nama'=>'Sign-In Sebelum Anetesi',
            'key'=>'signin-sebelum-anestesi',
            'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('signin-sebelum-anestesi')),
            'fr' => ['ri', 'rj'],
        ],
        3=>(object)[
            'nama'=>'Time-Out Sebelum Insisi',
            'key'=>'timeout-sebelum-insisi',
            'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('timeout-sebelum-insisi')),
            'fr' => ['ri', 'rj'],
        ],
        4=>(object)[
            'nama'=>'Sign-Out Sebelum Menutup Luka',
            'key'=>'sign-out-sebelum-menutup-luka',
            'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('sign-out-sebelum-menutup-luka')),
            'fr' => ['ri', 'rj'],
        ],
        5=>(object)[
            'nama'=>'Check List Post Operasi',
            'key'=>'check-list-post-operasi',
            'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('check-list-post-operasi')),
            'fr' => ['ri'],
        ],
        6=>(object)[
            'nama'=>'Penilaian Pre Operasi',
            'key'=>'rmoperasi-nilai-pre-operasi',
            'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('rmoperasi-nilai-pre-operasi')),
            'fr' => ['ri', 'rj'],
        ],
        7=>(object)[
            'nama'=>'Penilaian Pre Anestesi',
            'key'=>'rmoperasi-nilai-pre-anestesi',
            'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('rmoperasi-nilai-pre-anestesi')),
            'fr' => ['ri', 'rj'],
        ],
    ];

$item = (new \App\Http\Traits\AuthFunction())->checkMenuAkses($item);

if (!empty($kode_key_old)) {
    foreach ($item as $key => $value) {
        if ($active != $key) {
            unset($item[$key]);
        }
    }
}
// dd($kode_key_old);
?>


<ul class="nav nav-tabs">
    @foreach ($item as $key => $value)
        @if (in_array($link_param['fr'], $value->fr))
        {{-- {{ dd($active) }} --}}
            <li class="nav-item border-radius-top text-center button-tabs ms-2">
                <a class="nav-link border-radius-top tabs text-muted  <?= $active == $key ? 'active' : '' ?>"
                    href="<?= $value->url ?>"><?= $value->nama ?></a>
            </li>
        @endif
    @endforeach
</ul>
