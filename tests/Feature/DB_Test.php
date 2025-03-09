<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Address;
use App\Models\Order;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Employee;
use App\Models\OrderDetail;
use App\Models\Photo;
use App\Models\Product;
use App\Models\ProductRaiting;
use App\Models\Review;
use App\Models\SiteReviews;
use App\Models\Supplier;
use App\Models\User;
use Tests\TestCase;

class DB_Test extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_can_create_an_address(): void
    {
        // Создаем адрес с помощью фабрики
        $address = Address::factory()->create([
            'город' => 'Москва',
            'улица' => 'Ленина',
        ]);

        // Проверяем, что адрес был успешно добавлен в базу данных
        $this->assertDatabaseHas('адреса', [
            'город' => 'Москва',
            'улица' => 'Ленина',
        ]);
    }
    public function test_it_can_create_a_category(): void
    {
        // Создаем категорию с помощью фабрики
        $category = Category::factory()->create(['название' => 'Процессоры']);

        // Проверяем, что категория была успешно добавлена в базу данных
        $this->assertDatabaseHas('категории', [
            'название' => 'Процессоры',
        ]);
    }
    public function test_it_can_create_an_attribute(): void
    {
        // Создаем атрибут с помощью фабрики
        $attribute = Attribute::factory()->create(['название' => 'Цвет']);

        // Проверяем, что атрибут был успешно добавлен в базу данных
        $this->assertDatabaseHas('атрибуты', [
            'название' => 'Цвет',
        ]);
    }

    public function test_attribute_belongs_to_categories(): void
    {
        // Создаем атрибут и категорию
        $attribute = Attribute::factory()->create(['название' => 'Цвет']);
        $category = Category::factory()->create(['название' => 'Корпуса']);

        // Связываем атрибут с категорией
        $attribute->категории()->attach($category);

        // Проверяем, что атрибут действительно связан с категорией
        $this->assertTrue($attribute->категории->contains($category));
    }
    public function test_it_can_create_an_employee(): void
    {
        // Создаем сотрудника с помощью фабрики
        $employee = Employee::factory()->create([
            'имя' => 'Иван',
            'фамилия' => 'Иванов',
        ]);

        // Проверяем, что сотрудник был успешно добавлен в базу данных
        $this->assertDatabaseHas('сотрудники', [
            'имя' => 'Иван',
            'фамилия' => 'Иванов',
        ]);
    }
    public function test_it_can_create_a_supplier(): void
    {
        // Создаем поставщика с помощью фабрики
        $supplier = Supplier::factory()->create(['название_компании' => 'ООО Ромашка']);

        // Проверяем, что поставщик был успешно добавлен в базу данных
        $this->assertDatabaseHas('поставщики', [
            'название_компании' => 'ООО Ромашка',
        ]);
    }
    public function test_it_can_create_a_site_review(): void
    {
        // Создаем отзыв сайта с помощью фабрики
        $review = SiteReviews::factory()->create([
            'имя_клиента' => 'Иван Иванов',
            'email' => 'ivan@example.com',
            'отзыв' => 'Отличный сайт!',
        ]);

        // Проверяем, что отзыв был успешно добавлен в базу данных
        $this->assertDatabaseHas('отзывы_сайта', [
            'имя_клиента' => 'Иван Иванов',
            'email' => 'ivan@example.com',
            'отзыв' => 'Отличный сайт!',
        ]);
    }
    public function test_product_creation_with_relations(): void
    {
        // Создаем категорию
        $category = Category::factory()->create([
            'название' => 'Видеокарты',
        ]);
        $supplier = Supplier::factory()->create([
            'название_компании' => 'ООО Ромашка',
        ]);
        // Создаем товар и привязываем его к категории и к поставщику
        $product = Product::factory()->create([
            'название' => 'RTX 3060',
            'категория_id' => $category->id,
            'поставщик_id' => $supplier->id,
        ]);

        // Проверяем, что товар создан и привязан к категории и к поставщику
        $this->assertDatabaseHas('товары', [
            'название' => 'RTX 3060',
            'категория_id' => $category->id,
            'поставщик_id' => $supplier->id,
        ]);
        $this->assertEquals($category->id, $product->категория->id);

        // Создаем атрибут и привязываем его к товару через значение атрибута
        $attribute = Attribute::factory()->create([
            'название' => 'Цвет',
        ]);
        $attributeValue = AttributeValue::factory()->create([
            'товар_id' => $product->id,
            'атрибут_id' => $attribute->id,
            'значение' => 'Черный',
        ]);

        // Проверяем, что атрибут и его значение созданы и привязаны к товару
        $this->assertDatabaseHas('значения_атрибутов', [
            'товар_id' => $product->id,
            'атрибут_id' => $attribute->id,
            'значение' => 'Черный',
        ]);
        $this->assertTrue($product->значенияАтрибутов->contains($attributeValue));
        $this->assertEquals('Черный', $product->значенияАтрибутов->first()->значение);

        // Создаем отзывы для товара
        $user = User::factory()->create();
        $review1 = Review::factory()->create([
            'пользователь_id' => $user->id,
            'товар_id' => $product->id,
            'рейтинг' => 5,
            'отзыв' => 'Отличный товар!',
        ]);
        $review2 = Review::factory()->create([
            'пользователь_id' => $user->id,
            'товар_id' => $product->id,
            'рейтинг' => 4,
            'отзыв' => 'Хороший товар, но дорогой.',
        ]);

        // Проверяем, что отзывы созданы и привязаны к товару
        $this->assertDatabaseHas('отзывы', [
            'товар_id' => $product->id,
            'рейтинг' => 5,
            'отзыв' => 'Отличный товар!',
        ]);
        $this->assertDatabaseHas('отзывы', [
            'товар_id' => $product->id,
            'рейтинг' => 4,
            'отзыв' => 'Хороший товар, но дорогой.',
        ]);
        $this->assertTrue($product->отзывы->contains($review1));
        $this->assertTrue($product->отзывы->contains($review2));

        // Проверяем средний рейтинг товара
        $this->assertEquals(4.5, $product->среднийРейтинг->средний_рейтинг);
    }
    public function test_order_creation_with_details(): void
    {
        // Создаем пользователя
        $user = User::factory()->create([
            'name' => 'Иван Иванов',
            'email' => 'ivan@example.com',
        ]);

        // Создаем адрес доставки
        $address = Address::factory()->create([
            'город' => 'Москва',
            'улица' => 'Ленина',
        ]);

        // Создаем категории
        $category1 = Category::factory()->create([
            'название' => 'Видеокарты',
        ]);
        $category2 = Category::factory()->create([
            'название' => 'Процессоры',
        ]);

        // Создаем заказ и привязываем его к пользователю и адресу
        $order = Order::factory()->create([
            'пользователь_id' => $user->id,
            'адрес_доставки_id' => $address->id,
            'итоговая_цена' => 0, // Начальная цена заказа
        ]);

        // Проверяем, что заказ создан и привязан к пользователю и адресу
        $this->assertDatabaseHas('заказы', [
            'пользователь_id' => $user->id,
            'адрес_доставки_id' => $address->id,
        ]);
        $this->assertEquals($user->id, $order->пользователь->id);
        $this->assertEquals($address->id, $order->адрес->id);

        // Создаем товары
        $product1 = Product::factory()->create([
            'название' => 'RTX 3060',
            'скидка' => 0,
            'категория_id' => $category1->id,
            'цена' => 60000,
        ]);
        $product2 = Product::factory()->create([
            'название' => 'i5 12400f',
            'скидка' => 0,
            'категория_id' => $category2->id,
            'цена' => 12000,
        ]);

        // Создаем детали заказа (товары в заказе)
        $orderDetail1 = OrderDetail::create([
            'заказ_id' => $order->id,
            'товар_id' => $product1->id,
            'количество' => 1,
            'цена' => 60000, // Цена за единицу товара
        ]);
        $orderDetail2 = OrderDetail::create([
            'заказ_id' => $order->id,
            'товар_id' => $product2->id,
            'количество' => 2,
            'цена' => 24000, // Цена за все товары
        ]);

        // Проверяем, что детали заказа созданы и привязаны к заказу
        $this->assertDatabaseHas('детали_заказов', [
            'заказ_id' => $order->id,
            'товар_id' => $product1->id,
            'количество' => 1,
            'цена' => 60000,
        ]);
        $this->assertDatabaseHas('детали_заказов', [
            'заказ_id' => $order->id,
            'товар_id' => $product2->id,
            'количество' => 2,
            'цена' => 24000,
        ]);
        $this->assertTrue($order->деталиЗаказа->contains($orderDetail1));
        $this->assertTrue($order->деталиЗаказа->contains($orderDetail2));

        // Пересчитываем итоговую цену заказа
        $order->пересчитатьИтоговуюЦену();

        // Проверяем, что итоговая цена заказа рассчитана правильно
        $this->assertEquals(84000, $order->итоговая_цена);
    }
}
