@extends('layouts.app')

@section('content')
    <style>
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
        }

        .content {
            padding-top: 60px;
            /* Оставляем отступ для фиксированной навигации */
        }

        /* Баннер с адаптивной высотой */
        .banner {
            width: 100%;
            background-image: url('https://img.freepik.com/free-vector/electronics-store-template-design_23-2151143831.jpg?t=st=1740478237~exp=1740481837~hmac=cd32724304b7e7374a449bb3a477462dc51227c4a667073dc2783d8700601cf5&w=900');
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Медиа-запросы для адаптивности */
        @media (max-width: 640px) {
            .banner {
                height: 150px;
                /* Уменьшаем высоту на телефонах */
            }
        }

        @media (min-width: 641px) and (max-width: 767px) {
            .banner {
                height: 200px;
                /* Средний размер для планшетов */
            }
        }

        @media (min-width: 768px) {
            .banner {
                width: calc(100% - 400px);
                /* Оригинальная ширина для десктопов */
                height: 100px;
                /* Оригинальная высота */
            }
        }
    </style>

    <div class="bg-gray-100 min-h-screen">
        <!-- Основной контент -->
        <div class="content">
            <!-- Категории, поиск и баннер -->
            <div
                class="flex flex-col md:flex-row justify-center mb-6 space-y-4 md:space-y-0 md:space-x-4 px-4 py-6 sm:px-6 lg:px-8">
                <!-- Категории (Выпадающий список) -->
                <div x-data="{ open: false }" class="relative flex-shrink-0 w-full md:w-48">
                    <button @click="open = ! open"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center text-sm sm:text-base">
                        Категории
                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-2 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Выпадающий список категорий -->
                    <div x-show="open" x-transition
                        class="absolute left-0 w-full md:w-48 mt-2 bg-white border rounded-lg shadow-lg z-10 max-h-60 overflow-y-auto">
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <button wire:click="$set('selectedCategory', {{ $category->id }})"
                                        class="block w-full px-4 py-2 text-gray-700 hover:bg-blue-100 text-sm">
                                        {{ $category->название }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Поиск товаров -->
                <div class="flex-1 w-full">
                    <input type="text" wire:model="search" placeholder="Поиск товаров..."
                        class="border p-2 w-full rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                </div>

                <!-- Рекламный баннер -->
                <div class="banner w-full md:flex-shrink-0"></div>
            </div>

            <!-- Сетка товаров -->
            <section class="bg-white p-4 sm:p-6 rounded-lg shadow-lg mx-4 sm:mx-6 lg:mx-8 mt-4">
                <h2 class="text-xl sm:text-2xl font-semibold mb-4">Популярные товары</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <!-- Товары -->
                    <div class="bg-gray-200 p-4 rounded-lg shadow-md">
                        <img src="https://via.placeholder.com/150" alt="Товар 1"
                            class="w-full h-32 sm:h-40 object-cover rounded-t-lg">
                        <h3 class="mt-2 text-base sm:text-lg font-semibold">Товар 1</h3>
                        <p class="text-gray-600 text-sm sm:text-base">15,000 ₽</p>
                        <button
                            class="mt-2 px-3 py-1 sm:px-4 sm:py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm sm:text-base w-full">В
                            корзину</button>
                    </div>
                    <div class="bg-gray-200 p-4 rounded-lg shadow-md">
                        <img src="https://via.placeholder.com/150" alt="Товар 2"
                            class="w-full h-32 sm:h-40 object-cover rounded-t-lg">
                        <h3 class="mt-2 text-base sm:text-lg font-semibold">Товар 2</h3>
                        <p class="text-gray-600 text-sm sm:text-base">18,500 ₽</p>
                        <button
                            class="mt-2 px-3 py-1 sm:px-4 sm:py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm sm:text-base w-full">В
                            корзину</button>
                    </div>
                    <div class="bg-gray-200 p-4 rounded-lg shadow-md">
                        <img src="https://via.placeholder.com/150" alt="Товар 3"
                            class="w-full h-32 sm:h-40 object-cover rounded-t-lg">
                        <h3 class="mt-2 text-base sm:text-lg font-semibold">Товар 3</h3>
                        <p class="text-gray-600 text-sm sm:text-base">22,000 ₽</p>
                        <button
                            class="mt-2 px-3 py-1 sm:px-4 sm:py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm sm:text-base w-full">В
                            корзину</button>
                    </div>
                    <div class="bg-gray-200 p-4 rounded-lg shadow-md">
                        <img src="https://via.placeholder.com/150" alt="Товар 4"
                            class="w-full h-32 sm:h-40 object-cover rounded-t-lg">
                        <h3 class="mt-2 text-base sm:text-lg font-semibold">Товар 4</h3>
                        <p class="text-gray-600 text-sm sm:text-base">28,000 ₽</p>
                        <button
                            class="mt-2 px-3 py-1 sm:px-4 sm:py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm sm:text-base w-full">В
                            корзину</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
