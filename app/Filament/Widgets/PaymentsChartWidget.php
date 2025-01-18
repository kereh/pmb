<?php

namespace App\Filament\Widgets;

use App\Models\Payments;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PaymentsChartWidget extends ChartWidget
{
    protected static ?string $description = 'Uang Masuk per Bulan Dalam Setahun';
    protected int | string | array $columnSpan = '1';

    protected function getData(): array
    {
        $data = Trend::model(Payments::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('price');
    
        return [
            'datasets' => [
                [
                    'label' => 'Uang Masuk',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
