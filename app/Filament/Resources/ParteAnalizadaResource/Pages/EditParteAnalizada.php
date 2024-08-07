<?php

namespace App\Filament\Resources\ParteAnalizadaResource\Pages;

use App\Filament\Resources\ParteAnalizadaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParteAnalizada extends EditRecord
{
    protected static string $resource = ParteAnalizadaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
