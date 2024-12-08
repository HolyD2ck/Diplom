<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Таблица категорий
        Schema::create('категории', function (Blueprint $table) {
            $table->id();
            $table->string('название', 255)->unique();
            $table->timestamps();
        });

        // Таблица атрибутов
        Schema::create('атрибуты', function (Blueprint $table) {
            $table->id();
            $table->string('название', 255)->unique();
            $table->enum('тип_данных', ['строка', 'число', 'булево', 'дата', 'десятичное'])
                ->default('строка')
                ->comment('Тип данных атрибута');
            $table->timestamps();
        });

        // Таблица связи категории и атрибутов
        Schema::create('категория_атрибуты', function (Blueprint $table) {
            $table->foreignId('категория_id')->constrained('категории')->onDelete('cascade');
            $table->foreignId('атрибут_id')->constrained('атрибуты')->onDelete('cascade');
            $table->primary(['категория_id', 'атрибут_id']);
        });

        // Таблица товаров
        Schema::create('товары', function (Blueprint $table) {
            $table->id();
            $table->foreignId('категория_id')->nullable()->constrained('категории')->onDelete('set null');
            $table->string('название', 255);
            $table->text('описание')->nullable();
            $table->string('производитель', 100)->nullable();
            $table->integer('скидка')->nullable();
            $table->decimal('цена', 12, 2)->nullable();
            $table->date('дата_выпуска')->nullable();
            $table->date('дата_поступления_в_продажу')->nullable();
            $table->timestamps();
        });

        // Таблица фотографий
        Schema::create('фотографии', function (Blueprint $table) {
            $table->id();
            $table->foreignId('товар_id')->constrained('товары')->onDelete('cascade');
            $table->string('путь', 255);
            $table->boolean('основное')->default(false);
            $table->timestamps();
        });

        // Таблица значений атрибутов
        Schema::create('значения_атрибутов', function (Blueprint $table) {
            $table->id();
            $table->foreignId('товар_id')->constrained('товары')->onDelete('cascade');
            $table->foreignId('атрибут_id')->constrained('атрибуты')->onDelete('cascade');
            $table->string('значение', 255)->nullable();
            $table->timestamps();
        });

        // Таблица адресов
        Schema::create('адреса', function (Blueprint $table) {
            $table->id();
            $table->string('улица', 255);
            $table->string('город', 255);
            $table->string('область', 255);
            $table->string('почтовый_индекс', 20);
            $table->string('страна', 255);
            $table->timestamps();
        });

        // Таблица заказов
        Schema::create('заказы', function (Blueprint $table) {
            $table->id();
            $table->foreignId('пользователь_id')->constrained('users')->onDelete('cascade');
            $table->decimal('итоговая_цена', 12, 2);
            $table->enum('статус', ['Оплачено', 'В обработке', 'Доставлено', 'Отменено'])->default('Оплачено');
            $table->foreignId('адрес_доставки_id')->constrained('адреса')->onDelete('cascade');
            $table->timestamps();
        });

        // Таблица деталей заказа
        Schema::create('детали_заказов', function (Blueprint $table) {
            $table->id();
            $table->foreignId('заказ_id')->constrained('заказы')->onDelete('cascade');
            $table->foreignId('товар_id')->constrained('товары')->onDelete('cascade');
            $table->integer('количество');
            $table->decimal('цена', 12, 2);
            $table->timestamps();
        });

        // Таблица отзывов
        Schema::create('отзывы', function (Blueprint $table) {
            $table->id();
            $table->foreignId('товар_id')->constrained('товары')->onDelete('cascade');
            $table->foreignId('пользователь_id')->constrained('users')->onDelete('cascade'); // предполагается, что у вас есть таблица users
            $table->text('отзыв');
            $table->integer('рейтинг')->nullable()->default(5)->comment('Рейтинг от 1 до 5');
            $table->timestamps();
        });

        // Таблица для хранения среднего рейтинга товара
        Schema::create('рейтинг_товаров', function (Blueprint $table) {
            $table->id();
            $table->foreignId('товар_id')->constrained('товары')->onDelete('cascade');
            $table->decimal('средний_рейтинг', 3, 2)->default(0)->comment('Средний рейтинг товара');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('рейтинг_товаров');
        Schema::dropIfExists('отзывы');
        Schema::dropIfExists('детали_заказов');
        Schema::dropIfExists('заказы');
        Schema::dropIfExists('адреса');
        Schema::dropIfExists('значения_атрибутов');
        Schema::dropIfExists('фотографии');
        Schema::dropIfExists('товары');
        Schema::dropIfExists('категория_атрибуты');
        Schema::dropIfExists('атрибуты');
        Schema::dropIfExists('категории');
    }
};
