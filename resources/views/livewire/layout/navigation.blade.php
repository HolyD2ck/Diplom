<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>


<nav x-data="{ open: false }"
    class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-md fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}" wire:navigate>
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-6">
                <!-- Каталог -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center text-sm text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-400 transition duration-200 ease-in-out">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    Каталог
                </a>

                <!-- Контакты -->
                <a href="{{ route('contacts') }}"
                    class="flex items-center text-sm text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-400 transition duration-200 ease-in-out">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    Контакты
                </a>

                <!-- О нас -->
                <a href="{{ route('about') }}"
                    class="flex items-center text-sm text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-400 transition duration-200 ease-in-out">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    О нас
                </a>

                <!-- Наши работники -->
                <a href="{{ route('workers') }}"
                    class="flex items-center text-sm text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-400 transition duration-200 ease-in-out">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Наши работники
                </a>

                <!-- Наши партнеры -->
                <a href="{{ route('partners') }}"
                    class="flex items-center text-sm text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-400 transition duration-200 ease-in-out">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    Наши партнеры
                </a>

                <!-- Корзина -->
                <a href="{{ route('cart') }}"
                    class="relative flex items-center text-sm text-gray-500 hover:text-gray-700 transition duration-200">

                    @if ($cartCount > 0)
                        <span
                            class="absolute -top-3 -left-2 bg-green-500 text-white text-[12px] font-bold w-5 h-5 flex items-center justify-center rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <span class="ml-1">Корзина</span>

                </a>
            </div>

            <!-- Authentication Links (Desktop) -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name"></div>
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @if (auth()->user()->role == 'admin')
                                <a href="/admin"
                                    class="block px-4 py-2 text-orange-600 hover:bg-orange-100 dark:hover:bg-orange-700 rounded-md text-sm font-semibold">
                                    Перейти в панель администратора
                                </a>
                            @endif
                            <button wire:click="logout" class="w-full text-left">
                                <x-dropdown-link
                                    class="text-red-600 hover:text-red-800 font-semibold">{{ __('Выйти') }}</x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Войти
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Зарегистрироваться
                    </a>
                @endauth
            </div>

            <!-- Hamburger Icon (Mobile) -->
            <div class="flex md:hidden">
                <button @click="open = !open"
                    class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-600">
        <div class="px-4 py-2 space-y-2">
            <!-- Navigation Links -->
            <a href="{{ route('dashboard') }}" wire:navigate
                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm">
                Каталог
            </a>
            <a href="{{ route('contacts') }}"
                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm">
                Контакты
            </a>
            <a href="{{ route('about') }}"
                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm">
                О нас
            </a>
            <a href="{{ route('workers') }}"
                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm">
                Наши работники
            </a>
            <a href="{{ route('partners') }}"
                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm">
                Наши партнеры
            </a>
            <a href="{{ route('cart') }}"
                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm">
                Корзина
            </a>

            <!-- Authentication Links -->
            @auth
                <div class="pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <div class="px-4">
                        <div class="font-medium text-sm text-gray-800 dark:text-gray-200" x-data="{ name: '{{ auth()->user()->name }}' }"
                            x-text="name"></div>
                        <div class="font-medium text-xs text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                    <div class="mt-2 space-y-1">
                        @if (auth()->user()->role == 'admin')
                            <a href="/admin"
                                class="block px-4 py-2 text-orange-600 hover:bg-orange-100 dark:hover:bg-orange-700 rounded-md text-sm font-semibold">
                                Перейти в панель администратора
                            </a>
                        @endif
                        <button wire:click="logout" class="w-full text-left">
                            <span
                                class="block px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-700 rounded-md text-sm font-semibold">
                                Выйти
                            </span>
                        </button>
                    </div>
                </div>
            @else
                <div class="pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('login') }}" wire:navigate
                            class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm">
                            Войти
                        </a>
                        <a href="{{ route('register') }}" wire:navigate
                            class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm">
                            Зарегистрироваться
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
