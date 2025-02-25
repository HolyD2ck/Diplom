@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen pt-16"> <!-- Отступ для фиксированной шапки -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Заголовок и подзаголовок -->
            <section class="text-center mb-12">
                <h1 class="text-3xl sm:text-4xl font-bold text-blue-900">О нас</h1>
                <p class="mt-2 text-lg sm:text-xl text-gray-700">Мы – ваш надежный партнер в мире компьютерной техники!</p>
            </section>

            <!-- Информация о компании -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">О нашем магазине</h2>
                <p class="text-gray-600 text-sm sm:text-base">
                    TechStore – это интернет-магазин, специализирующийся на компьютерной технике. Мы предлагаем широкий
                    ассортимент продукции – от ноутбуков и процессоров до аксессуаров и периферии. Что нас отличает? Высокое
                    качество товаров, профессиональная поддержка клиентов и конкурентные цены. Мы стремимся сделать
                    технологии доступными для каждого!
                </p>
            </section>

            <!-- История компании -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Наша история</h2>
                <p class="text-gray-600 text-sm sm:text-base">
                    TechStore был основан в 2018 году группой энтузиастов, увлеченных технологиями. Начав с небольшого
                    склада в Ангарске, мы быстро выросли благодаря доверию клиентов и партнеров. Сегодня мы – один из
                    лидеров в продаже компьютерной техники в регионе, гордимся тысячами выполненных заказов и десятками
                    довольных корпоративных клиентов.
                </p>
            </section>

            <!-- Миссия и ценности -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Миссия и ценности</h2>
                <p class="text-gray-600 text-sm sm:text-base mb-4">
                    Наша миссия – предоставлять лучшие технологические решения для дома и бизнеса, делая покупку техники
                    простой и удобной.
                </p>
                <ul class="list-disc list-inside text-gray-600 text-sm sm:text-base space-y-2">
                    <li><span class="font-semibold">Качество:</span> Только проверенные товары от надежных брендов.</li>
                    <li><span class="font-semibold">Надежность:</span> Мы всегда выполняем свои обещания.</li>
                    <li><span class="font-semibold">Инновации:</span> Следим за новинками и предлагаем их вам первыми.</li>
                    <li><span class="font-semibold">Забота о клиентах:</span> Ваше удовлетворение – наш приоритет.</li>
                </ul>
            </section>
            <!-- Наша команда -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4 text-center">Наша команда</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                    <!-- Карточки -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden relative">
                        <img src="https://incrussia.ru/upload/resized/13d10f99253df3e1350f14674ca06221.jpg"
                            alt="Куриян Роман" class="w-full h-72 object-cover object-top">
                        <div class="absolute bottom-0 w-full bg-white bg-opacity-90 p-4 text-center">
                            <h3 class="text-lg font-semibold text-blue-900">Куриян Роман</h3>
                            <p class="text-gray-600 text-sm">Основатель, 5 лет опыта</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden relative">
                        <img src="https://smart-business.su/images/statyi/5-otmazok-gore-biznesmenov.jpg"
                            alt="Катырев Алексей" class="w-full h-72 object-cover object-top">
                        <div class="absolute bottom-0 w-full bg-white bg-opacity-90 p-4 text-center">
                            <h3 class="text-lg font-semibold text-blue-900">Катырев Алексей</h3>
                            <p class="text-gray-600 text-sm">Менеджер по продажам</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden relative">
                        <img src="https://st3.depositphotos.com/12985790/16858/i/450/depositphotos_168580868-stock-photo-thoughtful-businessman-at-workplace.jpg"
                            alt="Кузьменко Егор" class="w-full h-72 object-cover object-top">
                        <div class="absolute bottom-0 w-full bg-white bg-opacity-90 p-4 text-center">
                            <h3 class="text-lg font-semibold text-blue-900">Кузьменко Егор</h3>
                            <p class="text-gray-600 text-sm">Логист</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden relative">
                        <img src="https://k2consult.ru/upload/medialibrary/f18/f189a4e1ca107927b9ec0c6709b0e3ab.jpg"
                            alt="Рябцев Артём" class="w-full h-72 object-cover object-top">
                        <div class="absolute bottom-0 w-full bg-white bg-opacity-90 p-4 text-center">
                            <h3 class="text-lg font-semibold text-blue-900">Рябцев Артём</h3>
                            <p class="text-gray-600 text-sm">Специалист поддержки</p>
                        </div>
                    </div>
                </div>
            </section>
            </section>
            <!-- Обслуживание клиентов -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Обслуживание клиентов</h2>
                <p class="text-gray-600 text-sm sm:text-base">
                    Мы гордимся нашим подходом к клиентам: гибкая система скидок для постоянных покупателей, индивидуальные
                    предложения под ваши задачи, доставка в кратчайшие сроки по всей России и круглосуточная поддержка. Ваши
                    вопросы и пожелания – наша главная задача!
                </p>
            </section>

            <!-- Видео -->
            <section class="mb-12 text-center">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">О нас в видео</h2>
                <div class="relative w-full max-w-4xl mx-auto">
                    <iframe class="w-full h-[500px]" src="https://www.youtube.com/embed/S5EPVyC_ugQ?si=QWNAEqV5F3GvJ6hU"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
            </section>

        </div>
    </div>
@endsection
