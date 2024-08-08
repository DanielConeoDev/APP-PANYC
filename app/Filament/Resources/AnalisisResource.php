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

use Filament\Forms\Components\Section;

class AnalisisResource extends Resource
{
    protected static ?string $model = Analisis::class;

    protected static ?string $navigationGroup = 'Parametros';

    protected static ?string $navigationIcon = 'gmdi-science-tt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Crear Tipo de Analisis')
                    ->icon('gmdi-science-tt')
                    //->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        Forms\Components\TextInput::make('analisis')
                            ->label('Tipo de Analisis')
                            ->required()
                            ->unique(Analisis::class, 'analisis')
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('detalles')
                            ->maxLength(65535),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('analisis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('detalles')
                    ->markdown()
                    ->toggleable(true, $isToggledHiddenByDefault = true),
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
