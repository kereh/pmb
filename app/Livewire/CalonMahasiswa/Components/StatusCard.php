<?php

namespace App\Livewire\CalonMahasiswa\Components;

use Livewire\Component;

class StatusCard extends Component {
    public $color;
    public $icon;
    public $text;
    public $data;

    public function mount($color, $icon, $text, $data) {
        $this->color = $color;
        $this->icon = $icon;
        $this->text = $text;
        $this->data = $data;
    }
}
