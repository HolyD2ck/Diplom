<div class="bg-gray-50 min-h-screen">
    <div class="content" style="padding-top: 60px">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Основной контент (слева) -->
                <div class="w-full lg:w-3/4">
                    <!-- Основной блок с названием и фото -->
                    <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 mb-6">
                        <div class="flex flex-col lg:flex-row gap-6">
                            <!-- Фото -->
                            <div class="w-full lg:w-1/2">
                                <img src="{{ asset($mainPhoto) }}" alt="{{ $product['название'] }}"
                                    class="w-full h-64 lg:h-96 object-contain rounded-lg mb-4">
                                <!-- Галерея миниатюр -->
                                @if (!empty($product['фотографии']))
                                    <div class="flex gap-2 overflow-x-auto">
                                        @foreach ($product['фотографии'] as $photo)
                                            <img src="{{ asset($photo['путь']) }}" alt="{{ $product['название'] }}"
                                                class="w-16 h-16 object-cover rounded-lg cursor-pointer hover:opacity-75 transition duration-200"
                                                wire:click="setMainPhoto('{{ $photo['путь'] }}')">
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Название и цена -->
                            <div class="w-full lg:w-1/2">
                                <h1 class="text-2xl sm:text-3xl font-bold text-blue-900 mb-4">
                                    {{ $product['название'] ?? 'Без названия' }}
                                </h1>
                                <div class="flex items-center mb-4">
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
                                </div>
                                <!-- Цена и наличие -->
                                <div class="mb-4">
                                    @if (($product['скидка'] ?? 0) > 0)
                                        <span class="text-gray-500 line-through text-lg">
                                            {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                        </span>
                                        <span class="text-blue-700 text-2xl font-bold ml-2">
                                            {{ number_format($product['цена'] * (1 - $product['скидка'] / 100), 0, '.', ' ') }}
                                            ₽
                                        </span>
                                        <span class="text-blue-500 text-sm ml-2">(-{{ $product['скидка'] }}%)</span>
                                    @else
                                        <span class="text-blue-700 text-2xl font-bold">
                                            {{ number_format($product['цена'], 0, '.', ' ') }} ₽
                                        </span>
                                    @endif
                                </div>
                                <!-- Наличие -->
                                <p class="text-sm mb-4">
                                    @if ($product['наличие'] ?? true)
                                        <span class="text-green-600 font-medium">В наличии</span>
                                    @else
                                        <span class="text-red-600 font-medium">Нет в наличии</span>
                                    @endif
                                </p>
                                <!-- Кнопка "В корзину" -->
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                    <button type="submit"
                                        class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-base font-medium transition duration-200">
                                        Добавить в корзину
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Характеристики товара -->
                    <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 mb-6">
                        <h2 class="text-xl font-semibold text-blue-900 mb-4">Характеристики</h2>
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <dt class="font-medium text-blue-900">Производитель:</dt>
                                <dd>{{ $product['производитель'] ?? 'Не указан' }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-blue-900">Модель:</dt>
                                <dd>{{ $product['название'] ?? 'Не указана' }}</dd>
                            </div>
                            @if (!empty($product['значенияатрибутов']))
                                @foreach ($product['значенияатрибутов'] as $attribute)
                                    <div>
                                        <dt class="font-medium text-blue-900">{{ $attribute['атрибут']['название'] }}:
                                        </dt>
                                        <dd>{{ $attribute['значение'] }}</dd>
                                    </div>
                                @endforeach
                            @endif
                        </dl>
                    </div>

                    <!-- Описание -->
                    <div class="bg-gray-200 rounded-2xl shadow-lg p-4 sm:p-6 mb-6">
                        <h2 class="text-xl font-semibold text-blue-900 mb-4">Описание</h2>
                        <p class="text-gray-600">{{ $product['описание'] ?? 'Описание отсутствует' }}</p>
                    </div>

                    <!-- Отзывы и рейтинг -->
                    <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 mb-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl sm:text-2xl font-semibold text-blue-900">Отзывы и рейтинг</h2>
                            <button wire:click="openReviewModal"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200 shadow-md">
                                Оставить отзыв
                            </button>
                        </div>

                        <!-- Средний рейтинг -->
                        <div class="flex items-center mb-6">
                            <span class="text-yellow-500 text-lg">
                                <span class="text-blue-900 text-lg">Рейтинг товара: </span>
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
                                <span class="text-gray-500 text-sm">({{ count($product['отзывы'] ?? []) }}
                                    отзывов)</span>
                            </span>
                        </div>

                        <!-- Список отзывов -->
                        @if (!empty($product['отзывы']))
                            <div class="space-y-6">
                                @foreach (array_slice($product['отзывы'], 0, $visibleReviews) as $review)
                                    <div
                                        class="bg-gray-50 rounded-lg p-4 border-2 {{ $review['рейтинг'] >= 4 ? 'border-green-200' : 'border-red-200' }} shadow-sm hover:shadow-md transition duration-200">
                                        <div class="flex items-start gap-4">
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-gray-800 font-medium text-lg">
                                                        {{ $review['пользователь']['name'] ?? 'Аноним' }}
                                                    </p>
                                                    <p class="text-yellow-500 flex items-center">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $review['рейтинг'])
                                                                ★
                                                            @else
                                                                ☆
                                                            @endif
                                                        @endfor
                                                    </p>
                                                </div>
                                                <p class="text-gray-600 mt-2">{{ $review['отзыв'] ?? 'Без текста' }}
                                                </p>
                                                <p class="text-gray-500 text-xs mt-1">
                                                    {{ isset($review['created_at']) ? \Carbon\Carbon::parse($review['created_at'])->format('d.m.Y H:i') : 'Дата неизвестна' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if (count($product['отзывы']) > $visibleReviews)
                                <button wire:click="loadMoreReviews"
                                    class="mt-4 text-blue-600 hover:text-blue-800 text-sm font-medium underline">
                                    Показать еще отзывы
                                </button>
                            @endif
                        @else
                            <p class="text-gray-600 text-center py-4">Отзывов пока нет. Будьте первым, кто оставит
                                отзыв!</p>
                        @endif
                    </div>
                </div>

                <!-- Похожие товары (справа) -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-blue-100 rounded-2xl shadow-lg p-4 sm:p-6 sticky top-20">
                        <h2 class="text-xl font-semibold text-blue-900 mb-4">Похожие товары</h2>
                        <div class="space-y-6">
                            @foreach ($similarProducts as $similar)
                                <div
                                    class="bg-white rounded-lg p-4 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-[1.02]">
                                    <!-- Фото -->
                                    <a href="{{ route('show', ['productId' => $similar['id']]) }}">
                                        <img src="{{ asset($similar['основноефото']['путь'] ?? 'images/default.jpg') }}"
                                            alt="{{ $similar['название'] }}"
                                            class="w-full h-24 object-contain rounded-t-lg mb-2">
                                    </a>
                                    <!-- Название -->
                                    <h3 class="text-sm font-semibold text-gray-800 line-clamp-2">
                                        {{ $similar['название'] ?? 'Без названия' }}
                                    </h3>

                                    <!-- Рейтинг -->
                                    <p class="text-yellow-500 text-xs mt-1 flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($similar['среднийрейтинг']['средний_рейтинг'] ?? 0))
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                        <span class="text-blue-700 font-medium ml-1">
                                            {{ $similar['среднийрейтинг']['средний_рейтинг'] ?? 'N/A' }}
                                        </span>
                                    </p>

                                    <!-- Цена со скидкой -->
                                    <div class="mt-1">
                                        @if (($similar['скидка'] ?? 0) > 0)
                                            <span class="text-gray-500 line-through text-xs">
                                                {{ number_format($similar['цена'], 0, '.', ' ') }} ₽
                                            </span>
                                            <p class="text-blue-700 font-medium text-sm">
                                                {{ number_format($similar['цена'] * (1 - ($similar['скидка'] ?? 0) / 100), 0, '.', ' ') }}
                                                ₽
                                                <span class="text-blue-500 text-xs">(-{{ $similar['скидка'] }}%)</span>
                                            </p>
                                        @else
                                            <p class="text-blue-700 font-medium text-sm">
                                                {{ number_format($similar['цена'], 0, '.', ' ') }} ₽
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Кнопка "В корзину" -->
                                    <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $similar['id'] }}">
                                        <button type="submit"
                                            class="w-full px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-xs font-medium transition duration-200 transform hover:scale-105 active:scale-95">
                                            В корзину
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Модальное окно -->
    @if ($isOpen)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-semibold text-blue-900 mb-4">Оставить отзыв</h2>
                <label class="block text-sm font-medium text-gray-700">Рейтинг</label>
                <select wire:model="rating"
                    class="w-full p-2 border rounded mb-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="1">★☆☆☆☆</option>
                </select>
                <label class="block text-sm font-medium text-gray-700">Отзыв</label>
                <textarea wire:model="reviewText"
                    class="w-full p-2 border rounded mb-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"></textarea>
                <div class="flex justify-end gap-2">
                    <button wire:click="closeReviewModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 text-sm font-medium transition duration-200">
                        Отмена
                    </button>
                    <button wire:click="saveReview"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition duration-200">
                        Сохранить
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
