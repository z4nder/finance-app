<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\SpendProgressionByMonth;
use App\Filament\Widgets\SpendsByTagChart;
use App\Filament\Widgets\SpendStats;
use Filament\Pages\Page;

use Filament\Pages\Dashboard as BasePage;
class Dashboard extends BasePage
{

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = -2;

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            SpendStats::class,
            SpendsByTagChart::class,
            SpendProgressionByMonth::class
        ];
    }
}
