<template>
    <header class="w-full bg-transparent flex justify-center">
        <div class="w-full max-w-[1320px] flex justify-between items-center px-6 sm:px-6 lg:px-8">
            <!-- Ліва частина: Логотип -->
            <div class="flex items-center gap-2 bg-[#2E2E3A] px-14 py-4 rounded-b-full shadow-md">
                <img src="/icons/film-icon.png" alt="Логотип" class="w-6 h-6"/>
                <span class="text-xl font-bold text-white">AbsoluteCinema</span>
            </div>

            <!-- Права частина: Навігація -->
            <nav
                class="flex items-center gap-8 text-lg font-semibold bg-[#2E2E3A] text-white px-14 py-4 rounded-b-full shadow-md">
                <a href="/" class="hover:text-gray-300">Головна</a>
                <a href="/movies" class="hover:text-gray-300">Список фільмів</a>
                <a href="/contacts" class="hover:text-gray-300">Контакти</a>
            </nav>
        </div>
    </header>
</template>
