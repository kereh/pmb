<?php

namespace App\Filament\Resources\BiayaPendaftaranResource\Pages;

use App\Filament\Resources\BiayaPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBiayaPendaftarans extends ListRecords
{
    protected static string $resource = BiayaPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
