<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Таблица категорий
        Schema::create('Категории', function (Blueprint $table) {
            $table->id();
            $table->string('Название', 255);
        });

        // Таблица товаров
        Schema::create('Товары', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Категория')->constrained('Категории')->onDelete('cascade');
            $table->string('Название', 255);
            $table->text('Описание');
            $table->string('Производитель', 100);
            $table->decimal('Цена', 10, 2);
            $table->date('Дата_выпуска');
            $table->date('Дата_поступления_в_продажу');
        });

        // Таблица фотографий
        Schema::create('Фотографии', function (Blueprint $table) {
            $table->id();
            $table->string('Фото', 255);
        });

        // Промежуточная таблица для связи товаров и фотографий (многие ко многим)
        Schema::create('Товар_Фотографии', function (Blueprint $table) {
            $table->foreignId('tovar_id')->constrained('Товары')->onDelete('cascade');
            $table->foreignId('photo_id')->constrained('Фотографии')->onDelete('cascade');
            $table->primary(['tovar_id', 'photo_id']);
        });

        // Таблица параметров
        Schema::create('Параметры', function (Blueprint $table) {
            $table->id();
            $table->string('Название', 100);
        });

        // Таблица значений параметров для товаров
        Schema::create('Значения', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tovar_id')->constrained('Товары')->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('Параметры')->onDelete('cascade');
            $table->string('Значение', 255);
        });

        // Таблица адресов
        Schema::create('Адреса', function (Blueprint $table) {
            $table->id();
            $table->string('Улица', 100);
            $table->string('Город', 100);
            $table->string('Область', 100);
            $table->string('Почтовый_Индекс', 20);
            $table->string('Страна', 100);
        });

        // Таблица заказов
        Schema::create('Заказы', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('Пользователи')->onDelete('cascade'); // предполагая, что таблица 'Пользователи' уже создана
            $table->decimal('Итоговая_цена', 10, 2);
            $table->enum('Статус', ['Оплачено', 'В обработке', 'Доставлено', 'Отменено'])->default('Оплачено');
            $table->foreignId('Адрес_Доставки')->nullable()->constrained('Адреса')->onDelete('set null');
        });

        // Таблица деталей заказа
        Schema::create('Детали_Заказа', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('Заказы')->onDelete('cascade');
            $table->foreignId('tovar_id')->constrained('Товары')->onDelete('cascade');
            $table->integer('Количество');
            $table->decimal('Цена', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Детали_Заказа');
        Schema::dropIfExists('Заказы');
        Schema::dropIfExists('Адреса');
        Schema::dropIfExists('Значения');
        Schema::dropIfExists('Параметры');
        Schema::dropIfExists('Товар_Фотографии');
        Schema::dropIfExists('Фотографии');
        Schema::dropIfExists('Товары');
        Schema::dropIfExists('Категории');
    }
};
