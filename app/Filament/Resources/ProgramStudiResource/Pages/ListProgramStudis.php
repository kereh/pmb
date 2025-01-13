<?php

namespace App\Filament\Resources\ProgramStudiResource\Pages;

use App\Filament\Resources\ProgramStudiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramStudis extends ListRecords
{
    protected static string $resource = ProgramStudiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
