<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Payments;
use App\Models\ProgramStudi;
use App\Models\User;
use Filament\Support\Enums\IconPosition;

class MainWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $uang_masuk = Payments::sum('price');

        return [
            Stat::make('Uang Masuk', 'Rp. ' . number_format($uang_masuk, 0, ',', '.'))
                ->description('Jumlah uang yang masuk')
                ->descriptionIcon('heroicon-m-wallet', IconPosition::Before)
                ->color('primary'),
            
            Stat::make('Calon Mahasiswa', User::whereHas('roles', fn ($query) => $query->where('role', 'calon'))->count())
                ->description('Jumlah Calon Mahasiswa Baru')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('success'),
            
            Stat::make('Program Studi', ProgramStudi::count())
                ->description('Jumlah Program Studi')
                ->descriptionIcon('heroicon-m-academic-cap', IconPosition::Before),
        ];
    }
}
