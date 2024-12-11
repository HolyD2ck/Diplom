<?php

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use Illuminate\Support\Facades\DB;
use App\Filament\Admin\Resources\ProductResource;
use Filament\Actions;
use App\Models\AttributeValue;
use App\Models\Product;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;


class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {

        $attributes = $this->data['значенияАтрибутов'];

        $lastProductId = Product::max('id');

        $path = $this->data['фотографии'];

        foreach ($attributes as $attributeId => $data) {
            foreach ($data['значения'] as $key => $value) {
                DB::table('значения_атрибутов')->insert([
                    'товар_id' => $lastProductId,
                    'атрибут_id' => $key,
                    'значение' => $value,
                ]);
            }
        }
        DB::table('фотографии')->insert([
            'товар_id' => $lastProductId,
            'путь' => reset($this->data['основное_фото']),
            'основное' => 1,
        ]);
        foreach ($path as $key => $value) {
            DB::table('фотографии')->insert([
                'товар_id' => $lastProductId,
                'путь' => $value,
                'основное' => 0,
            ]);
        }
    }
}
