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

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class ComponenteResource extends Resource
{
    protected static ?string $model = Componente::class;

    protected static ?string $navigationGroup = 'Parametros';

    protected static ?string $navigationIcon = 'gmdi-hive-tt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Crear Componente')
                    ->icon('gmdi-hive-tt')
                    //->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        Grid::make([
                            'default' => 2,
                        ])
                            ->schema([
                                Forms\Components\Select::make('analisis_id')
                                    ->relationship('analisis', 'analisis')
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('componente')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('detalles'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('analisis.analisis')
                    ->searchable()
                    ->label('Análisis'),
                Tables\Columns\TextColumn::make('componente')
                    ->searchable()
                    ->label('Componente'),
                Tables\Columns\TextColumn::make('detalles')
                    ->label('Detalles')
                    ->markdown()
                    ->toggleable(true, $isToggledHiddenByDefault = true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->toggleable(true, $isToggledHiddenByDefault = true)
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
