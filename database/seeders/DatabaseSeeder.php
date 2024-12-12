<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Product;
use App\Models\Address;
use App\Models\Category;
use App\Models\Attribute;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Создание адресов
        if (Address::count() < 10) {
            Address::factory(10)->create();
        }

        //Создание атрибутов
        $attributeFactory = new \Database\Factories\AttributeFactory;

        //атрибуты видеокарт
        $videcard = Category::where('название', 'Видеокарты')->first();

        if ($videcard && !$videcard->аттрибуты()->exists()) {
            $attributeFactory->АтрибутыВидеокарты();
        }
        //атрибуты процессоров
        $processor = Category::where('название', 'Процессоры')->first();
        if ($processor && !$processor->аттрибуты()->exists()) {
            $attributeFactory->АтрибутыПроцессоры();
        }
        //атрибуты материнских плат
        $motherboard = Category::where('название', 'Материнские платы')->first();
        if ($motherboard && !$motherboard->аттрибуты()->exists()) {
            $attributeFactory->АтрибутыМатеринскиеПлаты();
        }
        //атрибуты оперативной памяти
        $ram = Category::where('название', 'Оперативная память')->first();
        if ($ram && !$ram->аттрибуты()->exists()) {
            $attributeFactory->АтрибутыОперативнаяПамять();
        }
        //атрибуты корпусов
        $case = Category::where('название', 'Корпуса')->first();
        if ($case && !$case->аттрибуты()->exists()) {
            $attributeFactory->АтрибутыКорпуса();
        }
        //атрибуты блоков питания
        $power = Category::where('название', 'Блоки питания')->first();
        if ($power && !$power->аттрибуты()->exists()) {
            $attributeFactory->АтрибутыБлокиПитания();
        }
        //атрибуты SSD
        $ssd = Category::where('название', 'SSD')->first();
        if ($ssd && !$ssd->аттрибуты()->exists()) {
            $attributeFactory->АтрибутыSSD();
        }
        //атрибуты HDD
        $hdd = Category::where('название', 'HDD')->first();
        if ($hdd && !$hdd->аттрибуты()->exists()) {
            $attributeFactory->АтрибутыHDD();
        }
        //атрибуты мониторов
        $monitors = Category::where('название', 'Мониторы')->first();
        if ($monitors && !$monitors->аттрибуты()->exists()) {
            $attributeFactory->АтрибутыМониторы();
        }
        //связи атрибутов
        $attributeFactory->Связи();

        //Создание работников
        if (Employee::count() < 40) {
            Employee::factory(10)->create();
        }

        //Создание поставщиков
        if (Supplier::count() < 10) {
            Supplier::factory(10)->create();
        }

        //Создание пользователей
        if (User::count() < 10) {
            User::factory(10)->create();
        }
        //Создание товаров
        if (Product::count() < 300) {
            Product::factory(1)->create();
        }
        //Создание фотографий
        $photoFactory = new \Database\Factories\PhotoFactory;

    }
}
