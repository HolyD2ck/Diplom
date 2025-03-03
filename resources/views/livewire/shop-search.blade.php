<div class="flex-1 w-full relative">
    <input type="text" wire:model.debounce.1ms="value" wire:change="FindDelo"
        placeholder="Поиск товаров или категорий..."
        class="w-full p-3 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base placeholder-gray-400 transition duration-200">

    <!-- Выпадающее окно с результатами -->
    @if (!empty($searchResults))
        <div
            class="absolute w-full bg-white border border-gray-300 shadow-md rounded-lg mt-1 max-h-60 overflow-auto z-10">
            <!-- Если найдены товары -->
            @if (!empty($searchResults['products']))
                <div class="px-4 py-2 text-gray-600 font-semibold">Товары:</div>
                @foreach ($searchResults['products'] as $product)
                    <a href="{{ route('show', $product['id']) }}"
                        class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100">
                        {{ $product['название'] }}
                    </a>
                @endforeach
            @endif

            <!-- Если найдены категории -->
            @if (!empty($searchResults['categories']))
                <div class="px-4 py-2 text-gray-600 font-semibold">Категории:</div>
                @foreach ($searchResults['categories'] as $category)
                    <a href="{{ route('category', $category['id']) }}"
                        class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100">
                        {{ $category['название'] }}
                    </a>
                @endforeach
            @endif
        </div>
    @endif
</div>
