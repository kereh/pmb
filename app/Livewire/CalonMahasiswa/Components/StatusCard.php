<?php

namespace App\Livewire\CalonMahasiswa\Components;

use Livewire\Component;

class StatusCard extends Component {
    public ?string $route;
    public $color;
    public $icon;
    public $text;
    public $data;

    public function mount($route, $color, $icon, $text, $data) {
        $this->route = $route;
        $this->color = $color;
        $this->icon = $icon;
        $this->text = $text;
        $this->data = $data;
    }
}
