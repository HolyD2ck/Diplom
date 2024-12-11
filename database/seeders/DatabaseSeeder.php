<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Address;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Address::factory(10)->create();
        $attributeFactory = new \Database\Factories\AttributeFactory;
        $attributeFactory->АтрибутыВидеокарты();
        // Product::factory(10)->create();
    }
}
