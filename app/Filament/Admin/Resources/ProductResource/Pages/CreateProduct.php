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
        $attributes = $this->data['атрибуты'];
        $lastProductId = Product::max('id');
        $path = $this->data['фотографии'];
        //dd($this->data['основное_фото']);
        foreach ($attributes as $key => $attribute) {

            foreach ($attribute as $attributeId => $value) {
                DB::table('значения_атрибутов')->insert([
                    'товар_id' => $lastProductId,
                    'атрибут_id' => $attributeId,
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
