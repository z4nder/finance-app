<?php

namespace App\Filament\Widgets;

use App\Models\Spend;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;

class SpendProgressionByMonth extends LineChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';
//    protected static ?array $options = [
//        'scales' => [
//            'yAxes' => [
//                'ticks'=> [
//
//                    'min' => 0,
//                    'max' =>  100,
//                    'stepSize' => 5,
//                ]
//            ],
//        ],
//    ];

    protected function getData(): array
    {
        $months = collect(range(0, today()->format('m') - 1));
        $data = $months->map(function ($i) {
            $date = today()->startOfYear()->startOfMonth()->addMonths($i);

            $total = auth()->user()->spends()
                ->whereDate('date', '>=', $date)
                ->whereDate('date', '<=', $date->endOfMonth())
                ->sum('value');

            return [
                'labels' => $date->shortMonthName,
                'values' => (int) $total,
                'year' => $date->format('d-m-Y')
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Spends',
                    'data' => $data->pluck('values'),
                ],
            ],
            'labels' => $data->pluck('labels'),

        ];
    }
}
