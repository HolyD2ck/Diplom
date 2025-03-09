<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class Route_Test extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест для главной страницы.
     *
     * @return void
     */
    public function test_dashboard_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.index');

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.index');
    }

    /**
     * Тест для страницы профиля.
     *
     * @return void
     */
    public function test_profile_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/profile');
        $response->assertStatus(302); // Проверяем, что происходит редирект на страницу входа

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('profile'); // Проверяем, что используется правильное представление
    }

    /**
     * Тест для страницы контактов.
     *
     * @return void
     */
    public function test_contacts_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/contacts');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.contacts');

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/contacts');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.contacts');
    }

    /**
     * Тест для страницы "О нас".
     *
     * @return void
     */
    public function test_about_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/about');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.about');

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/about');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.about');
    }

    /**
     * Тест для страницы сотрудников.
     *
     * @return void
     */
    public function test_workers_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/workers');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.workers');

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/workers');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.workers');
    }

    /**
     * Тест для страницы партнеров.
     *
     * @return void
     */
    public function test_partners_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/partners');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.partners');

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/partners');
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.partners');
    }

    /**
     * Тест для страницы категории.
     *
     * @return void
     */
    public function test_category_route()
    {
        $categoryId = 1; // Пример ID категории

        // Проверка для неаутентифицированного пользователя
        $response = $this->get("/category/{$categoryId}");
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.category'); // Проверяем, что используется правильное представление
        $response->assertViewHas('categoryId', $categoryId); // Проверяем, что данные передаются в представление

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get("/category/{$categoryId}");
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.category'); // Проверяем, что используется правильное представление
        $response->assertViewHas('categoryId', $categoryId); // Проверяем, что данные передаются в представление
    }

    /**
     * Тест для страницы товара.
     *
     * @return void
     */

    /**
     * Тест для маршрута корзины.
     *
     * @return void
     */
    public function test_cart_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/cart');
        $response->assertStatus(200); // Проверяем, что страница загружается

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/cart');
        $response->assertStatus(200); // Проверяем, что страница загружается
    }

    /**
     * Тест для добавления товара в корзину.
     *
     * @return void
     */

    /**
     * Тест для очистки корзины.
     *
     * @return void
     */
    public function test_clear_cart_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->post('/cart/clear');
        $response->assertStatus(302); // Проверяем, что происходит редирект

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/cart/clear');
        $response->assertStatus(302); // Проверяем, что происходит редирект
    }

    /**
     * Тест для получения лучших товаров (API).
     *
     * @return void
     */
    public function test_best_products_api_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/best-products');
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/best-products');
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ
    }

    /**
     * Тест для получения товаров со скидкой (API).
     *
     * @return void
     */
    public function test_discount_products_api_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/discount-products');
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/discount-products');
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ
    }

    /**
     * Тест для получения случайных товаров (API).
     *
     * @return void
     */
    public function test_random_products_api_route()
    {
        // Проверка для неаутентифицированного пользователя
        $response = $this->get('/random-products');
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/random-products');
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ
    }

    /**
     * Тест для получения товаров по категории (API).
     *
     * @return void
     */
    public function test_shop_products_api_route()
    {
        $categoryId = 1; // Пример ID категории

        // Проверка для неаутентифицированного пользователя
        $response = $this->get("/shop-products/{$categoryId}");
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get("/shop-products/{$categoryId}");
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ
    }

    /**
     * Тест для получения информации о товаре (API).
     *
     * @return void
     */
    public function test_product_info_api_route()
    {
        $categoryId = Category::create(
            [
                'название' => 'Видеокарты',
            ]
        )->id;
        $productId = Product::factory()->create([
            'название' => 'test',
            'категория_id' => $categoryId
        ])->id;

        // Проверка для неаутентифицированного пользователя
        $response = $this->get("/product/{$productId}");
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get("/product/{$productId}");
        $response->assertStatus(200); // Проверяем, что API возвращает успешный ответ
    }
    public function test_show_route()
    {
        $categoryId = Category::create(
            [
                'название' => 'Видеокарты',
            ]
        )->id;
        $productId = Product::factory()->create([
            'название' => 'test',
            'категория_id' => $categoryId
        ])->id;

        // Проверка для неаутентифицированного пользователя
        $response = $this->get("/show/{$productId}");
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.show'); // Проверяем, что используется правильное представление
        $response->assertViewHas('productId', $productId); // Проверяем, что данные передаются в представление

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get("/show/{$productId}");
        $response->assertStatus(200); // Проверяем, что страница загружается
        $response->assertViewIs('shop.show'); // Проверяем, что используется правильное представление
        $response->assertViewHas('productId', $productId); // Проверяем, что данные передаются в представление
    }
    public function test_add_to_cart_route()
    {
        $categoryId = Category::create(
            [
                'название' => 'Видеокарты',
            ]
        )->id;
        $productId = Product::factory()->create([
            'название' => 'test',
            'категория_id' => $categoryId
        ])->id;

        // Проверка для неаутентифицированного пользователя
        $response = $this->post('/cart/add', [
            'product_id' => $productId,
        ]);
        $response->assertStatus(302); // Проверяем, что происходит редирект

        // Проверка для аутентифицированного пользователя
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/cart/add', [
            'product_id' => $productId,

        ]);
        $response->assertStatus(302); // Проверяем, что происходит редирект
    }

}