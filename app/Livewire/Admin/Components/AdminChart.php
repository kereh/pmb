<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class AdminChart extends Component {
    public $seriesData;
    public $timestamps;

    public function mount($seriesData, $timestamps) : void {
        $this->seriesData = $seriesData;
        $this->timestamps = $timestamps;
    }
}
