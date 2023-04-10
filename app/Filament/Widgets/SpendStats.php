<?php

namespace App\Filament\Widgets;

use App\Models\Spend;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class SpendStats extends BaseWidget
{
    protected function getCards(): array
    {
        $totalSpend =  Spend::sum('value');
        $totalSpend =  Spend::sum('value');

        return [
            Card::make('Total spend', "R$ ".$totalSpend),
            Card::make('Spend rate', '21%'),
            Card::make('Most spend category', 'Nubank'),
        ];
    }
}
