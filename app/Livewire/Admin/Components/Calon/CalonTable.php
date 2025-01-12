<?php

namespace App\Livewire\Admin\Components\Calon;

use App\Models\User;

use Livewire\Attributes\Computed;
use Livewire\Component;

class CalonTable extends Component {
    
    #[Computed()]
    public function list() {
        return User::with(['data', 'payment', 'seleksi'])
            ->whereHas('roles', function ($query) {
                $query->where('role', '!=', 'admin');
            }
        )->paginate(10);
    }
}
