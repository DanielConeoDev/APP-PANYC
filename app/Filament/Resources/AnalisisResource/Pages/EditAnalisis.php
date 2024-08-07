<?php

namespace App\Filament\Resources\AnalisisResource\Pages;

use App\Filament\Resources\AnalisisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnalisis extends EditRecord
{
    protected static string $resource = AnalisisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
