<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PaymentsChartWidget extends ChartWidget
{
    protected static ?string $description = 'Uang Masuk per Bulan Dalam Setahun';
    protected int | string | array $columnSpan = '1';

    protected function getData(): array
    {
        $data = DB::table('payments')
            ->selectRaw("to_char(created_at, 'YYYY-MM') as date, SUM(price::numeric) as aggregate")
            ->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Uang Masuk',
                    'data' => $data->pluck('aggregate'),
                ],
            ],
            'labels' => $data->pluck('date'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
