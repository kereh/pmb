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
        return [
            Stat::make('Calon Mahasiswa ' . date('Y'), Roles::where('role', 'calon')->whereYear('created_at', date('Y'))->count())
                ->description('Jumlah Calon Mahasiswa Baru')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('success')
        ];
    }
}
