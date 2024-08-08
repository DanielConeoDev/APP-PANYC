<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrupoResource\Pages;
use App\Filament\Resources\GrupoResource\RelationManagers;
use App\Models\Grupo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;

class GrupoResource extends Resource
{
    protected static ?string $model = Grupo::class;

    protected static ?string $navigationGroup = 'Información';

    protected static ?string $navigationIcon = 'gmdi-dashboard-tt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Crear Grupo')
                    ->icon('gmdi-dashboard-tt')
                    //->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        Grid::make([
                            'default' => 2,
                        ])
                            ->schema([
                                Forms\Components\Select::make('fuente_id')
                                    ->relationship('fuente', 'fuente')
                                    ->required(),
                            ]),
                        Grid::make([
                            'default' => 1,
                        ])
                            ->schema([
                                Forms\Components\TextInput::make('grupo')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('detalles'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fuente.fuente')
                    ->label('Fuente')
                    ->limit(20)
                    ->searchable(),
                Tables\Columns\TextColumn::make('grupo')
                    ->label('Grupo')
                    ->limit(20)
                    ->searchable(),
                Tables\Columns\TextColumn::make('detalles')
                    ->label('Detalles adicionales')
                    ->markdown()
                    ->limit(50)
                    ->toggleable(true, $isToggledHiddenByDefault = true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->sortable()
                    ->toggleable(true, $isToggledHiddenByDefault = true)
                    ->date(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de actualización')
                    ->sortable()
                    ->toggleable(true, $isToggledHiddenByDefault = true)
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
                TextEntry::make('grupo')
                    ->label('grupo'),
                TextEntry::make('fuente.fuente')
                    ->label('Fuente'),
                TextEntry::make('detalles')
                    ->label('Detalles')
                    ->markdown(),
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
            'index' => Pages\ListGrupos::route('/'),
            'create' => Pages\CreateGrupo::route('/create'),
            'edit' => Pages\EditGrupo::route('/{record}/edit'),
        ];
    }
}
