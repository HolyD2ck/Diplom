<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'имя' => $this->faker->firstName(),
            'фамилия' => $this->faker->lastName(),
            'должность' => $this->faker->jobTitle(),
            'электронная_почта' => $this->faker->unique()->safeEmail(),
            'телефон' => $this->faker->phoneNumber(),
            'дата_рождения' => $this->faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
            'дата_найма' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            'зарплата' => $this->faker->randomFloat(2, 30000, 200000), // зарплата от 30,000 до 200,000
            'адрес' => $this->faker->address(),
        ];
    }
}
