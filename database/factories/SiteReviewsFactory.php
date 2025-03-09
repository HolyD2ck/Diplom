<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteReviews>
 */
class SiteReviewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            "имя_клиента" => $this->faker->name(),
            "отзыв" => $this->faker->text(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
