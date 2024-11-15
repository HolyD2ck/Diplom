<?php

namespace App\Filament\Admin\Resources\AttributeValueResource\Pages;

use App\Filament\Admin\Resources\AttributeValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttributeValues extends ListRecords
{
    protected static string $resource = AttributeValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
