<div>
    @if (empty($orders))
        <p class="text-gray-600 dark:text-gray-400">Вы еще не сделали ни одного заказа.</p>
    @else
        <div class="space-y-6">
            @foreach ($orders as $order)
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                    <!-- Заголовок заказа -->
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                            Заказ #{{ $order['id'] }}
                        </h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                            Дата: {{ \Carbon\Carbon::parse($order['created_at'])->format('d.m.Y H:i') }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Статус: <span class="font-medium">{{ $order['статус'] }}</span>
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Итоговая цена: <span class="font-medium">{{ $order['итоговая_цена'] }} ₽</span>
                        </p>
                    </div>

                    <!-- Товары в заказе -->
                    <div class="mt-4">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Товары:</h5>
                        <ul class="space-y-4">
                            @foreach ($order['детализаказа'] as $item)
                                <li class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <!-- Изображение товара -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item['товар']['основноефото']['путь'] }}"
                                            class="w-16 h-16 object-cover rounded-lg">
                                    </div>
                                    <!-- Информация о товаре -->
                                    <div class="flex-1">
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">
                                            {{ $item['товар']['название'] }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            Количество: {{ $item['количество'] }} шт.
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            Цена: {{ $item['цена'] }} ₽
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
