<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Supplier;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
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

    public function definition(): array
    {
        $categoryId = Category::inRandomOrder()->value('id');
        $supplierId = Supplier::inRandomOrder()->value('id');
        return [
            'категория_id' => $categoryId,
            'поставщик_id' => $supplierId,
            'название' => $this->ГенераторИмен($categoryId),
            'описание' => $this->faker->text(),
            'производитель' => $this->ГенераторПроизводителей($categoryId),
            'цена' => $this->faker->randomFloat(2, 10000, 100000),
            'скидка' => $this->faker->numberBetween(0, 90),
            'дата_выпуска' => $this->faker->dateTimeBetween('-10 years', '-1 year')->format('Y-m-d'),
            'дата_поступления_в_продажу' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }
    public function templates()
    {
        return [
            'Видеокарты' => ['GeForce RTX', 'Radeon RX', 'GTX', 'Quadro'],
            'Процессоры' => ['Intel Core i7', 'AMD Ryzen', 'Xeon', 'Pentium'],
            'Материнские платы' => ['ASUS ROG', 'MSI Gaming', 'Gigabyte Ultra', 'ASRock Phantom'],
            'Оперативная память' => ['Kingston HyperX', 'Corsair Vengeance', 'G.Skill Ripjaws', 'Crucial Ballistix'],
            'Корпуса' => ['Cooler Master', 'NZXT H510', 'Thermaltake View', 'Fractal Design'],
            'Блоки питания' => ['Corsair RM', 'Seasonic Focus', 'Cooler Master V', 'EVGA SuperNova'],
            'SSD' => ['Samsung Evo', 'Crucial MX', 'WD Blue', 'Kingston A'],
            'HDD' => ['Seagate Barracuda', 'WD Black', 'Toshiba X300', 'Hitachi Ultrastar'],
            'Мониторы' => ['Dell Ultrasharp', 'ASUS TUF Gaming', 'LG UltraGear', 'Samsung Odyssey'],
        ];
    }
    public function ГенераторИмен($categoryId)
    {
        $categoryName = Category::where('id', $categoryId)->value('название');

        $nameTemplates = $this->templates()[$categoryName];
        $randomSuffix = rand(2000, 9999);
        $randomName = $nameTemplates[array_rand($nameTemplates)] . ' ' . $randomSuffix;

        return $randomName;
    }
    public function ГенераторПроизводителей($categoryId)
    {
        $categoryName = Category::where('id', $categoryId)->value('название');

        $nameTemplates = $this->templates()[$categoryName];
        $randomName = $nameTemplates[array_rand($nameTemplates)];

        return $randomName;
    }
}
