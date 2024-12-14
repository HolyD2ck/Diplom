<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Product;
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
            'Форм-фактор' => ['Блоки питания', 'Материнские платы'],
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
    public function ВнесениеАтрибутов(Product $product)
    {
        $categoryName = $product->категория->название;

        $attributes = Attribute::whereHas('категории', function ($query) use ($categoryName) {
            $query->where('название', $categoryName);
        })->get();

        foreach ($attributes as $attribute) {
            $value = $this->созданиеЗначенийАтрибутов($attribute, $categoryName);

            $product->значенияАтрибутов()->create([
                'атрибут_id' => $attribute->id,
                'значение' => $value,
            ]);
        }
    }

    public function созданиеЗначенийАтрибутов($attribute, $categoryName)
    {
        switch ($categoryName) {
            case 'Видеокарты':
                return $this->значенияВидеокарт($attribute);
            case 'Процессоры':
                return $this->значенияПроцессоров($attribute);
            case 'Материнские платы':
                return $this->значенияМатеринскихПлат($attribute);
            case 'Оперативная память':
                return $this->значенияОперативнойПамяти($attribute);
            case 'Корпуса':
                return $this->значенияКорпусов($attribute);
            case 'Блоки питания':
                return $this->значенияБлоковПитания($attribute);
            case 'SSD':
                return $this->значенияSSD($attribute);
            case 'HDD':
                return $this->значенияHDD($attribute);
            case 'Мониторы':
                return $this->значенияМониторов($attribute);
            default:
                return 'Не задано';
        }
    }
    public function значенияВидеокарт($attribute)
    {
        switch ($attribute->название) {
            case 'Назначение':
                return 'Игровая';
            case 'Объем видеопамяти':
                return rand(2, 16) . ' GB';
            case 'Разрядность шины':
                return rand(128, 512) . ' bit';
            case 'Тип памяти':
                $memoryTypes = ['GDDR4', 'GDDR5', 'GDDR6'];
                return $memoryTypes[array_rand($memoryTypes)];
            case 'Интерфейс подключения':
                return 'PCI Express 4.0';
            case 'Цвет':
                $color = ['Черный', 'Белый', 'Розовый'];
                return $color[array_rand($color)];
            case 'Длина':
                return rand(150, 350) . ' мм';
            case 'Техпроцесс':
                return rand(5, 20) . ' nm';
            case 'Частота памяти':
                return rand(1000, 6000) . ' MHz';
            case 'Потребляемая мощность':
                return rand(100, 850) . ' W';
            case 'Высота':
                return rand(20, 35) . ' мм';
            case 'Ширина':
                return rand(120, 180) . ' мм';
            case 'Подсветка':
                return rand(0, 1) ? 'RGB' : 'Нет';
            case 'Вес':
                return rand(300, 2000) . ' г';
            default:
                return 'Не задано';
        }
    }
    public function значенияПроцессоров($attribute)
    {
        switch ($attribute->название) {
            case 'Техпроцесс':
                return rand(5, 14) . ' nm';
            case 'Потребляемая мощность':
                return rand(35, 150) . ' W';
            case 'Сокет':
                $sockets = ['LGA 1151', 'AM4', 'LGA 1200', 'LGA 1700', 'TR4'];
                return $sockets[array_rand($sockets)];
            case 'Количество ядер':
                return rand(1, 16);
            case 'Число потоков':
                return rand(1, 32);
            case 'Обьем кэша':
                return rand(2, 64) . ' MB';
            case 'Базовая частота':
                return rand(2, 4) . ' GHz';
            case 'Максимальная частота':
                return rand(4, 6) . ' GHz';
            case 'Тепловыделение':
                return rand(35, 125) . ' W';
            case 'Максимальная температура':
                return rand(70, 100) . ' °C';
            case 'Графическое ядро':
                return rand(0, 1) ? 'Есть' : 'Нет';
            default:
                return 'Не задано';
        }
    }
    public function значенияМатеринскихПлат($attribute)
    {
        switch ($attribute->название) {
            case 'Сокет':
                $sockets = ['LGA 1151', 'AM4', 'LGA 1200', 'LGA 1700', 'TR4'];
                return $sockets[array_rand($sockets)];
            case 'Форм-фактор':
                $formFactors = ['ATX', 'Micro ATX', 'Mini ITX', 'E-ATX', 'XL-ATX'];
                return $formFactors[array_rand($formFactors)];
            case 'Высота':
                return rand(30, 60) . ' мм';
            case 'Ширина':
                return rand(180, 305) . ' мм';
            case 'Чипсет':
                $chipsets = ['Intel Z590', 'AMD B550', 'Intel H570', 'AMD A520', 'Intel Z490'];
                return $chipsets[array_rand($chipsets)];
            case 'Тип поддерживаемой памяти':
                $memoryTypes = ['DDR4', 'DDR5', 'DDR3'];
                return $memoryTypes[array_rand($memoryTypes)];
            case 'Количество слотов памяти':
                return rand(2, 8);
            case 'Количество каналов памяти':
                return rand(2, 4);
            case 'Максимальный объем памяти':
                return rand(16, 128) . ' GB';
            case 'Поддежка NVMe':
                return rand(0, 1) ? 'Да' : 'Нет';
            case 'Количество портов SATA':
                return rand(2, 8);
            default:
                return 'Не задано';
        }
    }
    public function значенияОперативнойПамяти($attribute)
    {
        switch ($attribute->название) {
            case 'Тип памяти':
                $memoryTypes = ['DDR4', 'DDR5', 'DDR3'];
                return $memoryTypes[array_rand($memoryTypes)];
            case 'Цвет':
                $colors = ['Черный', 'Белый', 'Синий', 'Красный', 'Зеленый'];
                return $colors[array_rand($colors)];
            case 'Частота памяти':
                return rand(1600, 5000) . ' MHz';
            case 'Форм-фактор памяти':
                $formFactors = ['DIMM', 'SO-DIMM'];
                return $formFactors[array_rand($formFactors)];
            case 'Объем памяти':
                return rand(4, 64) . ' GB';
            case 'Тактовая частота':
                return rand(1600, 5000) . ' MHz';
            case 'Ранговость':
                $ranks = ['1R', '2R', '4R'];
                return $ranks[array_rand($ranks)];
            case 'CAS Latency':
                return rand(14, 20);
            case 'RAS Latency':
                return rand(5, 10);
            case 'Наличие радиатора':
                return rand(0, 1) ? 'Есть' : 'Нет';
            case 'Подсветка':
                return rand(0, 1) ? 'Есть' : 'Нет';
            case 'Напряжение питания':
                return rand(1, 6) . ' V';
            default:
                return 'Не задано';
        }
    }
    public function значенияКорпусов($attribute)
    {
        switch ($attribute->название) {
            case 'Цвет':
                $colors = ['Черный', 'Белый', 'Серебристый', 'Красный', 'Синий'];
                return $colors[array_rand($colors)];
            case 'Длина':
                return rand(300, 600) . ' мм';
            case 'Высота':
                return rand(400, 800) . ' мм';
            case 'Ширина':
                return rand(150, 250) . ' мм';
            case 'Подсветка':
                return rand(0, 1) ? 'Есть' : 'Нет';
            case 'Типоразмер корпуса':
                $sizes = ['Tower', 'Mid Tower', 'Mini Tower', 'Desktop'];
                return $sizes[array_rand($sizes)];
            case 'Ориентация материнской платы':
                $orientations = ['Горизонтальная', 'Вертикальная'];
                return $orientations[array_rand($orientations)];
            case 'Вес':
                return rand(3, 15) . ' кг';
            case 'Материал корпуса':
                $materials = ['Сталь', 'Алюминий', 'Пластик', 'Закаленное стекло'];
                return $materials[array_rand($materials)];
            case 'Толщина корпуса':
                return rand(0.5, 2) . ' мм';
            case 'Форм-фактор совместимых материнских плат':
                $compatibility = ['ATX', 'Micro ATX', 'Mini ITX'];
                return $compatibility[array_rand($compatibility)];
            case 'Форм-фактор совместимых блоков питания':
                $psuFormFactors = ['ATX', 'SFX', 'TFX'];
                return $psuFormFactors[array_rand($psuFormFactors)];
            case 'Размещение блока питания':
                $psuPositions = ['Внизу', 'Сверху'];
                return $psuPositions[array_rand($psuPositions)];
            case 'Максимальная высота видеокарты':
                return rand(300, 500) . ' мм';
            case 'Максимальная высота куллера процессора':
                return rand(150, 200) . ' мм';
            default:
                return 'Не задано';
        }
    }
    public function значенияБлоковПитания($attribute)
    {
        switch ($attribute->название) {
            case 'Цвет':
                $colors = ['Черный', 'Белый', 'Серебристый', 'Красный', 'Синий'];
                return $colors[array_rand($colors)];
            case 'Длина':
                return rand(120, 250) . ' мм';
            case 'Форм-фактор':
                $formFactors = ['ATX', 'SFX', 'TFX'];
                return $formFactors[array_rand($formFactors)];
            case 'Высота':
                return rand(50, 180) . ' мм';
            case 'Ширина':
                return rand(120, 200) . ' мм';
            case 'Вес':
                return rand(1, 3) . ' кг';
            case 'Оплетка проводов':
                return rand(0, 1) ? 'Есть' : 'Нет';
            case 'Мощность':
                return rand(300, 1500) . ' W';
            case 'Основной разъем питания':
                return '24-pin';
            case 'Разъемы для питания процессора':
                return rand(1, 2) . ' x 8-pin';
            case 'Разъемы для питания видеокарты':
                return rand(2, 6) . ' x 6/8-pin';
            case 'Количество разьемов 15-pin SATA':
                return rand(2, 8);
            case 'Количество разьемов 4-pin Molex':
                return rand(1, 4);
            case 'Длина основного кабеля':
                return rand(400, 600) . ' мм';
            case 'Длина кабеля питания процессора':
                return rand(400, 600) . ' мм';
            case 'Длина кабеля питания видеокарты':
                return rand(500, 800) . ' мм';
            default:
                return 'Не задано';
        }
    }
    public function значенияSSD($attribute)
    {
        switch ($attribute->название) {
            case 'Объем накопителя':
                return rand(120, 4000) . ' GB';
            case 'NVMe':
                return rand(0, 1) ? 'Да' : 'Нет';
            case 'Разьем подключения':
                $interfaces = ['SATA III', 'PCIe Gen 3.0', 'PCIe Gen 4.0', 'M.2'];
                return $interfaces[array_rand($interfaces)];
            case 'Максимальная скорость последовательного чтения':
                return rand(500, 7000) . ' MB/s';
            case 'Максимальная скорость последовательной записи':
                return rand(500, 5000) . ' MB/s';
            case 'Максимальный ресурс записи':
                return rand(100, 1000) . ' TBW';
            default:
                return 'Не задано';
        }
    }
    public function значенияHDD($attribute)
    {
        switch ($attribute->название) {
            case 'Объем накопителя':
                return rand(500, 10000) . ' GB';
            case 'Объем кэш-памяти':
                return rand(32, 256) . ' MB';
            case 'Скорость вращения шпинделя':
                return rand(5400, 15000) . ' RPM';
            case 'Интерфейс':
                $interfaces = ['SATA III', 'SAS', 'PCIe'];
                return $interfaces[array_rand($interfaces)];
            case 'Пропускная способность интерфейса':
                return rand(300, 6000) . ' MB/s';
            case 'Максимальная скорость передачи данных':
                return rand(100, 250) . ' MB/s';
            case 'Число циклов позиционирования-парковки':
                return rand(300000, 1000000);
            case 'Уровень шума во время работы':
                return rand(25, 50) . ' dB';
            default:
                return 'Не задано';
        }
    }
    public function значенияМониторов($attribute)
    {
        switch ($attribute->название) {
            case 'Цвет':
                $colors = ['Черный', 'Белый', 'Серый', 'Розовый', 'Синий'];
                return $colors[array_rand($colors)];
            case 'Длина':
                return rand(450, 1000) . ' мм';
            case 'Высота':
                return rand(250, 800) . ' мм';
            case 'Ширина':
                return rand(300, 800) . ' мм';
            case 'Подсветка':
                $backlighting = ['LED', 'OLED', 'LCD'];
                return $backlighting[array_rand($backlighting)];
            case 'Вес':
                return rand(2, 8) . ' кг';
            case 'Изогнутый экран':
                return rand(0, 1) ? 'Да' : 'Нет';
            case 'Диагональ экрана (дюйм)':
                return rand(21, 55) . ' дюймов';
            case 'Максимальное разрешение':
                $resolutions = ['1920x1080', '2560x1440', '3840x2160', '7680x4320', '4096x2160', '1440x900', '1280x800'];
                return $resolutions[array_rand($resolutions)];
            case 'Соотношение сторон':
                $aspectRatios = ['16:9', '21:9', '4:3', '16:10'];
                return $aspectRatios[array_rand($aspectRatios)];
            case 'Тип подсветки матрицы':
                $types = ['Edge LED', 'Direct LED', 'Mini LED'];
                return $types[array_rand($types)];
            case 'Технология изготовления матрицы':
                $technologies = ['IPS', 'TN', 'VA', 'OLED'];
                return $technologies[array_rand($technologies)];
            case 'Покрытие экрана':
                $screenCoatings = ['Глянец', 'Матовое'];
                return $screenCoatings[array_rand($screenCoatings)];
            case 'Поддержка HDR':
                return rand(0, 1) ? 'Да' : 'Нет';
            case 'Видеоразъемы':
                $videoPorts = ['HDMI', 'DisplayPort', 'VGA', 'USB-C'];
                return $videoPorts[array_rand($videoPorts)];
            case 'Глубина цвета':
                return rand(6, 12) . ' бит';
            case 'Плотность пикселей':
                return rand(90, 220) . ' ppi';
            case 'Максимальная частота обновления экрана':
                return rand(60, 120) . ' Гц';
            default:
                return 'Не задано';
        }
    }
}

