<div class="bg-gray-50 min-h-screen">
    <div class="content" style="padding-top: 60px">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-2xl sm:text-3xl font-semibold text-blue-900 mb-8">Избранное</h1>

            @if (count($favorites) > 0)
                <!-- Контейнер для карточек с фоном bg-blue-100 -->
                <div class="bg-blue-100 rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        @foreach ($favorites as $favorite)
                            <div
                                class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02]">

                                <!-- Иконка удаления из избранного -->
                                <button wire:click="removeFromFavorites({{ $favorite['товар_id'] }})"
                                    class="absolute top-3 right-3 p-1 text-gray-500 hover:text-red-500 bg-white rounded-full shadow-sm transition duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <!-- Изображение -->
                                <a href="{{ route('show', ['productId' => $favorite['товар_id']]) }}" class="block">
                                    <div class="w-full h-48 flex items-center justify-center bg-gray-100">
                                        <img src="{{ asset($favorite['фото']) }}" alt="{{ $favorite['название'] }}"
                                            class="max-w-full max-h-48 object-contain p-4">
                                    </div>
                                </a>

                                <!-- Информация о товаре -->
                                <div class="p-6">
                                    <!-- Название товара -->
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                        {{ $favorite['название'] }}
                                    </h3>

                                    <!-- Цена и скидка -->
                                    <div class="mt-3">
                                        @if ($favorite['скидка'] > 0)
                                            <div class="flex items-center space-x-2">
                                                <span class="text-gray-500 line-through">
                                                    {{ number_format($favorite['цена'], 0, '.', ' ') }} ₽
                                                </span>
                                                <span class="text-blue-700 font-bold text-lg">
                                                    {{ number_format($favorite['цена'] * (1 - $favorite['скидка'] / 100), 0, '.', ' ') }}
                                                    ₽
                                                </span>
                                                <span
                                                    class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-sm font-medium">
                                                    -{{ $favorite['скидка'] }}%
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-blue-700 font-bold text-lg">
                                                {{ number_format($favorite['цена'], 0, '.', ' ') }} ₽
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Кнопки -->
                                    <div class="mt-6 flex space-x-3">
                                        <button wire:click="addToCart({{ $favorite['товар_id'] }})"
                                            class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition duration-200 transform hover:scale-105 active:scale-95">
                                            В корзину
                                        </button>

                                        <a href="{{ route('show', ['productId' => $favorite['товар_id']]) }}"
                                            class="flex-1 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 font-medium transition duration-200 transform hover:scale-105 active:scale-95 text-center">
                                            Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-gray-600 text-center py-10 text-lg">В избранном пока нет товаров.</p>
            @endif
        </div>
    </div>
</div>
