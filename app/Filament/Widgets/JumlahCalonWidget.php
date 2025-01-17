<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JumlahCalonWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
             Stat::make('Calon Mahasiswa ', User::whereHas('roles', fn ($query) => $query->where('role', 'calon'))->count())
                ->description('Jumlah Calon Mahasiswa Baru')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('success'),
        ];
    }
}
