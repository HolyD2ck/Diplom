<?php

namespace App\Filament\Admin\Resources\AttributeResource\Pages;

use App\Models\Attribute;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateAttribute extends CreateRecord
{
    protected static string $resource = \App\Filament\Admin\Resources\AttributeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return array_merge($data, [
            'id' => DB::table('атрибуты')->max('id') + 1,
        ]);
    }
}
