<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RacikanResep extends Component
{
    public $dataRacikan;
    public $metodeRacik;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dataRacikan, $metodeRacik)
    {
        $this->dataRacikan = $dataRacikan;
        $this->metodeRacik = $metodeRacik;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.racikan-resep');
    }
}
