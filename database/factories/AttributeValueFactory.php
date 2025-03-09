<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\Attribute;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttributeValue>
 */
class AttributeValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AttributeValue::class;
    public function definition(): array
    {
        return [
            'товар_id' => Product::factory(),
            'атрибут_id' => Attribute::factory(),
            'значение' => $this->faker->word,
        ];

    }
}
