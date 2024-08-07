<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnalisisResource\Pages;
use App\Filament\Resources\AnalisisResource\RelationManagers;
use App\Models\Analisis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnalisisResource extends Resource
{
    protected static ?string $model = Analisis::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('analisis')
                    ->required()
                    ->unique(Analisis::class, 'analisis')
                    ->maxLength(255),
                Forms\Components\Textarea::make('detalles')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('analisis')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('detalles')->sortable()->searchable(),
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
            'index' => Pages\ListAnalises::route('/'),
            'create' => Pages\CreateAnalisis::route('/create'),
            'edit' => Pages\EditAnalisis::route('/{record}/edit'),
        ];
    }
}
