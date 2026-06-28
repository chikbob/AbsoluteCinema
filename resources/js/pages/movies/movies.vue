<template>
    <PageLayout>
        <div class="p-6 max-w-5xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div
                    v-for="movie in props.movies"
                    :key="movie.id"
                    class="bg-[#30303D] rounded-lg shadow-lg p-4 hover:shadow-2xl transition duration-300 flex flex-col h-full"
                >
                    <a :href="`/movies/${movie.id}/cinemas`">
                        <img
                            :src="movie.poster_url"
                            :alt="movie.title"
                            class="w-full object-cover rounded-lg hover:opacity-80 transition duration-300"
                        >
                    </a>
                    <div class="mt-4 flex flex-col flex-grow">
                        <a :href="`/movies/${movie.id}/cinemas`" class="text-xl font-semibold hover:text-blue-500">
                            {{ movie.title }}
                        </a>
                        <p class="text-[#888AA5] text-sm">Рік: {{ movie.release_year }}</p>
                        <p class="text-[#888AA5] text-sm">Тривалість: {{ movie.duration }} хв</p>
                        <p class="mt-2 line-clamp-3 flex-grow">{{ movie.description }}</p>
                        <a
                            :href="`/movies/${movie.id}/cinemas`"
                            class="w-full flex justify-center mt-3 bg-[#6161FC] text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300"
                        >
                            Дивитися у кінотеатрах
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </PageLayout>
</template>

<script setup>
import PageLayout from "@/Layouts/page-layout/page-layout.vue";

const props = defineProps({
    movies: Object
});
</script>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
