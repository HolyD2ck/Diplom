<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-6">
        <h2 class="text-3xl font-semibold text-blue-900 mb-6">{{ $category->название ?? 'Категория не найдена' }}</h2>

        @if (empty($products))
            <p class="text-gray-600">В этой категории пока нет товаров.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <img src="{{ asset($product['основноефото']['путь']) }}" alt="{{ $product['название'] }}"
                            class="w-full h-40 object-cover rounded-t-lg">
                        <h3 class="mt-3 text-lg font-semibold text-gray-800">{{ $product['название'] }}</h3>
                        <p class="text-gray-600">Цена: {{ number_format($product['цена'], 0, '.', ' ') }} ₽</p>
                        {{-- <a href="{{ route('product.show', $product->id) }}"
                            class="mt-3 block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                            Подробнее
                        </a> --}}
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
