<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Address::class;
    public function definition(): array
    {
        return [
            'название_пункта' => $this->faker->company,
            'улица' => $this->faker->streetAddress,
            'город' => $this->faker->city,
            'область' => $this->faker->region,
            'почтовый_индекс' => $this->faker->postcode,
            'страна' => $this->faker->country,
            'часы_работы' => $this->Часы_работы(),
            'телефон' => $this->faker->optional()->phoneNumber,
            'координаты' => $this->faker->optional()->latitude . ', ' . $this->faker->longitude,
        ];

    }
    public function Часы_работы(): string
    {
        $weekdays = 'Пн-Суб: ' . $this->faker->time('H:i') . '-' . $this->faker->time('H:i');
        $sunday = 'Вс: выходной';
        return $weekdays . ' ' . $sunday;
    }
}
