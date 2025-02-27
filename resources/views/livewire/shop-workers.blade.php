<div class="bg-gray-100 min-h-screen pt-16"> <!-- Отступ для фиксированной шапки -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Заголовок и вводный блок -->
        <section class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-blue-900">Команда TechStore</h1>
            <p class="mt-2 text-lg sm:text-xl text-gray-700">Познакомьтесь с нашей командой и узнайте, как стать частью
                TechStore!</p>
            <div class="mt-4 w-full h-48 sm:h-64 bg-cover bg-center rounded-lg shadow-md"
                style="background-image: url({{ asset('img/workers.jpg') }});">
            </div>
        </section>

        <!-- Наши сотрудники -->
        <section
            class="rounded-lg text-center mb-12 bg-blue-100 py-12 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-semibold text-blue-900 mb-8">Наши сотрудники</h2>

                <!-- Сетка сотрудников -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($employees as $employee)
                        <div
                            class="bg-white p-4 rounded-lg shadow-md text-center hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">{{ $employee->имя }}
                                {{ $employee->фамилия }}</h3>
                            <p class="text-gray-600 text-sm mb-2">{{ $employee->должность }}</p>
                            <div class="border-t border-gray-200 pt-2">
                                <p class="text-gray-500 text-xs">
                                    <span class="font-semibold text-blue-700">Телефон:</span>
                                    {{ $employee->телефон }}
                                </p>
                                <p class="text-gray-500 text-xs mt-1">
                                    <span class="font-semibold text-blue-700">Email:</span>
                                    {{ $employee->электронная_почта }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Как устроиться к нам -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-blue-900 mb-4">Как устроиться к нам?</h2>
            <p class="text-gray-600 text-sm sm:text-base mb-4">
                Мы всегда рады новым талантам! Отправьте резюме через форму ниже, и наш HR-отдел свяжется с вами.
                Процесс: резюме → собеседование → стажировка → трудоустройство.
            </p>
            <!-- Вакансии -->
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Доступные вакансии</h3>
                <ul class="list-disc list-inside text-gray-600 text-sm sm:text-base">
                    <li>Менеджер по продажам (з/п от 50,000 ₽)</li>
                    <li>Специалист по логистике (з/п от 45,000 ₽)</li>
                    <li>Технический консультант (з/п от 55,000 ₽)</li>
                </ul>
            </div>
            <!-- Форма подачи резюме -->
            <div class="relative bg-white p-4 sm:p-6 rounded-lg shadow-md">
                <!-- Уведомление -->
                <div id="successMessage"
                    class="absolute top-2 right-2 bg-green-600 text-white px-6 py-3 rounded-lg text-sm font-semibold shadow-lg hidden">
                    Ваше резюме принято к рассмотрению!
                </div>

                <form class="space-y-4" id="resumeForm">
                    <input type="text" placeholder="Ваше имя"
                        class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="name">
                    <input type="email" placeholder="Ваш email"
                        class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="email">
                    <input type="text" placeholder="Желаемая должность"
                        class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="position">
                    <textarea placeholder="О себе и опыт работы" rows="4"
                        class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" id="about"></textarea>
                    <button type="submit"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm sm:text-base">
                        Отправить резюме
                    </button>
                </form>
            </div>

            <script>
                document.getElementById('resumeForm').addEventListener('submit', function(event) {
                    event.preventDefault();

                    const successMessage = document.getElementById('successMessage');
                    successMessage.classList.remove('hidden');

                    document.getElementById('resumeForm').reset();

                    setTimeout(function() {
                        successMessage.classList.add('hidden');
                    }, 3000);
                });
            </script>



        </section>

        <!-- Преимущества работы у нас -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-blue-900 mb-4">Преимущества работы у нас</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Условия</h3>
                    <ul class="list-disc list-inside text-gray-600 text-sm sm:text-base">
                        <li>Гибкий график (5/2 или 2/2)</li>
                        <li>Соцпакет (ДМС, отпуск)</li>
                        <li>Карьерный рост</li>
                    </ul>
                </div>
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Отзывы сотрудников</h3>
                    <p class="text-gray-600 text-sm sm:text-base italic">"Отличный коллектив и поддержка!"</p>
                    <p class="text-blue-900 font-semibold text-sm mt-2">Алексей, логист</p>
                </div>
            </div>
        </section>

        <!-- ЧаВо (FAQ) -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-blue-900 mb-4">Часто задаваемые вопросы</h2>
            <div class="space-y-4">
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-blue-900">Нужен ли опыт работы?</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Для некоторых позиций опыт не требуется, мы обучаем
                        новичков.</p>
                </div>
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-blue-900">Как подать резюме?</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Заполните форму выше или отправьте на hr@techstore.com
                    </p>
                </div>
            </div>
        </section>

        <!-- Контактный блок -->
        <section class="mb-12 text-center">
            <h2 class="text-2xl font-semibold text-blue-900 mb-4">Связаться с HR</h2>
            <p class="text-gray-600 text-sm sm:text-base mb-4">Пишите или звоните нашему HR-отделу:</p>
            <p class="text-blue-900 font-semibold text-sm sm:text-base">hr@techstore.com | +7 (999) 876-54-32</p>
            <div class="flex justify-center gap-4 mt-4">
                <a href="https://wa.me/79998765432" class="text-blue-300 hover:text-blue-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 0C5.373 0 0 5.373 0 12c0 2.137.578 4.246 1.672 6.082L0 24l5.918-1.672A11.955 11.955 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.936 9.936 0 01-5.073-1.41l-.364-.218-3.51.993.993-3.51-.218-.364a9.936 9.936 0 01-1.41-5.073c0-5.5 4.482-10 10-10s10 4.482 10 10-4.482 10-10 10zm5.455-7.273c-.3-.15-1.782-.882-2.06-.983-.273-.1-.473-.15-.673.15-.2.3-.782.983-.955 1.182-.173.2-.346.2-.645.05-.3-.15-1.255-.582-2.41-1.855-.91-.982-1.528-2.21-1.703-2.51-.173-.3-.018-.46.128-.61.136-.136.3-.346.455-.527.15-.182.2-.31.3-.51.1-.2.05-.373-.05-.573-.1-.2-.673-1.632-.927-2.232-.246-.582-.491-.5-.673-.51-.173-.01-.373-.01-.573-.01s-.527.15-.8.373c-.273.223-1.055.982-1.055 2.41s.764 2.81 873 3.182c.1.373 1.41 2.91 3.455 3.182 2.045.273 2.045-.182 2.41-.364.364-.182 1.455-.727 1.655-1.427.2-.7.2-1.31.1-1.455-.1-.146-.3-.227-.6-.377z" />
                    </svg>
                </a>
                <a href="https://t.me/techstore_hr" class="text-blue-300 hover:text-blue-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.563 7.582l-1.91 9.01c-.14.655-.536.82-.91.51l-2.727-2.01-1.31 1.264c-.145.14-.27.255-.546.255l.2-2.764 5.01-4.51c.218-.2-.05-.31-.336-.11l-6.182 3.91-2.655-.91c-.59-.2-.6-.6.123-.89l10.364-4c.5-.182.91.11.873.255z" />
                    </svg>
                </a>
            </div>
        </section>
    </div>
</div>
