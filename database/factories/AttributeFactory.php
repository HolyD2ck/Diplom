<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Attribute;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
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
    public function АтрибутыВидеокарты()
    {
        $categoryId = Category::where('название', '=', 'Видеокарты')->value('id');

        $attributes = [
            'Назначение',
            'Обьем видеопамяти',
            'Разрядность шины',
            'Тип памяти',
            'Интерфейс подключения',
            'Цвет',
            'Длина',
            'Техпроцесс',
            'Частота памяти',
            'Потребляемая мощность',
        ];

        foreach ($attributes as $attributeName) {
            $attribute = Attribute::create([
                'название' => $attributeName,
            ]);
            $attribute->категории()->attach($categoryId);
        }
    }
}
