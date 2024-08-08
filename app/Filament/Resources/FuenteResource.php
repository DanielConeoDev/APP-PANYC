<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FuenteResource\Pages;
use App\Filament\Resources\FuenteResource\RelationManagers;
use App\Models\Fuente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;

class FuenteResource extends Resource
{
    protected static ?string $model = Fuente::class;

    protected static ?string $navigationGroup = 'Información';

    protected static ?string $navigationIcon = 'gmdi-source-tt';

    public static function getModelLabel(): string
    {
        return 'Fuente';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([
                        Wizard::make([
                            Wizard\Step::make('Datos de Fuente')
                                ->schema([
                                    TextInput::make('fuente')
                                        ->required()
                                        ->maxLength(255)
                                        ->label('Nombre de la fuente'),
                                    RichEditor::make('detalles')
                                        ->label('Detalles adicionales'),
                                ]),
                            Wizard\Step::make('Detalles de Publicación')
                                ->schema([
                                    Grid::make([
                                        'default' => 2,
                                        'sm' => 1,
                                    ])
                                        ->schema([
                                            TextInput::make('pais')
                                                ->required()
                                                ->maxLength(255)
                                                ->label('País de la fuente'),
                                            DatePicker::make('fecha_publicacion')
                                                ->required()
                                                ->label('Fecha de publicación'),
                                            TextInput::make('url')
                                                ->required()
                                                ->url()
                                                ->unique(Fuente::class, 'url')
                                                ->label('URL de la fuente')
                                                ->columnSpan(2),
                                        ]),
                                ]),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fuente')
                    ->label('Fuente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pais')
                    ->label('País')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_publicacion')
                    ->label('Fecha de publicación')
                    ->date(),
                Tables\Columns\TextColumn::make('url')
                    ->badge()
                    ->label('URL')
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn ($state) => 'Explorar'),
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
                Filter::make('pais')
                    ->label('Filtrar por País'),
                Filter::make('fuente')
                    ->label('Filtrar por Fuente'),
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
                TextEntry::make('fuente')
                    ->label('Fuente'),
                TextEntry::make('fecha_publicacion')
                    ->label('Fecha de Publicación')
                    ->date(),
                TextEntry::make('pais')
                    ->label('País'),
                TextEntry::make('url')
                    ->label('URL')
                    ->badge()
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn ($state) => 'Explorar'),
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
            'index' => Pages\ListFuentes::route('/'),
            'create' => Pages\CreateFuente::route('/create'),
            'edit' => Pages\EditFuente::route('/{record}/edit'),
        ];
    }
}
