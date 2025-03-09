<?php

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use App\Filament\Admin\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    {
        parent::save($shouldRedirect, $shouldSendSavedNotification);  // Сохраняем запись

        $attributes = $this->data['значенияАтрибутов'];
        $productId = $this->data['id'];

        DB::table('значения_атрибутов')->where('товар_id', $productId)->delete();

        foreach ($attributes as $attributeId => $data) {
            foreach ($data['значения'] as $key => $value) {
                DB::table('значения_атрибутов')->insert([
                    'товар_id' => $productId,
                    'атрибут_id' => $key,
                    'значение' => $value,
                ]);
            }
        }
        $oldPhotos = DB::table('фотографии')->where('товар_id', $productId)->get();

        DB::table('фотографии')->where('товар_id', $productId)->delete();

        if (isset($this->data['основное_фото'])) {
            $mainPhotoPath = "photos/products/" . (is_array($this->data['основное_фото']) ? reset($this->data['основное_фото']) : $this->data['основное_фото']);
            DB::table('фотографии')->insert([
                'товар_id' => $productId,
                'путь' => $mainPhotoPath,
                'основное' => 1,
            ]);
        }

        if (isset($this->data['фотографии'])) {
            foreach ((array) $this->data['фотографии'] as $photo) {
                $photoPath = "photos/products/" . $photo;
                DB::table('фотографии')->insert([
                    'товар_id' => $productId,
                    'путь' => $photoPath,
                    'основное' => 0,
                ]);
            }
        }
    }

}
