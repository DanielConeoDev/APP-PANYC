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

class AlimentoResource extends Resource
{
    protected static ?string $model = Alimento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                                    TextInput::make('codigo'),
                                    TextInput::make('alimento')
                                ]),
                            Wizard\Step::make('Informacion')
                                ->schema([
                                    Select::make('grupo_id')
                                        ->relationship('grupo', 'grupo'),
                                    Select::make('parte_id')
                                        ->relationship('parte', 'parte'),
                                ]),
                            Wizard\Step::make('Componentes')
                                ->schema([
                                    Repeater::make('itemComponentes')
                                        ->relationship()
                                        ->schema([
                                            Select::make('analisis_id')
                                                ->relationship('analisis', 'analisis'),
                                            Select::make('componente_id')
                                                ->relationship('componente', 'componente'),
                                            TextInput::make('valor')
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
                Tables\Columns\TextColumn::make('codigo')->label('Código')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('alimento')->label('Alimento')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('grupo.fuente.fuente')->label('Fuente')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('grupo.grupo')->label('Grupo')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('parte.parte')->label('Parte')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('itemComponentes.analisis.analisis')->label('Análisis'),
                Tables\Columns\TextColumn::make('itemComponentes.componente.componente')->label('Componente'),
                Tables\Columns\TextColumn::make('itemComponentes.valor')->label('Valor'),
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
            'index' => Pages\ListAlimentos::route('/'),
            'create' => Pages\CreateAlimento::route('/create'),
            'edit' => Pages\EditAlimento::route('/{record}/edit'),
        ];
    }
}
