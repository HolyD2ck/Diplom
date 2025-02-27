<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<div class="bg-gray-50 min-h-screen">
    <!-- Основной контент -->
    <div class="content">
        <!-- Категории, поиск и баннер -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row items-center gap-6">
            <!-- Категории (Выпадающий список) -->
            <div x-data="{ open: false }" class="relative w-full md:w-48">
                <button @click="open = !open"
                    class="w-full px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 flex items-center justify-center text-sm sm:text-base">
                    Категории
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-2 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition
                    class="absolute left-0 w-full md:w-48 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-10 max-h-60 overflow-y-auto">
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <button wire:click="$set('selectedCategory', {{ $category->id }})"
                                    class="block w-full px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 text-sm transition duration-150">
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
                    class="w-full p-3 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base placeholder-gray-400 transition duration-200">
            </div>

            <!-- Рекламный баннер -->
            <div class="banner w-full md:w-auto"></div>
        </div>

        <!-- Категории -->
        <section
            class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-6 sm:py-8 lg:py-10 mt-8 bg-blue-100 rounded-2xl shadow-lg overflow-hidden">
            <h2 class="text-2xl sm:text-3xl font-semibold text-blue-900 mb-6">Категории товаров</h2>
            <div class="swiper-container-categories">
                <div class="swiper-wrapper">
                    <!-- Карточки категорий -->
                    <div class="swiper-slide">
                        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <img src="{{ asset('img/video.jpg') }}" alt="Видеокарты"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Видеокарты</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <img src="{{ asset('img/pro.jpg') }}" alt="Процессоры"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Процессоры</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <img src="{{ asset('img/mama.jpg') }}" alt="Материнские платы"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Материнские платы</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <img src="{{ asset('img/opera.jpg') }}" alt="Оперативная память"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Оперативная память</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <img src="{{ asset('img/case.jpg') }}" alt="Корпуса"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Корпуса</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <img src="{{ asset('img/pow.jpg') }}" alt="Блоки питания"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Блоки питания</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <img src="{{ asset('img/ssd.jpg') }}" alt="SSD"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">SSD</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <img src="{{ asset('img/hdd.jpg') }}" alt="HDD"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">HDD</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <img src="{{ asset('img/monic.jpg') }}" alt="Мониторы"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Мониторы</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Популярные товары -->
        <section wire:init="loadPopularProducts" wire:poll.10s
            class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-6 sm:py-8 lg:py-10 mt-8 bg-blue-100 rounded-2xl shadow-lg">
            <h2 class="text-2xl sm:text-3xl font-semibold text-blue-900 mb-6">Популярные товары</h2>

            <div class="swiper-container-products">
                <div class="swiper-wrapper">
                    @forelse ($popularProducts as $product)
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                <img src="{{ asset($product['основноеФото']['путь'] ?? 'images/default.jpg') }}"
                                    class="w-full h-40 object-contain rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800">
                                    {{ $product['название'] ?? 'Без названия' }}</h3>
                                <p class="text-blue-700 text-base font-medium mt-1">
                                    {{ $product['среднийРейтинг']['средний_рейтинг'] ?? 'Нет рейтинга' }}
                                </p>
                                <p class="text-blue-700 text-base font-medium mt-1">{{ $product['цена'] ?? 0 }} ₽</p>
                                <button
                                    class="mt-3 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200">
                                    В корзину
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center w-full py-6 text-gray-600">Загрузка популярных товаров...</div>
                    @endforelse
                </div>
            </div>
        </section>
        <section
            class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-6 sm:py-8 lg:py-10 mt-8 bg-blue-100 rounded-2xl shadow-lg overflow-hidden">
            <h2 class="text-2xl sm:text-3xl font-semibold text-blue-900 mb-6">Лучшие скидки</h2>
            <div class="swiper swiper-container-discounts">
                <div class="swiper-wrapper">
                    @php
                        $discountedProducts = [
                            ['name' => 'Игровая видеокарта', 'price' => '45,000 ₽', 'image' => 'gpu.jpg'],
                            ['name' => 'Процессор Ryzen', 'price' => '30,000 ₽', 'image' => 'cpu.jpg'],
                            ['name' => 'Материнская плата', 'price' => '15,000 ₽', 'image' => 'mobo.jpg'],
                            ['name' => 'SSD 1TB', 'price' => '8,000 ₽', 'image' => 'ssd.jpg'],
                        ];
                    @endphp

                    @foreach ($discountedProducts as $product)
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                <img src="{{ asset('img/' . $product['image']) }}" alt="{{ $product['name'] }}"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800">{{ $product['name'] }}</h3>
                                <p class="text-red-600 text-base font-medium mt-1">{{ $product['price'] }}</p>
                                <button
                                    class="mt-3 w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium transition duration-200">
                                    В корзину
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section
            class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-6 sm:py-8 lg:py-10 mt-8 bg-blue-100 rounded-2xl shadow-lg overflow-hidden">
            <h2 class="text-2xl sm:text-3xl font-semibold text-blue-900 mb-6">Лучшие отзывы</h2>
            <div class="swiper swiper-container-top-reviews">
                <div class="swiper-wrapper">
                    @php
                        $topReviewedProducts = [
                            ['name' => 'Монитор 144Гц', 'price' => '20,000 ₽', 'image' => 'monitor.jpg'],
                            ['name' => 'Игровая мышь', 'price' => '5,000 ₽', 'image' => 'mouse.jpg'],
                            ['name' => 'Механическая клавиатура', 'price' => '10,000 ₽', 'image' => 'keyboard.jpg'],
                            ['name' => 'Гарнитура', 'price' => '7,500 ₽', 'image' => 'headset.jpg'],
                        ];
                    @endphp

                    @foreach ($topReviewedProducts as $product)
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                <img src="{{ asset('img/' . $product['image']) }}" alt="{{ $product['name'] }}"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800">{{ $product['name'] }}</h3>
                                <p class="text-blue-700 text-base font-medium mt-1">{{ $product['price'] }}</p>
                                <button
                                    class="mt-3 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200">
                                    В корзину
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <script>
        var swiperProducts = new Swiper('.swiper-container-products', {
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination-products',
                clickable: true,
                type: 'none',
            },
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
        var swiperCategories = new Swiper('.swiper-container-categories', {
            slidesPerView: 2,
            spaceBetween: 15,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                type: 'none',
            },
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
        });
    </script>

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
            /* Отступ для фиксированной навигации */
        }

        .banner {
            width: 100%;
            background-image: url('https://img.freepik.com/free-vector/electronics-store-template-design_23-2151143831.jpg?t=st=1740478237~exp=1740481837~hmac=cd32724304b7e7374a449bb3a477462dc51227c4a667073dc2783d8700601cf5&w=900');
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 640px) {
            .banner {
                height: 150px;
            }
        }

        @media (min-width: 641px) and (max-width: 767px) {
            .banner {
                height: 200px;
            }
        }

        @media (min-width: 768px) {
            .banner {
                width: calc(100% - 400px);
                height: 120px;
                /* Чуть увеличил для десктопов */
            }
        }

        .swiper-container-products {
            position: relative;
            overflow: hidden;
            padding-bottom: 20px;
        }

        .swiper-wrapper {
            display: flex;
        }

        .swiper-slide {
            width: 100%;
        }
    </style>
</div>
