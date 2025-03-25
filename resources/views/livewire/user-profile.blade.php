<div>
    <!-- Секция с фото профиля -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Фото профиля</h3>
        <div class="flex flex-col items-center">

            <img src="{{ $newPhotoPreview ?? asset(auth()->user()->фото) }}"
                class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-gray-200 dark:border-gray-600">

            <div class="w-full">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Обновить фото</label>
                <input type="file" wire:model="newPhoto"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('newPhoto')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror

                <button wire:click="updatePhoto"
                    class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                    Сохранить фото
                </button>
            </div>
        </div>
    </div>


    <!-- История заказов -->
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">История заказов</h3>

    @if (empty($orders))
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Нет заказов</h3>
            <p class="mt-1 text-gray-500 dark:text-gray-400">Вы еще не совершали покупок в нашем магазине.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($orders as $order)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 flex justify-between items-center">
                        <div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Заказ
                                #{{ $order['id'] }}</span>
                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                {{ \Carbon\Carbon::parse($order['created_at'])->format('d.m.Y H:i') }}</p>
                        </div>
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded-full 
                              @if ($order['статус'] === 'completed') bg-green-100 text-green-800 
                              @elseif($order['статус'] === 'pending') bg-yellow-100 text-yellow-800 
                              @else bg-blue-100 text-blue-800 @endif">
                            {{ ucfirst($order['статус']) }}
                        </span>
                    </div>

                    <div class="p-4">
                        @foreach ($order['детализаказа'] as $item)
                            <div
                                class="flex items-start py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                <img src="{{ $item['товар']['основноефото']['путь'] }}"
                                    class="w-16 h-16 object-cover rounded-md mr-4">
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $item['товар']['название'] }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Количество:
                                        {{ $item['количество'] }} × {{ $item['цена'] }} ₽</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $item['количество'] * $item['цена'] }} ₽</div>
                            </div>
                        @endforeach

                        <div
                            class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Итого</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $order['итоговая_цена'] }}
                                ₽</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
