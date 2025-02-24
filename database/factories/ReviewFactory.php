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
        $products = Product::with('среднийРейтинг')->get();
        foreach ($products as $product) {
            $reviewCount = rand(5, 35);
            if ($product->среднийРейтинг()->avg('средний_рейтинг') ?? 3) {
                for ($i = 0; $i < $reviewCount; $i++) {
                    $reviewData = $this->содержание($product);
                    $product->отзывы()->create([
                        'рейтинг' => $reviewData['рейтинг'],
                        'отзыв' => $reviewData['отзыв'],
                        'товар_id' => $product->id,
                        'пользователь_id' => $this->случайныйПользователь(),
                    ]);
                }
            }
        }
    }
    public function содержание($product)
    {
        $rand = rand(4, 5);
        $templates = [
            1 => [
                "К сожалению, товар «{$product->название}» не оправдал ожиданий.",
                "Очень разочарован(а) товаром «{$product->название}».",
                "Никому не рекомендую покупать «{$product->название}».",
            ],
            2 => [
                "Товар «{$product->название}» мог бы быть лучше.",
                "Есть несколько серьезных недостатков у «{$product->название}».",
                "Не так плохо, но покупать «{$product->название}» не рекомендую.",
            ],
            3 => [
                "Товар «{$product->название}» на троечку. Обычный.",
                "Средний продукт, ничего особенного в «{$product->название}».",
                "Нормально, но могло быть лучше: «{$product->название}».",
            ],
            4 => [
                "Хороший товар «{$product->название}», рекомендую.",
                "Мне понравился продукт «{$product->название}».",
                "Качественный товар «{$product->название}», хотя есть небольшие недостатки.",
            ],
            5 => [
                "Превосходный товар «{$product->название}»! Очень доволен(а).",
                "Идеальный продукт! Спасибо за «{$product->название}».",
                "Товар «{$product->название}» превзошел мои ожидания!",
            ],
        ];
        $reviewTemplate = $templates[$rand][array_rand($templates[$rand])];
        return [
            'рейтинг' => $rand,
            'отзыв' => $reviewTemplate,
        ];
    }
}
