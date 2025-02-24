<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
    public function Категории()
    {
        $categories = [
            'Видеокарты',
            'Процессоры',
            'Материнские платы',
            'Оперативная память',
            'Корпуса',
            'Блоки питания',
            'SSD',
            'HDD',
            'Мониторы',

        ];
        foreach ($categories as $category) {
            Category::create([
                'название' => $category,
            ]);
        }
    }
}
