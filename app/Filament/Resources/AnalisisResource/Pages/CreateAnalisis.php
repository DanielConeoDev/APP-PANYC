<?php

namespace App\Filament\Resources\AnalisisResource\Pages;

use App\Filament\Resources\AnalisisResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnalisis extends CreateRecord
{
    protected static string $resource = AnalisisResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
