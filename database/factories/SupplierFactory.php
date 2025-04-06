<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            'название_компании' => $this->faker->company(),
            'контактное_лицо' => $this->faker->name(),
            'телефон' => $this->faker->phoneNumber(),
            'электронная_почта' => $this->faker->unique()->safeEmail(),
            'вебсайт' => $this->faker->url(),
            'банковский_счет' => $this->faker->numerify('####################'),
            'инн' => $this->faker->numerify('##########'),
            'дата_начала_сотрудничества' => $this->faker->dateTimeBetween('-10 years', '-1 year')
                ->format('Y-m-d'),
            'дата_окончания_сотрудничества' => $this->faker->optional(0.5)
                ->dateTimeBetween('-1 year', 'now')?->format('Y-m-d'),
        ];
    }
}
