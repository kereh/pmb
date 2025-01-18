<?php

namespace App\Filament\Widgets;

use App\Models\ProgramStudi;
use Filament\Widgets\ChartWidget;

class ProdiChartWidget extends ChartWidget
{
    protected static ?string $description = 'Jumlah Calon Setiap Program Studi Dalam Setahun';
    protected int | string | array $columnSpan = '1';

    protected function getData(): array
    {
        $programStudiData = ProgramStudi::withCount('data')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Data Per Program Studi',
                    'data' => $programStudiData->pluck('data_count'),
                    'borderColor' => 'transparent',
                    'backgroundColor' => $programStudiData->map(fn ($_, $key) => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                    ][$key % 5]),
                ],
            ],
            'labels' => $programStudiData->pluck('nama'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
