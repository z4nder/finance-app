<?php

namespace App\Filament\Widgets;

use Filament\Widgets\PieChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class SpendsByTagChart extends PieChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Spend by tag';

    public ?string $filter = 'monthFilter';

    protected static ?string $maxHeight = '300px';

    public array $months = [];

    public function boot()
    {
        $this->months = array_map(fn($month) => Carbon::create(null, $month)->format('F'), range(1, 12));

        $this->filter = array_search(now()->format('F'), $this->months);
    }

    protected function getFilters(): ?array
    {
        return $this->months;
    }

    protected function getData(): array
    {
        $filterMonthNumber = Carbon::parse($this->months[$this->filter]);

        $data = auth()->user()->tags()
            ->withSum([
                'spends' => function ($query) use ($filterMonthNumber) {
                    $query->whereMonth('date', $filterMonthNumber);
                }
            ], 'value')
            ->get();


        return [
            'datasets' => [
                [
                    'backgroundColor' => $data->pluck('color'),
                    'label' => 'Blog posts',
                    'data' => $data->pluck('spends_sum_value'),
                ],
            ],

            'labels' => $data->pluck('name'),
        ];
    }
}
