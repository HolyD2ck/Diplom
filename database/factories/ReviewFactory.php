<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
    public function случайныйПользователь()
    {
        $users = User::all();
        $user = $users->random();
        return $user->id;
    }
    public function созданиеОтзывов()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $reviewCount = rand(5, 100);
            for ($i = 0; $i < $reviewCount; $i++) {
                $product->отзывы()->create([
                    'рейтинг' => rand(1, 5),
                    'отзыв' => $this->faker->text(),
                    'товар_id' => $product->id,
                    'пользователь_id' => $this->случайныйПользователь(),
                ]);
            }
        }
    }
}
