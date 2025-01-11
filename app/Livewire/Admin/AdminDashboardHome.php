<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\ProgramStudi;
use App\Models\Data;

class AdminDashboardHome extends Component {
    #[Layout('components.layouts.layout-admin')]
    public $title = 'Admin Dashboard';

    public $seriesData;
    public $timestamps;

    public function mount() {
        $this->records();
    }

    #[Computed()]
    public function user() {
        return Auth::user();
    }

    #[Computed()]
    public function records() {
        $data = Data::with('program_studi:id,nama')
            ->selectRaw('DATE(created_at) as date, program_studi_id, COUNT(*) as count')
            ->groupBy('date', 'program_studi_id')
            ->orderBy('date')
            ->get();

        $programs = ProgramStudi::all()->pluck('nama', 'id')->toArray();
        $seriesData = [];
        $timestamps = [];

        foreach ($data as $entry) {
            $programName = $programs[$entry->program_studi_id] ?? 'Unknown';

            if (!isset($seriesData[$programName])) {
                $seriesData[$programName] = [
                    'name' => $programName,
                    'data' => [],
                ];
            }

            $seriesData[$programName]['data'][] = [
                'x' => $entry->date,
                'y' => $entry->count,
            ];

            if (!in_array($entry->date, $timestamps)) {
                $timestamps[] = $entry->date;
            }
        }

        $this->seriesData = array_values($seriesData);
        $this->timestamps = $timestamps;
    }
}
