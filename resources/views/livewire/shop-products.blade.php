<div class="bg-gray-50 min-h-screen">
    <div class="content" style="padding-top: 60px">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <h2 class="text-2xl sm:text-3xl font-semibold text-blue-900 mb-6">
                {{ $category->название ?? 'Категория не найдена' }}
            </h2>
            <!-- Основной контент -->
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Левая колонка (Фильтры) -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-orange-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Фильтры</h3>
                        <form wire:submit.prevent="applyFilters">
                            <!-- Фильтр по цене -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Цена</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <input type="number" wire:model="filters.price_min" min="0"
                                        placeholder="Мин. цена"
                                        class="w-full border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <input type="number" wire:model="filters.price_max" min="0" max="9999999"
                                        placeholder="Макс. цена"
                                        class="w-full border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                @error('filters.price_min')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                @error('filters.price_max')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Фильтр по скидке -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Скидка</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <input type="number" wire:model="filters.discount_min" min="0"
                                        placeholder="Мин. скидка"
                                        class="w-full border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <input type="number" wire:model="filters.discount_max" min="0"
                                        max="100" placeholder="Макс. скидка"
                                        class="w-full border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                @error('filters.discount_min')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                @error('filters.discount_max')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Фильтр по производителям -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Производители</label>
                                <div class="space-y-2">
                                    @foreach ($manufacturers as $manufacturer)
                                        <div class="flex items-center">
                                            <input type="checkbox" wire:model="filters.manufacturers"
                                                value="{{ $manufacturer }}"
                                                class="h-4 w-4 text-blue-500 rounded focus:ring-blue-500">
                                            <span class="text-sm text-gray-700 ml-2">{{ $manufacturer }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm font-medium transition">
                                Применить фильтры
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Правая колонка (Товары) -->
                <div class="w-full lg:w-3/4">
                    <div class="bg-blue-100 rounded-2xl shadow-lg p-4 sm:p-6">
                        <!-- Сортировка -->
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-gray-600 text-sm">
                                Найдено: {{ $products['total'] ?? 0 }} товаров
                            </span>
                            <div class="flex items-center">
                                <h2 class="text-gray-700 text-sm font-semibold mr-2">Сортировка:</h2>
                                <select wire:model="sortBy" wire:change="updateSort($event.target.value)"
                                    class="border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="default">По умолчанию</option>
                                    <option value="price_asc">Цена: по возрастанию</option>
                                    <option value="price_desc">Цена: по убыванию</option>
                                    <option value="rating_desc">Рейтинг: по убыванию</option>
                                    <option value="newest">Новинки</option>
                                </select>
                            </div>
                        </div>

                        <!-- Список товаров -->
                        @if (empty($products['data']))
                            <p class="text-center text-gray-600 text-lg py-8">Товары, что вы ищите отсутствуют в
                                продаже!
                            </p>
                        @else
                            <div class="grid grid-cols-1 gap-6">
                                @foreach ($products['data'] as $product)
                                    <div
                                        class="bg-white rounded-lg shadow-md p-4 flex items-center hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-[1.02]">
                                        <!-- Изображение -->
                                        <a href="{{ route('show', ['productId' => $product['id']]) }}">
                                            <img src="{{ asset($product['основноефото']['путь'] ?? 'images/default.jpg') }}"
                                                alt="{{ $product['название'] }}"
                                                class="w-32 h-32 object-contain rounded-lg flex-shrink-0">
                                        </a>
                                        <!-- Информация о товаре -->
                                        <div class="ml-4 flex-1">
                                            <h3 class="text-lg font-semibold text-gray-800">
                                                {{ $category['название'] }}
                                                {{ $product['название'] ?? 'Без названия' }}
                                            </h3>
                                            <div class="mt-2">
                                                @if (($product['скидка'] ?? 0) > 0)
                                                    <span class="text-gray-500 line-through">
                                                        {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                                    </span>
                                                    <span class="text-blue-700 font-medium ml-2">
                                                        {{ number_format($product['цена'] * (1 - $product['скидка'] / 100), 0, '.', ' ') }}
                                                        ₽
                                                    </span>
                                                    <span
                                                        class="text-blue-500 text-sm ml-2">(-{{ $product['скидка'] }}%)</span>
                                                @else
                                                    <span class="text-blue-700 font-medium">
                                                        {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-blue-700 text-sm font-medium mt-1">
                                                Рейтинг:
                                                <span class="text-yellow-500 text-lg">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= floor($product['среднийрейтинг']['средний_рейтинг'] ?? 0))
                                                            ★
                                                        @else
                                                            ☆
                                                        @endif
                                                    @endfor
                                                </span>
                                                <span class="text-blue-700 font-medium ml-2">
                                                    {{ $product['среднийрейтинг']['средний_рейтинг'] ?? 'Нет рейтинга' }}
                                                </span>
                                            </p>
                                            <span class="font-medium text-blue-900">
                                                Производитель: {{ $product['производитель'] }}
                                            </span>
                                            <!-- Атрибуты -->
                                            @if (!empty($product['значенияатрибутов']))
                                                <div class="mt-3 text-sm text-gray-600">
                                                    <ul class="space-y-1">
                                                        @foreach (array_slice($product['значенияатрибутов'], 0, 3) as $attribute)
                                                            <li>
                                                                <span
                                                                    class="font-medium text-blue-900">{{ $attribute['атрибут']['название'] }}:</span>
                                                                {{ $attribute['значение'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex flex-col ml-4">
                                            <div class="text-center mb-2">
                                            </div>
                                            <form action="{{ route('cart.add') }}" method="POST" class="mb-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                                <button type="submit"
                                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200 transform hover:scale-105 active:scale-95 w-full">
                                                    В корзину
                                                </button>
                                            </form>
                                            <!-- Кнопка "Подробнее" -->
                                            <a href="{{ route('show', ['productId' => $product['id']]) }}"
                                                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 text-sm font-medium transition duration-200 transform hover:scale-105 active:scale-95 w-full">
                                                Подробнее
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Пагинация -->
                            @if ($products && isset($products['last_page']) && $products['last_page'] > 1)
                                <div class="mt-6 flex justify-center space-x-2">
                                    <!-- В начало -->
                                    @if ($products['current_page'] > 1)
                                        <button wire:click="goToPage(1)"
                                            class="px-3 py-1 bg-gray-500 text-white rounded-lg hover:bg-gray-600 text-sm">
                                            В начало
                                        </button>
                                    @endif

                                    <!-- Назад -->
                                    @if ($products['current_page'] > 1)
                                        <button wire:click="goToPage({{ $products['current_page'] - 1 }})"
                                            class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                            Назад
                                        </button>
                                    @endif

                                    @php
                                        $start = max(1, $products['current_page'] - 2);
                                        $end = min($products['last_page'], $products['current_page'] + 2);
                                    @endphp

                                    @if ($start > 1)
                                        <span class="px-2 py-1 text-gray-600 text-sm">...</span>
                                    @endif

                                    @for ($page = $start; $page <= $end; $page++)
                                        <button wire:click="goToPage({{ $page }})"
                                            class="px-3 py-1 rounded-lg text-sm 
                {{ $products['current_page'] == $page ? 'bg-blue-800 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                            {{ $page }}
                                        </button>
                                    @endfor

                                    @if ($end < $products['last_page'])
                                        <span class="px-2 py-1 text-gray-600 text-sm">...</span>
                                    @endif

                                    <!-- Вперёд -->
                                    @if ($products['current_page'] < $products['last_page'])
                                        <button wire:click="goToPage({{ $products['current_page'] + 1 }})"
                                            class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                            Вперёд
                                        </button>
                                    @endif

                                    <!-- В конец -->
                                    @if ($products['current_page'] < $products['last_page'])
                                        <button wire:click="goToPage({{ $products['last_page'] }})"
                                            class="px-3 py-1 bg-gray-500 text-white rounded-lg hover:bg-gray-600 text-sm">
                                            В конец
                                        </button>
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
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
