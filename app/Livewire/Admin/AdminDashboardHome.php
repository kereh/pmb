<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class AdminDashboardHome extends Component {
    #[Layout('components.layouts.layout-admin')]
    public $title = 'Admin Dashboard';

    #[Computed()]
    public function user() {
        return Auth::user();
    }
}
