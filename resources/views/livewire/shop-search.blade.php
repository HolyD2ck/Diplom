{{-- <div class="relative w-full">
    <input type="text" wire:model="search" placeholder="Поиск товаров и категорий..."
        class="w-full p-3 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base placeholder-gray-400 transition duration-200">

    <!-- Выпадающее меню с результатами поиска -->
    @if (!empty($searchResults['products']) || !empty($searchResults['categories']))
        <div
            class="absolute w-full bg-white border border-gray-300 shadow-md rounded-lg mt-1 max-h-60 overflow-auto z-50">

            <!-- Товары -->
            @if (!empty($searchResults['products']))
                <div class="px-4 py-2 text-gray-600 font-semibold">Товары</div>
                @foreach ($searchResults['products'] as $product)
                    <a href="{{ route('product.show', $product->id) }}"
                        class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100">
                        {{ $product->name }}
                    </a>
                @endforeach
            @endif

            <!-- Категории -->
            @if (!empty($searchResults['categories']))
                <div class="px-4 py-2 text-gray-600 font-semibold">Категории</div>
                @foreach ($searchResults['categories'] as $category)
                    <a href="{{ route('category.show', $category->id) }}"
                        class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100">
                        {{ $category->name }}
                    </a>
                @endforeach
            @endif

        </div>
    @endif
</div> --}}
<input type="text" wire:model="search" placeholder="Search">
