<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DealResource\Pages;
use App\Filament\Resources\DealResource\RelationManagers;
use App\Models\Deal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DealResource extends Resource
{
    protected static ?string $model = Deal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('value')->label('value'),
                Forms\Components\TextInput::make('probability')->label('probability'),
                Forms\Components\TextInput::make('expected_close_date')->label('expected_close_date'),
                Forms\Components\TextInput::make('notes')->label('notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('value')->label('value'),
                Tables\Columns\TextColumn::make('probability')->label('probability'),
                Tables\Columns\TextColumn::make('expected_close_date')->label('expected_close_date'),
                Tables\Columns\TextColumn::make('notes')->label('notes'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListDeals::route('/'),
            'create' => Pages\CreateDeal::route('/create'),
            'edit' => Pages\EditDeal::route('/{record}/edit'),
        ];
    }
}
