<section class="mb-12">
    <h2 class="text-2xl font-semibold text-blue-900 mb-4">Отзывы клиентов</h2>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($reviews as $review)
                <div class="swiper-slide">
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <p class="text-gray-600 text-sm sm:text-base italic">"{{ $review->отзыв }}"</p>
                        <p class="mt-2 text-blue-900 font-semibold text-sm">{{ $review->имя_клиента }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
