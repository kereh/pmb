<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Roles;
use Filament\Support\Enums\IconPosition;

class CalonMahasiswa extends BaseWidget
{
    protected function getStats(): array
    {
        $calon = Roles::withCount(['users as user_count' => function ($query) {
            $query->whereBetween('created_at', [now()->subYear()->startOfYear(), now()->endOfYear()]);}])
        ->where('role', 'calon')
        ->first();

        return [
            Stat::make('Calon Mahasiswa ' . now()->subYear()->format('Y') . ' - ' . now()->endOfYear()->format('Y'), $calon->user_count)
                ->description('Jumlah Calon Mahasiswa Baru')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('success'),
        ];
    }
}
