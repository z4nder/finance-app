<?php

namespace App\Filament\Resources\SpendResource\Pages;

use App\Filament\Resources\SpendResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpend extends EditRecord
{
    protected static string $resource = SpendResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
