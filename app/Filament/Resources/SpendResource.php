<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpendResource\Pages;
use App\Models\Spend;
use App\Tables\Columns\SpendTagsColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class SpendResource extends Resource
{
    protected static ?string $model = Spend::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('date')
                    ->displayFormat('d/m/Y')
                    ->default(now())
                    ->required(),
                TextInput::make('value')
                    ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: 'R$ ', thousandsSeparator: '', decimalPlaces: 2))
                    ->required(),
                Select::make('tags')
                    ->multiple()
                    ->relationship(
                        'tags',
                        'name',
                        fn (Builder $query) => $query->where('tags.created_by', auth()->user()->id)
                    )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('value')->money('brl'),
                SpendTagsColumn::make('tags'),
                Tables\Columns\TextColumn::make('date')
                    ->date('d/m/Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpends::route('/'),
            'create' => Pages\CreateSpend::route('/create'),
            'edit' => Pages\EditSpend::route('/{record}/edit'),
        ];
    }
}
