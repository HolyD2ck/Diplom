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
        $mainPhotosPath = public_path('faker/main/' . $product->категория->название);
        $otherPhotosPath = public_path('faker/other/' . $product->категория->название);

        $mainPhotos = array_diff(scandir($mainPhotosPath), ['.', '..']);
        $otherPhotos = array_diff(scandir($otherPhotosPath), ['.', '..']);

        $mainPhotoFile = $mainPhotos[array_rand($mainPhotos)];

        $additionalPhotosFiles = count($otherPhotos) > 3 ? array_rand(array_flip($otherPhotos), 3) : $otherPhotos;

        $destinationPath = storage_path('app/public/photos/products/' . $product->название);

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $mainPhotoSource = $mainPhotosPath . '/' . $mainPhotoFile;
        $mainPhotoDestination = $destinationPath . '/' . $mainPhotoFile;
        File::copy($mainPhotoSource, $mainPhotoDestination);

        Photo::create([
            'путь' => 'photos/products/' . $product->название . '/' . $mainPhotoFile,
            'основное' => true,
            'товар_id' => $product->id,
        ]);

        foreach ($additionalPhotosFiles as $photoFile) {
            $photoSource = $otherPhotosPath . '/' . $photoFile;
            $photoDestination = $destinationPath . '/' . $photoFile;
            File::copy($photoSource, $photoDestination);

            Photo::create([
                'путь' => 'photos/products/' . $product->название . '/' . $photoFile,
                'основное' => false,
                'товар_id' => $product->id,
            ]);
        }
    }

}
