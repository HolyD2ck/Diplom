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
                                <a href="{{ route('category', [$category->id]) }}">
                                    <button
                                        wire:click="$set('selectedCategory',
                                {{ $category->id }})"
                                        class="block w-full px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 text-sm transition duration-150">
                                        {{ $category->название }}
                                    </button>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Поиск товаров -->
            <livewire:shop-search>

                <!-- Рекламный баннер -->
                <div class="banner w-full md:w-auto"></div>
        </div>

        <!-- Категории -->
        <section
            class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-6 sm:py-8 lg:py-10 mt-8 bg-orange-100 rounded-2xl shadow-lg overflow-hidden">
            <h2 class="text-2xl sm:text-3xl font-semibold text-orange-900 mb-6">Категории товаров</h2>
            <div class="swiper-container-categories">
                <div class="swiper-wrapper">
                    <!-- Карточки категорий -->
                    <div class="swiper-slide">
                        <a href="{{ route('category', ['categoryId' => 11]) }}">
                            <div
                                class="bg-orange-200 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                                <img src="{{ asset('img/video.jpg') }}" alt="Видеокарты"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Видеокарты</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{ route('category', ['categoryId' => 12]) }}">
                            <div
                                class="bg-orange-200 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                                <img src="{{ asset('img/pro.jpg') }}" alt="Процессоры"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Процессоры</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{ route('category', ['categoryId' => 13]) }}">
                            <div
                                class="bg-orange-200 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                                <img src="{{ asset('img/mama.jpg') }}" alt="Материнские платы"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Материнские платы</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{ route('category', ['categoryId' => 14]) }}">
                            <div
                                class="bg-orange-200 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                                <img src="{{ asset('img/opera.jpg') }}" alt="Оперативная память"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Оперативная память</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{ route('category', ['categoryId' => 15]) }}">
                            <div
                                class="bg-orange-200 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                                <img src="{{ asset('img/case.jpg') }}" alt="Корпуса"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Корпуса</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{ route('category', ['categoryId' => 16]) }}">
                            <div
                                class="bg-orange-200 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                                <img src="{{ asset('img/pow.jpg') }}" alt="Блоки питания"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Блоки питания</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{ route('category', ['categoryId' => 17]) }}">
                            <div
                                class="bg-orange-200 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                                <img src="{{ asset('img/ssd.jpg') }}" alt="SSD"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">SSD</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{ route('category', ['categoryId' => 18]) }}">
                            <div
                                class="bg-orange-200 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                                <img src="{{ asset('img/hdd.jpg') }}" alt="HDD"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">HDD</h3>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{ route('category', ['categoryId' => 19]) }}">
                            <div
                                class="bg-orange-200 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                                <img src="{{ asset('img/monic.jpg') }}" alt="Мониторы"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <h3 class="mt-3 text-lg font-semibold text-gray-800 text-center">Мониторы</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Популярные товары -->
        <section
            class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-6 sm:py-8 lg:py-10 mt-8 bg-blue-100 rounded-2xl shadow-lg">
            <h2 class="text-2xl sm:text-3xl font-semibold text-blue-900 mb-6">Популярные товары</h2>
            <div class="swiper-container-products">
                <div class="swiper-wrapper">
                    @forelse ($popularProducts as $product)
                        <div class="swiper-slide">
                            <div
                                class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 relative">
                                <!-- Иконка избранного (в правом верхнем углу) -->
                                <div class="absolute top-2 right-2 z-10">
                                    <livewire:favorites :productId="$product['id']" />
                                </div>

                                <!-- Фото -->
                                <a href="{{ route('show', ['productId' => $product['id']]) }}">
                                    <img src="{{ asset($product['основноефото']['путь']) }}"
                                        class="w-full h-40 object-contain rounded-t-lg">
                                </a>

                                <!-- Название -->
                                <h3 class="mt-3 text-lg font-semibold text-gray-800">
                                    {{ $product['название'] ?? 'Без названия' }}
                                </h3>

                                <!-- Рейтинг -->
                                <div class="flex items-center mt-1">
                                    <span class="text-yellow-500 text-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($product['среднийрейтинг']['средний_рейтинг'] ?? 0))
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="text-blue-700 font-medium text-sm ml-1">
                                        ({{ $product['среднийрейтинг']['средний_рейтинг'] ?? 'Нет рейтинга' }})
                                    </span>
                                </div>

                                <!-- Цена и скидка -->
                                <div class="mt-2">
                                    @if ($product['скидка'] > 0)
                                        <div class="flex items-center space-x-2">
                                            <span class="text-gray-500 line-through text-sm">
                                                {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                            </span>
                                            <span class="text-blue-700 font-bold text-sm">
                                                {{ number_format($product['цена'] * (1 - ($product['скидка'] ?? 0) / 100), 0, '.', ' ') }}
                                                ₽
                                            </span>
                                            <span
                                                class="bg-red-100 text-red-600 px-1.5 py-0.5 rounded-full text-xs font-medium">
                                                -{{ $product['скидка'] }}%
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-blue-700 font-bold text-sm">
                                            {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                        </span>
                                    @endif
                                </div>

                                <!-- Кнопка "В корзину" -->
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                    <button type="submit"
                                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200 transform hover:scale-105 active:scale-95">
                                        В корзину
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center w-full py-6 text-gray-600">Загрузка популярных товаров...</div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Скидочные товары -->
        <section
            class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-6 sm:py-8 lg:py-10 mt-8 bg-red-100 rounded-2xl shadow-lg">
            <h2 class="text-2xl sm:text-3xl font-semibold text-red-900 mb-6">Лучшие скидки!</h2>
            <div class="swiper-container-products">
                <div class="swiper-wrapper">
                    @forelse ($discountProducts as $product)
                        <div class="swiper-slide">
                            <div
                                class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 relative">
                                <!-- Иконка избранного (в правом верхнем углу) -->
                                <div class="absolute top-2 right-2 z-10">
                                    <livewire:favorites :productId="$product['id']" />
                                </div>

                                <!-- Фото -->
                                <a href="{{ route('show', ['productId' => $product['id']]) }}">
                                    <img src="{{ asset($product['основноефото']['путь']) }}"
                                        class="w-full h-40 object-contain rounded-t-lg">
                                </a>

                                <!-- Название -->
                                <h3 class="mt-3 text-lg font-semibold text-gray-800">
                                    {{ $product['название'] ?? 'Без названия' }}
                                </h3>

                                <!-- Рейтинг -->
                                <div class="flex items-center mt-1">
                                    <span class="text-yellow-500 text-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($product['среднийрейтинг']['средний_рейтинг'] ?? 0))
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="text-blue-700 font-medium text-sm ml-1">
                                        ({{ $product['среднийрейтинг']['средний_рейтинг'] ?? 'Нет рейтинга' }})
                                    </span>
                                </div>

                                <!-- Цена и скидка -->
                                <div class="mt-2">
                                    @if ($product['скидка'] > 0)
                                        <div class="flex items-center space-x-2">
                                            <span class="text-gray-500 line-through text-sm">
                                                {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                            </span>
                                            <span class="text-red-700 font-bold text-sm">
                                                {{ number_format($product['цена'] * (1 - ($product['скидка'] ?? 0) / 100), 0, '.', ' ') }}
                                                ₽
                                            </span>
                                            <span
                                                class="bg-red-100 text-red-600 px-1.5 py-0.5 rounded-full text-xs font-medium">
                                                -{{ $product['скидка'] }}%
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-blue-700 font-bold text-sm">
                                            {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                        </span>
                                    @endif
                                </div>

                                <!-- Кнопка "В корзину" -->
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                    <button type="submit"
                                        class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium transition duration-200 transform hover:scale-105 active:scale-95">
                                        В корзину
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center w-full py-6 text-gray-600">Загрузка скидочных товаров...</div>
                    @endforelse
                </div>
            </div>
        </section>
        <!-- Лучшие отзывы -->
        <section
            class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-6 sm:py-8 lg:py-10 mt-8 bg-green-100 rounded-2xl shadow-lg">
            <h2 class="text-2xl sm:text-3xl font-semibold text-green-900 mb-6">Товары с самой лучшей оценкой</h2>
            <div class="swiper-container-products">
                <div class="swiper-wrapper">
                    @forelse ($bestProducts as $product)
                        <div class="swiper-slide">
                            <div
                                class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 relative">
                                <!-- Иконка избранного (в правом верхнем углу) -->
                                <div class="absolute top-2 right-2 z-10">
                                    <livewire:favorites :productId="$product['id']" />
                                </div>

                                <!-- Фото -->
                                <a href="{{ route('show', ['productId' => $product['id']]) }}">
                                    <img src="{{ asset($product['основноефото']['путь']) }}"
                                        class="w-full h-40 object-contain rounded-t-lg">
                                </a>

                                <!-- Название -->
                                <h3 class="mt-3 text-lg font-semibold text-gray-800">
                                    {{ $product['название'] ?? 'Без названия' }}
                                </h3>

                                <!-- Рейтинг -->
                                <div class="flex items-center mt-1">
                                    <span class="text-yellow-500 text-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($product['среднийрейтинг']['средний_рейтинг'] ?? 0))
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="text-blue-700 font-medium text-sm ml-1">
                                        ({{ $product['среднийрейтинг']['средний_рейтинг'] ?? 'Нет рейтинга' }})
                                    </span>
                                </div>

                                <!-- Цена и скидка -->
                                <div class="mt-2">
                                    @if ($product['скидка'] > 0)
                                        <div class="flex items-center space-x-2">
                                            <span class="text-gray-500 line-through text-sm">
                                                {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                            </span>
                                            <span class="text-green-700 font-bold text-sm">
                                                {{ number_format($product['цена'] * (1 - ($product['скидка'] ?? 0) / 100), 0, '.', ' ') }}
                                                ₽
                                            </span>
                                            <span
                                                class="bg-green-100 text-green-600 px-1.5 py-0.5 rounded-full text-xs font-medium">
                                                -{{ $product['скидка'] }}%
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-blue-700 font-bold text-sm">
                                            {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                        </span>
                                    @endif
                                </div>

                                <!-- Кнопка "В корзину" -->
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                    <button type="submit"
                                        class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-medium transition duration-200 transform hover:scale-105 active:scale-95">
                                        В корзину
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center w-full py-6 text-gray-600">Загрузка товаров с лучшими отзывами...</div>
                    @endforelse
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
            -webkit-user-select: none;
            user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }

        .swiper-wrapper {
            display: flex;

        }

        .swiper-slide {
            width: 100%;
            -webkit-user-select: none;
            user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
    <!-- Уведомления -->
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => { show = false }, 2500)" x-show="show"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed bottom-4 right-4 p-4 bg-green-500 text-white rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => { show = false }, 2500)" x-show="show"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed bottom-4 right-4 p-4 bg-red-500 text-white rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</div>
