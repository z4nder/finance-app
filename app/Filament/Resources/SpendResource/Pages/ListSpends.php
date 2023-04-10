<?php

namespace App\Filament\Resources\SpendResource\Pages;

use App\Filament\Resources\SpendResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSpends extends ListRecords
{
    protected static string $resource = SpendResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->whereCreatedBy(auth()->user()->id);
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
