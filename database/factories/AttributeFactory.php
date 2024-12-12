<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Attribute;
use Log;

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
    public function createAttributes($attributes, $categoryId)
    {
        foreach ($attributes as $attributeName) {
            $attribute = Attribute::create([
                'название' => $attributeName,
            ]);
            $attribute->категории()->attach($categoryId);
        }
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
        return $this->createAttributes($attributes, $categoryId);
    }
    public function АтрибутыПроцессоры()
    {
        $categoryId = Category::where('название', '=', 'Процессоры')->value('id');
        $attributes = [
            'Сокет',
            'Количество ядер',
            'Число потоков',
            'Обьем кэша',
            'Базовая частота',
            'Максимальная частота',
            'Тепловыделение',
            'Максимальная температура',
            'Графическое ядро',
        ];
        return $this->createAttributes($attributes, $categoryId);
    }
    public function АтрибутыМатеринскиеПлаты()
    {
        $categoryId = Category::where('название', '=', 'Материнские платы')->value('id');
        $attributes = [
            'Форм-фактор',
            'Высота',
            'Ширина',
            'Чипсет',
            'Тип поддерживаемой памяти',
            'Количество слотов памяти',
            'Количество каналов памяти',
            'Максимальный объем памяти',
            'Поддежка NVMe',
            'Количество портов SATA',
        ];
        return $this->createAttributes($attributes, $categoryId);
    }
    public function АтрибутыОперативнаяПамять()
    {
        $categoryId = Category::where('название', '=', 'Оперативная память')->value('id');
        $attributes = [
            'Форм-фактор памяти',
            'Обьем памяти',
            'Тактовая частота',
            'Ранговость',
            'CAS Latency',
            'RAS Latency',
            'Наличие радиатора',
            'Подсветка',
            'Напряжение питания',
        ];
        return $this->createAttributes($attributes, $categoryId);
    }

    public function АтрибутыКорпуса()
    {
        $categoryId = Category::where('название', '=', 'Корпуса')->value('id');
        $attributes = [
            'Типоразмер корпуса',
            'Ориентация материнской платы',
            'Вес',
            'Материал корпуса',
            'Толщина корпуса',
            'Форм-фактор совместимых материнских плат',
            'Форм-фактор совместимых блоков питания',
            'Размещение блока питания',
            'Максимальная высота видеокарты',
            'Максимальная высота куллера процессора',
        ];
        return $this->createAttributes($attributes, $categoryId);
    }
    public function АтрибутыБлокиПитания()
    {
        $categoryId = Category::where('название', '=', 'Блоки питания')->value('id');
        $attributes = [
            'Оплетка прововдов',
            'Мощность',
            'Основной разъем питания',
            'Разъемы для питания процессора',
            'Разъемы для питания видеокарты',
            'Количество разьемов 15-pin SATA',
            'Количество разьемов 4-pin Molex',
            'Длина основного кабеля',
            'Длина кабеля питания процессора',
            'Длина кабеля питания видеокарты',
        ];
        return $this->createAttributes($attributes, $categoryId);
    }
    public function АтрибутыSSD()
    {
        $categoryId = Category::where('название', '=', 'SSD')->value('id');
        $attributes = [
            'Обьем накопителя',
            'NVMe',
            'Разьем подключения',
            'Максимальная скорость последовательного чтения',
            'Максимальная скорость последовательной записи',
            'Максимальный ресурс записи',
        ];
        return $this->createAttributes($attributes, $categoryId);
    }
    public function АтрибутыHDD()
    {
        $categoryId = Category::where('название', '=', 'HDD')->value('id');
        $attributes = [
            'Объем кэш-памяти',
            'Скорость вращения шпинделя',
            'Интерфейс',
            'Пропускная способность интерфейса',
            'Максимальная скорость передачи данных',
            'Число циклов позиционирования-парковки',
            'Уровень шума во время работы',
        ];
        return $this->createAttributes($attributes, $categoryId);
    }
    public function АтрибутыМониторы()
    {
        $categoryId = Category::where('название', '=', 'Мониторы')->value('id');
        $attributes = [
            'Изогнутый экран',
            'Диагональ экрана (дюйм)',
            'Максимальное разрешение',
            'Соотношение сторон',
            'Тип подсветки матрицы',
            'Технология изготовления матрицы',
            'Покрытие экрана',
            'Поддержка HDR',
            'Видеоразъемы',
            'Глубина цвета',
            'Плотность пикселей',
            'Максимальная частота обновления экрана',
        ];
        return $this->createAttributes($attributes, $categoryId);

    }
    public function Связи()
    {
        $attributeCategories = [
            'Цвет' => ['Видеокарты', 'Мониторы', 'Корпуса', 'Блоки питания', 'Оперативная память'],
            'Тип памяти' => ['Видеокарты', 'Оперативная память'],
            'Длина' => ['Корпуса', 'Видеокарты', 'Блоки питания', 'Мониторы'],
            'Техпроцесс' => ['Видеокарты', 'Процессоры'],
            'Частота памяти' => ['Видеокарты', 'Оперативная память'],
            'Потребляемая мощность' => ['Видеокарты', 'Процессоры'],
            'Сокет' => ['Процессоры', 'Материнские платы'],
            'Форм-фактор' => ['Блоки питания', 'Корпуса', 'Материнские платы'],
            'Высота' => ['Материнские платы', 'Корпуса', 'Блоки питания', 'Мониторы', 'Видеокарты'],
            'Ширина' => ['Материнские платы', 'Корпуса', 'Блоки питания', 'Мониторы', 'Видеокарты'],
            'Подсветка' => ['Корпуса', 'Мониторы', 'Оперативная память', 'Видеокарты'],
            'Вес' => ['Корпуса', 'Мониторы', 'Блоки питания', 'Видеокарты'],
            'Обьем накопителя' => ['SSD', 'HDD'],
        ];
        foreach ($attributeCategories as $attributeName => $categories) {
            $attribute = Attribute::firstOrCreate(['название' => $attributeName]);

            foreach ($categories as $categoryName) {
                $categoryId = Category::where('название', $categoryName)->value('id');

                if ($categoryId) {
                    $attribute->категории()->syncWithoutDetaching([$categoryId]);
                }
            }
        }
    }
}
