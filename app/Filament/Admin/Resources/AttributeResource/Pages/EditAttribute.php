<?php

namespace App\Filament\Admin\Resources\AttributeResource\Pages;

use App\Filament\Admin\Resources\AttributeResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditAttribute extends EditRecord
{
    protected static string $resource = AttributeResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return array_merge($data, [
            'id' => DB::table('атрибуты')->max('id') + 1,
        ]);
    }
}
