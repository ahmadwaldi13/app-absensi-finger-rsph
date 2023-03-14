<?php 
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
    
    $link_param = [
        'no_rawat' => (!empty($item_pasien->no_rawat) ? $item_pasien->no_rawat : ''),
        'no_rm' => (!empty($item_pasien->no_rm) ? $item_pasien->no_rm : ''),
        'fr' => (!empty($item_pasien->no_fr) ? $item_pasien->no_fr : ''),
    ];

    $item=[
        1=>(object)[
            'nama'=>'Patologi klinis',
            'key'=>'patologi-klinis',
            'url'=>(new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('patologi-klinis'))
        ],
        2=>(object)[
            'nama'=>'Patologi Anatomi',
            'key'=>'patologi-anatomi',
            'url'=>(new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('patologi-anatomi'))
        ],
        3=>(object)[
            'nama'=>'Pemeriksaan Radiologi',
            'key'=>'pemeriksaan-radiologi',
            'url'=>(new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('pemeriksaan-radiologi'))
        ],
    ];

    // $item=(new \App\Http\Traits\AuthFunction)->checkMenuAkses($item);

    if(!empty($kode_key_old)){
        foreach($item as $key => $value){
            if($active!=$key){
                unset($item[$key]);
            }
        }
    }
?>

<ul class="nav nav-tabs">
    <?php foreach($item as $key => $value){ ?>
        <li class="nav-item border-radius-top text-center button-tabs ms-2">
            <a class="nav-link border-radius-top tabs text-muted  <?= ($active==$key) ? 'active' : '' ?>" href="<?= $value->url ?>"><?= $value->nama ?></a>
        </li>
    <?php } ?>
</ul>