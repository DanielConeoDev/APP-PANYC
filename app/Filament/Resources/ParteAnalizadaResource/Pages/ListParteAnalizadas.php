<?php

namespace App\Filament\Resources\ParteAnalizadaResource\Pages;

use App\Filament\Resources\ParteAnalizadaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParteAnalizadas extends ListRecords
{
    protected static string $resource = ParteAnalizadaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
