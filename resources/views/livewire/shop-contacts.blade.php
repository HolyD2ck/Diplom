@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <div class="bg-gray-100 min-h-screen pt-16"> <!-- Отступ для фиксированной шапки -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Заголовок -->
            <section class="text-center mb-12">
                <h1 class="text-3xl sm:text-4xl font-bold text-blue-900">Контакты</h1>
                <p class="mt-2 text-lg sm:text-xl text-gray-700">Свяжитесь с нами любым удобным способом!</p>
            </section>

            <!-- Информация о компании -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Как нас найти</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="flex items-center space-x-2 text-sm sm:text-base text-gray-600">
                            <svg class="w-5 h-5 text-blue-900 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            <span>г. Ангарск, ул. Ленина, 15</span>
                        </p>
                        <p class="flex items-center space-x-2 mt-2 text-sm sm:text-base text-gray-600">
                            <svg class="w-5 h-5 text-blue-900 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M9 21V3m6 18V3"></path>
                            </svg>
                            <span>+7 (999) 123-45-67</span>
                        </p>
                        <p class="flex items-center space-x-2 mt-2 text-sm sm:text-base text-gray-600">
                            <svg class="w-5 h-5 text-blue-900 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 6 9-6"></path>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8"></path>
                            </svg>
                            <span>info@techstore.com</span>
                        </p>
                        <p class="flex items-center space-x-2 mt-2 text-sm sm:text-base text-gray-600">
                            <svg class="w-5 h-5 text-blue-900 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Пн-Пт: 9:00–18:00, Сб: 10:00–15:00, Вс: выходной</span>
                        </p>
                    </div>
                </div>
            </section>
            <!-- Карта -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Где мы находимся</h2>
                <div class="w-full h-64 sm:h-80 rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-full"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10841.50284327453!2d103.88620093156554!3d52.55024844848503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5d079cd24af086e1%3A0x1a743ba6ca69d16f!2z0JDQvdCz0LDRgNGB0LosINCY0YDQutGD0YLRgdC60LDRjyDQvtCx0LsuLCDQoNC-0YHRgdC40Y8!5e1!3m2!1sru!2suk!4v1740490180718!5m2!1sru!2suk"
                        frameborder="0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>
            <!-- Контакты для связи -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Свяжитесь с нами</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="flex items-center space-x-2 text-sm sm:text-base text-gray-600">
                            <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 6 9-6"></path>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8"></path>
                            </svg>
                            <span>info@techstore.com</span>
                        </p>
                        <p class="flex items-center space-x-2 mt-2 text-sm sm:text-base text-gray-600">
                            <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M9 21V3m6 18V3"></path>
                            </svg>
                            <span>+7 (999) 123-45-67</span>
                        </p>
                    </div>
                    <div>
                        <form class="space-y-4">
                            <input type="text" placeholder="Ваше имя"
                                class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="email" placeholder="Ваш email"
                                class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <textarea placeholder="Ваше сообщение" rows="3"
                                class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            <button type="submit"
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm sm:text-base">Отправить</button>
                        </form>
                    </div>
                </div>
                <div class="flex justify-center space-x-6 mt-6">
                    <a
                        class="bg-blue-500 p-3 rounded-full flex items-center justify-center hover:bg-blue-600 transition-all">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22 12a10 10 0 10-11 9.95V15h-3v-3h3V9.5a3.5 3.5 0 017 0V12h3v3h-3v6.95A10 10 0 0022 12z" />
                        </svg>
                    </a>
                    <a
                        class="bg-blue-500 p-3 rounded-full flex items-center justify-center hover:bg-blue-600 transition-all">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 0h-14c-2.8 0-5 2.2-5 5v14c0 2.8 2.2 5 5 5h14c2.8 0 5-2.2 5-5v-14c0-2.8-2.2-5-5-5zm-7 19.7c-3.7 0-6.7-3-6.7-6.7s3-6.7 6.7-6.7 6.7 3 6.7 6.7-3 6.7-6.7 6.7zm7.4-10.3c-.6 0-1.2-.5-1.2-1.2s.5-1.2 1.2-1.2 1.2.5 1.2 1.2-.6 1.2-1.2 1.2zm-7.4 1c-2.6 0-4.7 2.1-4.7 4.7s2.1 4.7 4.7 4.7 4.7-2.1 4.7-4.7-2.1-4.7-4.7-4.7z" />
                        </svg>
                    </a>
                    <a
                        class="bg-blue-500 p-3 rounded-full flex items-center justify-center hover:bg-blue-600 transition-all">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23 3c-0.8 0.4-1.6 0.6-2.5 0.7C20.6 3.4 19.8 3 19 3c-1.7 0-3 1.3-3 3 0 0.2 0 0.5 0.1 0.7-2.5-0.1-4.7-1.3-6.2-3.1-0.3 0.5-0.5 1.1-0.5 1.8 0 1.3 0.7 2.5 1.8 3.2-0.6 0-1.1-0.2-1.6-0.4v0.1c0 1.7 1.2 3.2 2.8 3.5-0.3 0.1-0.7 0.2-1.1 0.2-0.3 0-0.6 0-0.9-0.1 0.6 1.9 2.3 3.3 4.3 3.3-1.6 1.2-3.7 1.9-5.9 1.9-0.4 0-0.8 0-1.2-0.1 2 1.3 4.4 2.1 7 2.1 8.4 0 13-7 13-13 0-0.2 0-0.5 0-0.7 1-0.7 1.8-1.6 2.4-2.6z" />
                        </svg>
                    </a>
                    <a
                        class="bg-blue-500 p-3 rounded-full flex items-center justify-center hover:bg-blue-600 transition-all">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4.9 3c1.3 0 2.4 1.1 2.4 2.4 0 1.3-1.1 2.4-2.4 2.4S2.5 6.3 2.5 5c0-1.3 1.1-2.4 2.4-2.4zM2.5 8h4.8v13h-4.8zm10.6 0h4.9v2.6h0.1c0.7-1.3 2.4-2.6 4.8-2.6 5.1 0 6 3.4 6 7.8v9.5h-4.8v-8.5c0-2.1-0.8-4.1-3.2-4.1-2.4 0-3.6 1.7-3.6 4.1v8.5h-4.8V8z" />
                        </svg>
                    </a>
                    <a
                        class="bg-blue-500 p-3 rounded-full flex items-center justify-center hover:bg-blue-600 transition-all">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.2c3.6 0 4.2 0.1 5.7 0.1 1.5 0 2.6 0.1 3.3 0.2 0.8 0.1 1.5 0.3 2.1 0.9 0.6 0.6 0.8 1.3 0.9 2.1 0.1 0.7 0.2 1.8 0.2 3.3 0 1.5-0.1 2.6-0.2 3.3-0.1 0.8-0.3 1.5-0.9 2.1-0.6 0.6-1.3 0.8-2.1 0.9-0.7 0.1-1.8 0.2-3.3 0.2-1.5 0-2.1 0-5.7 0-5.7s-4.2 0-5.7 0c-1.5 0-2.6 0-3.3-0.2-0.8-0.1-1.5-0.3-2.1-0.9-0.6-0.6-0.8-1.3-0.9-2.1-0.1-0.7-0.2-1.8-0.2-3.3 0-1.5 0.1-2.6 0.2-3.3 0.1-0.8 0.3-1.5 0.9-2.1 0.6-0.6 1.3-0.8 2.1-0.9 0.7-0.1 1.8-0.2 3.3-0.2 1.5 0 2.1-0.1 5.7-0.1zM12 5.9c-3.4 0-6.1 2.8-6.1 6.1 0 3.4 2.8 6.1 6.1 6.1 3.4 0 6.1-2.8 6.1-6.1 0-3.4-2.8-6.1-6.1-6.1zm0 9.5c-1.9 0-3.4-1.5-3.4-3.4 0-1.9 1.5-3.4 3.4-3.4 1.9 0 3.4 1.5 3.4 3.4 0 1.9-1.5 3.4-3.4 3.4z" />
                        </svg>
                    </a>
                </div>

            </section>
            <!-- Отзывы клиентов -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Отзывы клиентов</h2>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Отличный магазин! Быстрая доставка и
                                    качественный товар."</p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Анна С.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Понравился подход к клиенту, помогли
                                    выбрать ноутбук для работы."</p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Дмитрий К.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Выбор отличной техники! Приятно
                                    удивлён качеством обслуживания." </p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Ольга Т.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Отличный магазин с хорошими ценами!
                                    Рекомендую всем."</p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Владимир К.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Никогда не ошибусь, выбрав TechStore!
                                    Просто лучшие предложения на рынке."</p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Ирина А.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Прекрасное обслуживание, всегда на
                                    связи и готовы помочь с выбором."</p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Денис И.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Очень рад, что нашёл этот магазин.
                                    Всё быстро, удобно и с гарантией!"</p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Евгения Ф.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Приятно удивлён качеством техники и
                                    доставкой. Обязательно вернусь!"</p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Игорь Б.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Замечательный магазин! Работают
                                    быстро, цены радуют, а качество на высоте!"</p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Татьяна Д.</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <p class="text-gray-600 text-sm sm:text-base italic">"Заказал технику для бизнеса — всё
                                    доставили вовремя, спасибо за помощь!"</p>
                                <p class="mt-2 text-blue-900 font-semibold text-sm">Максим О.</p>
                            </div>
                        </div>
                    </div>
            </section>

            <script>
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    autoplay: {
                        delay: 2000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        type: 'none',
                    },
                    loop: true,
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                        },
                        768: {
                            slidesPerView: 2,
                        },
                    },
                });
            </script>

            <!-- Стиль -->
            <style>
                .swiper-container {
                    position: relative;
                    overflow: hidden;
                }

                .swiper-wrapper {
                    display: flex;
                }

                .swiper-slide {
                    width: 100%;
                }
            </style>

            <!-- Дополнительные способы связи -->
            <section class="mb-12 text-center">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Другие способы связи</h2>
                <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                    <a
                        class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-sm sm:text-base">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 0C5.373 0 0 5.373 0 12c0 2.137.578 4.246 1.672 6.082L0 24l5.918-1.672A11.955 11.955 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.936 9.936 0 01-5.073-1.41l-.364-.218-3.51.993.993-3.51-.218-.364a9.936 9.936 0 01-1.41-5.073c0-5.5 4.482-10 10-10s10 4.482 10 10-4.482 10-10 10zm5.455-7.273c-.3-.15-1.782-.882-2.06-.983-.273-.1-.473-.15-.673.15-.2.3-.782.983-.955 1.182-.173.2-.346.2-.645.05-.3-.15-1.255-.582-2.41-1.855-.91-.982-1.528-2.21-1.703-2.51-.173-.3-.018-.46.128-.61.136-.136.3-.346.455-.527.15-.182.2-.31.3-.51.1-.2.05-.373-.05-.573-.1-.2-.673-1.632-.927-2.232-.246-.582-.491-.5-.673-.51-.173-.01-.373-.01-.573-.01s-.527.15-.8.373c-.273.223-1.055.982-1.055 2.41s.764 2.81 873 3.182c.1.373 1.41 2.91 3.455 3.182 2.045.273 2.045-.182 2.41-.364.364-.182 1.455-.727 1.655-1.427.2-.7.2-1.31.1-1.455-.1-.146-.3-.227-.6-.377z" />
                        </svg>
                        WhatsApp
                    </a>
                    <a
                        class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm sm:text-base">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.563 7.582l-1.91 9.01c-.14.655-.536.82-.91.51l-2.727-2.01-1.31 1.264c-.145.14-.27.255-.546.255l.2-2.764 5.01-4.51c.218-.2-.05-.31-.336-.11l-6.182 3.91-2.655-.91c-.59-.2-.6-.6.123-.89l10.364-4c.5-.182.91.11.873.255z" />
                        </svg>
                        Telegram
                    </a>
                    <a class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm sm:text-base"
                        target="_blank" rel="noopener noreferrer">
                        <span class="font-bold text-xl mr-2">ВК</span>
                        ВКонтакте
                    </a>
                </div>
            </section>
            <!-- Часто задаваемые вопросы (FAQ) -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Часто задаваемые вопросы</h2>
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-blue-900">Как быстро вы доставляете заказы?</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Доставка по Ангарску – в течение 1-2 дней, по России
                            –
                            от 3 до 7 дней в зависимости от региона.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-blue-900">Можно ли вернуть товар?</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Да, вы можете вернуть товар в течение 14 дней при
                            сохранении товарного вида и упаковки.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-blue-900">Какие способы оплаты вы принимаете?</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Мы принимаем оплату картами Visa, MasterCard, а также
                            через электронные кошельки и наложенный платеж.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-blue-900">Можно ли изменить или отменить заказ?</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Да, вы можете изменить или отменить заказ в течение 2
                            часов после оформления, обратившись в нашу службу поддержки.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-blue-900">Какие гарантии на товар?</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Все товары, представленные в нашем магазине, имеют
                            гарантию от производителей сроком от 6 месяцев до 2 лет.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-blue-900">Как отслеживать статус заказа?</h3>
                        <p class="text-gray-600 text-sm sm:text-base">После отправки товара вы получите номер для
                            отслеживания на указанный e-mail или телефон, с помощью которого можно отслеживать статус
                            доставки.</p>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection
