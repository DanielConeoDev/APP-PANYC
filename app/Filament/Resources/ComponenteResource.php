<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponenteResource\Pages;
use App\Filament\Resources\ComponenteResource\RelationManagers;
use App\Models\Componente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComponenteResource extends Resource
{
    protected static ?string $model = Componente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('analisis_id')
                    ->relationship('analisis', 'analisis')
                    ->required(),
                Forms\Components\TextInput::make('componente')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('detalles')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListComponentes::route('/'),
            'create' => Pages\CreateComponente::route('/create'),
            'edit' => Pages\EditComponente::route('/{record}/edit'),
        ];
    }
}
