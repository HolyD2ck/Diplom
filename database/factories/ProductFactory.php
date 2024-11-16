<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'название' => $this->faker->words(3, true),
            'описание' => $this->faker->paragraph(), 
            'производитель' => $this->faker->company(), 
            'цена' => $this->faker->randomFloat(2, 500, 50000), 
            'дата_выпуска' => $this->faker->dateTimeBetween('-5 years', 'now'), 
            'дата_поступления_в_продажу' => $this->faker->dateTimeBetween('-1 years', 'now'), 
            'категория_id' => Category::query()->inRandomOrder()->first()->id ?? null, 
        ];
    }
}
