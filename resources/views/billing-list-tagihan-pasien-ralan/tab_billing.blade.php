<?php
$item_pasien = (new \App\Http\Traits\ItemPasienFunction())->getItemPasien(Request::get('fr'));

$item = [
    1 => (object) [
        'nama' => 'Rawat Jalan',
        'key' => 'billing-list-tagihan-pasien-ralan',
    ],
    2 => (object) [
        'nama' => 'Rawat Inap',
        'key' => 'billing-list-tagihan-pasien-ranap',
    ],
];

$item = (new \App\Http\Traits\AuthFunction())->checkMenuAkses($item);

?>

<ul class="nav nav-tabs">
    @foreach ($item as $key => $value)
        
        <li class="nav-item border-radius-top text-center" style="width: 200px; background-color: #F5F5F5;">
            <a class="nav-link border-radius-top tabs text-muted  <?= $active_tab == $key ? 'active' : '' ?>"
                href="<?= $value->key ?>"><?= $value->nama ?>
            </a>
        </li>
        
    @endforeach
</ul>