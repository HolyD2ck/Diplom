<div class="bg-gray-100 min-h-screen pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl sm:text-3xl font-semibold text-blue-900 mb-6">Ваша корзина</h1>

        @if (!empty($cart))
            <div class="bg-blue-50 rounded-lg shadow-md p-4 sm:p-6">
                <div class="space-y-4">
                    @foreach ($cart as $item)
                        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                            <div class="flex items-center space-x-4 w-full">
                                <!-- Фото -->
                                <img src="{{ asset($item['фото']) }}" alt="{{ $item['название'] }}"
                                    class="w-20 h-20 object-contain rounded-lg flex-shrink-0">

                                <!-- Информация о товаре -->
                                <div class="flex-1 min-w-0">
                                    <h2 class="text-lg font-semibold text-gray-800 max-w-64 truncate">
                                        {{ $item['название'] }}</h2>
                                    <p class="text-gray-600 text-sm">Цена:
                                        {{ number_format($item['цена'], 0, '.', ' ') }} ₽</p>
                                    <p class="text-gray-600 text-sm">Скидка: {{ $item['скидка'] ?? 0 }}%</p>
                                </div>

                                <!-- Количество + - -->
                                <div class="flex items-center justify-center w-24 space-x-2">
                                    <button wire:click="updateQuantity({{ $item['товар_id'] }}, -1)"
                                        class="w-8 h-8 flex items-center justify-center bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                                        −
                                    </button>
                                    <span
                                        class="w-8 text-center text-blue-700 font-medium">{{ $item['количество'] }}</span>
                                    <button wire:click="updateQuantity({{ $item['товар_id'] }}, 1)"
                                        class="w-8 h-8 flex items-center justify-center bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                                        +
                                    </button>
                                </div>

                                <!-- Итоговая цена -->
                                <p class="text-blue-700 font-medium text-base w-24 text-center">
                                    {{ number_format($item['цена'] * $item['количество'] * (1 - ($item['скидка'] ?? 0) / 100), 0, '.', ' ') }}
                                    ₽
                                </p>

                                <!-- Удаление товара -->
                                <form wire:submit.prevent="removeFromCart({{ $item['товар_id'] }})">
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 border-t border-gray-200 pt-4">
                    <div class="flex justify-between items-center">
                        <p class="text-lg font-semibold text-gray-800">Итого:</p>
                        <p class="text-xl font-bold text-blue-700">
                            {{ number_format(collect($cart)->sum(fn($item) => $item['цена'] * $item['количество'] * (1 - ($item['скидка'] ?? 0) / 100)), 0, '.', ' ') }}
                            ₽
                        </p>
                    </div>
                    <div class="mt-4 flex justify-end space-x-4">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium transition duration-200">
                                Очистить корзину
                            </button>
                        </form>
                        <button wire:click="openReviewModal"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-medium transition duration-200 shadow-md">
                            Оформить заказ
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-8 text-gray-600">
                <p class="text-lg">Ваша корзина пуста</p>
                <a href="{{ route('dashboard') }}"
                    class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200">
                    Вернуться к покупкам
                </a>
            </div>
        @endif
    </div>
    @if ($isOpen)
        <!-- Затемнение фона -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity"></div>

        <!-- Модальное окно -->
        <div class="fixed inset-0 z-10 flex items-center justify-center p-4">
            <div class="w-full max-w-2xl bg-white rounded-lg shadow-xl overflow-hidden transform transition-all">
                <!-- Заголовок и кнопка закрытия -->
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Оформление заказа</h2>
                    <button wire:click="closeReviewModal" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Основной контент с прокруткой -->
                <div class="p-6 overflow-y-auto max-h-[50vh]">
                    <!-- Информация о пользователе -->
                    <div class="mb-6">
                        <p class="text-gray-700 mb-2">Имя: {{ $user->name }}</p>
                        <p class="text-gray-700 mb-2">Email: {{ $user->email }}</p>
                    </div>

                    <!-- Выбор магазина -->
                    <div class="mb-6">
                        <label for="shop_id" class="block text-gray-700 font-bold mb-2">Выберите магазин:</label>
                        <select wire:model="selectedShopId" id="shop_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Выберите магазин</option>
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->город }} {{ $shop->улица }}
                                    {{ $shop->название_пункта }}</option>
                            @endforeach
                        </select>
                        @error('selectedShopId')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Поля для ввода данных карты -->
                    <div class="space-y-4">
                        <div>
                            <label for="card_number" class="block text-gray-700 font-bold mb-2">Номер карты:</label>
                            <input type="text" id="card_number"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="card_holder" class="block text-gray-700 font-bold mb-2">Имя владельца
                                карты:</label>
                            <input type="text" id="card_holder"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="expiry_date" class="block text-gray-700 font-bold mb-2">Срок действия:</label>
                            <input type="text" id="expiry_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="cvv" class="block text-gray-700 font-bold mb-2">CVV:</label>
                            <input type="text" id="cvv"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Кнопка оформления заказа -->
                <div class="flex justify-end p-6 border-t border-gray-200">
                    <button wire:click="saveOrder"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                        Оформить заказ
                    </button>
                </div>
            </div>
        </div>
    @endif
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
