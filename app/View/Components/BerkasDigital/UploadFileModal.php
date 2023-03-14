<?php

namespace App\View\Components\BerkasDigital;

use Illuminate\View\Component;

class UploadFileModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $berkasList;
    public function __construct($berkasList)
    {
        $this->berkasList = $berkasList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.berkas-digital.upload-file-modal',['berkas_list' => $this->berkasList]);
    }
}
