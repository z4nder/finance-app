<?php

namespace App\Filament\Widgets;

use Filament\Widgets\PieChartWidget;
use Illuminate\Database\Eloquent\Builder;

class SpendsByTagChart extends PieChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Spend by tag';

    public ?string $filter = 'today';

    protected static ?string $maxHeight = '300px';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Current Week',
            'month' => 'Current Month',
            'year' => 'Current Year',
        ];
    }

    protected function getData(): array
    {
        $data = auth()->user()->tags()
            ->withSum('spends', 'value')
            ->whereHas('spends', function (Builder $query) {
                //$query->where
            })
            ->has('spends')
            //->whereMonth('spends.created_at', '04')
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
