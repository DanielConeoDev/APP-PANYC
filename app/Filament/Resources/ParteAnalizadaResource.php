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

use Filament\Forms\Components\Section;

class ParteAnalizadaResource extends Resource
{
    protected static ?string $model = ParteAnalizada::class;

    protected static ?string $navigationGroup = 'Parámetros';

    protected static ?string $navigationIcon = 'gmdi-bubble-chart-tt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Crear Parte Analizada')
                    ->icon('gmdi-bubble-chart-tt')
                    //->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        Forms\Components\TextInput::make('parte')
                            ->label('Parte Analizada')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('detalles')
                            ->maxLength(65535),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parte')
                    ->label('Parte Analizada')
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
            'index' => Pages\ListParteAnalizadas::route('/'),
            'create' => Pages\CreateParteAnalizada::route('/create'),
            'edit' => Pages\EditParteAnalizada::route('/{record}/edit'),
        ];
    }
}
