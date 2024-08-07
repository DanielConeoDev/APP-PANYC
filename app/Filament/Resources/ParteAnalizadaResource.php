<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParteAnalizadaResource\Pages;
use App\Filament\Resources\ParteAnalizadaResource\RelationManagers;
use App\Models\ParteAnalizada;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParteAnalizadaResource extends Resource
{
    protected static ?string $model = ParteAnalizada::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('parte')
                    ->required()
                    ->maxLength(255)
                    ->unique(),
                Forms\Components\Textarea::make('detalles')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parte')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('detalles')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListParteAnalizadas::route('/'),
            'create' => Pages\CreateParteAnalizada::route('/create'),
            'edit' => Pages\EditParteAnalizada::route('/{record}/edit'),
        ];
    }
}
