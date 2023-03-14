<?php 
    $item=[
        1=>(object)[
            'nama'=>'BPJS',
            'key'=>'resep',
            'url' => url('/') . "/setting-api-aplikasi",
        ],
        // 2=>(object)[
        //     'nama'=>'A',
        //     'key'=>'racikan',
        //     'url' => url('/') . "/setting-api-aplikasi?type=2",
        // ],
        // 3=>(object)[
        //     'nama'=>'B',
        //     'key'=>'copy-resep',
        //     'url' => url('/') . "/setting-api-aplikasi?type=3",
        // ]
    ];

    $item=(new \App\Http\Traits\AuthFunction)->checkMenuAkses($item);

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