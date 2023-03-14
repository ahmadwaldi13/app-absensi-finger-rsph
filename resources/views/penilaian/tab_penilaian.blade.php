<?php
$item_pasien = (new \App\Http\Traits\ItemPasienFunction())->getItemPasien(Request::get('fr'));

$link_param = [
    'no_rawat' => !empty($item_pasien->no_rawat) ? $item_pasien->no_rawat : '',
    'no_rm' => !empty($item_pasien->no_rm) ? $item_pasien->no_rm : '',
    'fr' => !empty($_GET['fr']) ? $_GET['fr'] : '',
];

$item = [
    1 => (object) [
        'nama' => 'Keperawatan Umum',
        'key' => 'penilaian-perawat-umum',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-perawat-umum')),
        'fr' => ['ri', 'rj'],
    ],
    2 => (object) [
        'nama' => 'Keperawatan Kebidanan & Kandungan',
        'key' => 'penilaian-perawat-kebidanan',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-perawat-kebidanan')),
        'fr' => ['ri', 'rj'],
    ],
    3 => (object) [
        'nama' => 'Keperawatan Gigi & Mulut',
        'key' => 'penilaian-perawat-gigi',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-perawat-gigi')),
        'fr' => ['rj'],
    ],
    4 => (object) [
        'nama' => 'Keperawatan Bayi & Anak',
        'key' => 'penilaian-perawat-bayi-anak',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-perawat-bayi-anak')),
        'fr' => ['rj'],
    ],
    5 => (object) [
        'nama' => 'Keperawatan Psikiatri',
        'key' => 'penilaian-perawat-psikiatri',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-perawat-psikiatri')),
        'fr' => ['rj'],
    ],
    6 => (object) [
        'nama' => 'Medis Umum',
        'key' => 'penilaian-medis-umum',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-umum')),
        'fr' => ['ri', 'rj'],
    ],
    7 => (object) [
        'nama' => 'Medis IGD',
        'key' => 'penilaian-medis-igd',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-igd')),
        'fr' => ['rj'],
    ],
    8 => (object) [
        'nama' => 'Medis Bayi & Anak',
        'key' => 'penilaian-medis-bayi',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-bayi')),
        'fr' => ['rj'],
    ],
    9 => (object) [
        'nama' => 'Medis Kebidanan & Kandungan',
        'key' => 'penilaian-medis-kebidanan',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-kebidanan')),
        'fr' => ['ri', 'rj'],
    ],
    10 => (object) [
        'nama' => 'Medis Psikiatri',
        'key' => 'penilaian-medis-psikiatri',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-psikiatri')),
        'fr' => ['rj'],
    ],
    11 => (object) [
        'nama' => 'Medis Neurologi',
        'key' => 'penilaian-medis-neurologi',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-neurologi')),
        'fr' => ['rj'],
    ],
    12 => (object) [
        'nama' => 'Medis Penyakit Dalam',
        'key' => 'penilaian-medis-penyakit-dalam',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-penyakit-dalam')),
        'fr' => ['rj'],
    ],
    13 => (object) [
        'nama' => 'Medis Mata',
        'key' => 'penilaian-medis-mata',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-mata')),
        'fr' => ['rj'],
    ],
    14 => (object) [
        'nama' => 'Medis THT',
        'key' => 'penilaian-medis-tht',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-tht')),
        'fr' => ['rj'],
    ],
    15 => (object) [
        'nama' => 'Medis Bedah',
        'key' => 'penilaian-medis-bedah',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-bedah')),
        'fr' => ['rj'],
    ],
    16 => (object) [
        'nama' => 'Medis Geriatri',
        'key' => 'penilaian-medis-geriatri',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-geriatri')),
        'fr' => ['rj'],
    ],
    17 => (object) [
        'nama' => 'Medis Orthopedi',
        'key' => 'penilaian-medis-orthopedi',
        'url' => (new \App\Http\Traits\GlobalFunction())->generateLink($link_param, url('penilaian-medis-orthopedi')),
        'fr' => ['rj'],
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
?>

<ul class="nav nav-tabs">
    @foreach ($item as $key => $value)
        @if (in_array($link_param['fr'], $value->fr))
            <li class="nav-item border-radius-top text-center button-tabs ms-2">
                <a class="nav-link border-radius-top tabs text-muted  <?= $active == $key ? 'active' : '' ?>"
                    href="<?= $value->url ?>"><?= $value->nama ?></a>
            </li>
        @endif
    @endforeach
</ul>