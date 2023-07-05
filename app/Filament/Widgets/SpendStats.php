<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Database\Eloquent\Builder;

class SpendStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        $totalSpend = auth()->user()->spends()->whereMonth('date', now()->format('m'))->sum('value');
        $mostSpendTag = auth()->user()->tags()
            ->withSum('spends', 'value')
            ->whereHas('spends', function (Builder $query) {
                $query->whereMonth('spends.date', now()->format('m'));
            })
            ->has('spends')
            ->orderByDesc('spends_sum_value')
            ->first();

        $mostSpendTagName = $mostSpendTag?->name ?? 'R$ 0,00';
        return [
            Card::make('Total spend current month', 'R$ '.$totalSpend),
            Card::make('Most spend category current month', $mostSpendTagName),
        ];
    }
}
