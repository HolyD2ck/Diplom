@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-blue-100 dark:bg-gray-900 min-h-screen py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Заголовок -->
                    <h1 class="text-2xl sm:text-3xl font-semibold text-blue-900 mb-6">Профиль пользователя
                        {{ auth()->user()->name }}
                    </h1>

                    <!-- Основная сетка -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Левая колонка -->
                        <div class="space-y-6">
                            <!-- Информация о профиле -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Личная информация</h2>
                                <livewire:profile.update-profile-information-form />
                            </div>

                            <!-- История заказов -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4"></h2>
                                <livewire:user-profile />
                            </div>
                        </div>

                        <!-- Правая колонка -->
                        <div class="space-y-6">
                            <!-- Безопасность -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Безопасность</h2>
                                <livewire:profile.update-password-form />
                            </div>

                            <!-- Удаление аккаунта -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Удаление аккаунта</h2>
                                <livewire:profile.delete-user-form />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </div>
</div>
