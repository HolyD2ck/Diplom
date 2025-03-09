<div class="flex-1 w-full relative">
    <!-- Поле поиска -->
    <input type="text" wire:model.debounce.1ms="value" wire:change="FindDelo"
        placeholder="Поиск товаров или категорий..."
        class="w-full p-3 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base placeholder-gray-400 transition duration-200 ease-in-out transform hover:scale-105 hover:shadow-md">

    <!-- Выпадающее окно с результатами -->
    @if (!empty($searchResults))
        <div
            class="absolute w-full bg-white border border-gray-300 shadow-lg rounded-lg mt-1 max-h-60 overflow-auto z-10 transition-all duration-300 ease-in-out transform opacity-100 scale-100">
            <!-- Если найдены товары -->
            @if (!empty($searchResults['products']))
                <div class="px-4 py-2 text-gray-600 font-semibold bg-gray-50 border-b border-gray-200">Товары:</div>
                @foreach ($searchResults['products'] as $product)
                    <a href="{{ route('show', $product['id']) }}"
                        class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100 transition duration-150 ease-in-out">
                        {{ $product['название'] }}
                    </a>
                @endforeach
            @endif

            <!-- Если найдены категории -->
            @if (!empty($searchResults['categories']))
                <div class="px-4 py-2 text-gray-600 font-semibold bg-gray-50 border-b border-gray-200">Категории:</div>
                @foreach ($searchResults['categories'] as $category)
                    <a href="{{ route('category', $category['id']) }}"
                        class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100 transition duration-150 ease-in-out">
                        {{ $category['название'] }}
                    </a>
                @endforeach
            @endif
        </div>
    @endif
</div>
