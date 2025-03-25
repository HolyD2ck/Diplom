<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Supplier;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

        ];
    }
    public function createPhotos(Product $product)
    {
        $categories = [
            'Процессоры' => 'Processors',
            'Видеокарты' => 'GraphicsCards',
            'Материнские платы' => 'Motherboards',
            'Оперативная память' => 'RAM',
            'Корпуса' => 'Cases',
            'Мониторы' => 'Monitors',
            'Блоки питания' => 'PowerSupplies',
            'SSD' => 'SSD',
            'HDD' => 'HDD',
        ];

        $categoryName = $categories[$product->категория->название] ?? null;

        $mainPhotosPath = public_path("faker/main/{$categoryName}");
        $otherPhotosPath = public_path("faker/other/{$categoryName}");

        $mainPhotos = array_diff(scandir($mainPhotosPath), ['.', '..']);
        $otherPhotos = array_diff(scandir($otherPhotosPath), ['.', '..']);

        $mainPhotoFile = $mainPhotos[array_rand($mainPhotos)];

        $otherPhotos = array_values($otherPhotos);
        shuffle($otherPhotos);

        $additionalPhotosFiles = array_slice($otherPhotos, 0, min(3, count($otherPhotos)));

        Photo::create([
            'путь' => "faker/main/{$categoryName}/{$mainPhotoFile}",
            'основное' => true,
            'товар_id' => $product->id,
        ]);

        foreach ($additionalPhotosFiles as $photoFile) {
            Photo::create([
                'путь' => "faker/other/{$categoryName}/{$photoFile}",
                'основное' => false,
                'товар_id' => $product->id,
            ]);
        }
    }

}
