<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlimentoResource\Pages;
use App\Filament\Resources\AlimentoResource\RelationManagers;
use App\Models\Alimento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;

class AlimentoResource extends Resource
{
    protected static ?string $model = Alimento::class;

    protected static ?string $navigationGroup = 'Centro de Alimentos';

    protected static ?string $navigationIcon = 'gmdi-no-food-tt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1
                ])
                    ->schema([
                        Wizard::make([
                            Wizard\Step::make('Datos')
                                ->schema([
                                    Grid::make([
                                        'default' => 2,
                                    ])
                                        ->schema([
                                            TextInput::make('codigo')
                                                ->required(),
                                        ]),
                                    TextInput::make('alimento')
                                        ->label('Nombre del Alimento')
                                        ->required(),
                                ]),
                            Wizard\Step::make('Informacion')
                                ->schema([
                                    Grid::make([
                                        'default' => 2,
                                    ])
                                        ->schema([
                                            Select::make('grupo_id')
                                                ->relationship('grupo', 'grupo')
                                                ->searchable()
                                                ->preload()
                                                ->required(),
                                            Select::make('parte_id')
                                                ->searchable()
                                                ->preload()
                                                ->relationship('parte', 'parte')
                                                ->required(),
                                        ]),
                                ]),
                            Wizard\Step::make('Componentes')
                                ->schema([
                                    Repeater::make('itemComponentes')
                                        ->relationship()
                                        ->schema([
                                            Grid::make([
                                                'default' => 3,
                                            ])
                                                ->schema([
                                                    Select::make('analisis_id')
                                                        ->relationship('analisis', 'analisis')
                                                        ->searchable()
                                                        ->preload()
                                                        ->required(),
                                                    Select::make('componente_id')
                                                        ->relationship('componente', 'componente')
                                                        ->searchable()
                                                        ->preload()
                                                        ->required(),
                                                    TextInput::make('valor')
                                                        ->required(),
                                                ])
                                        ])
                                ]),
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                ->label('Código')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('alimento')
                ->label('Alimento')
                ->searchable(),
                Tables\Columns\TextColumn::make('grupo.fuente.fuente')
                ->label('Fuente')
                ->toggleable(true, $isToggledHiddenByDefault = true)
                ->searchable(),
                Tables\Columns\TextColumn::make('grupo.grupo')
                ->label('Grupo Alimenticio')
                ->searchable(),
                Tables\Columns\TextColumn::make('parte.parte')
                ->label('Parte Analizada')
                ->searchable(),
                Tables\Columns\TextColumn::make('itemComponentes.analisis.analisis')
                ->label('Análisis')
                ->toggleable(true, $isToggledHiddenByDefault = true),
                Tables\Columns\TextColumn::make('itemComponentes.componente.componente')
                ->toggleable(true, $isToggledHiddenByDefault = true)
                ->label('Componente'),
                Tables\Columns\TextColumn::make('itemComponentes.valor')
                ->toggleable(true, $isToggledHiddenByDefault = true)
                ->label('Valor'),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Creacion')
                ->toggleable(true, $isToggledHiddenByDefault = true),
                Tables\Columns\TextColumn::make('updated_at')
                ->label('Actualizacion')
                ->toggleable(true, $isToggledHiddenByDefault = true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('codigo')
                    ->label('Codigo'),
                TextEntry::make('alimento')
                    ->label('Alimento'),
                TextEntry::make('itemComponentes.componente.componente')
                    ->label('Componetes'),
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
            'index' => Pages\ListAlimentos::route('/'),
            'create' => Pages\CreateAlimento::route('/create'),
            'edit' => Pages\EditAlimento::route('/{record}/edit'),
        ];
    }
}
