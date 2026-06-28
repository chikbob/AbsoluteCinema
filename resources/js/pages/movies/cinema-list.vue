<template>
    <PageLayout>
        <div class="p-6 max-w-6xl mx-auto" style="height: 100dvh">
            <h1 class="text-[52px] font-bold mb-6 text-center">{{ movie.title }}</h1>
            <p class="text-[30px] text-center text-[#888AA5] mb-6">Оберіть кінотеатр:</p>

            <div class="grid grid-cols-3 sm:grid-cols-3 gap-6 mt-[70px]">
                <div v-for="cinema in cinemas" :key="cinema.id"  style="flex-direction: column; justify-content: center; align-items: center" class="flex bg-[#EFF0FF] rounded-lg shadow-lg p-4">
                    <h2 class="flex justify-center text-[30px] text-[#16161C] font-semibold text-center" style="align-items: center; line-height: 36px; height: 84px;">{{ cinema.name }}</h2>
                    <p class="text-gray-500 text-sm">{{ cinema.address }}</p>
                    <button
                        @click="goToSessions(cinema.id)"
                        class="flex justify-center w-[200px] mt-4 bg-[#5075D5] text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                    >
                        Обрати
                    </button>
                </div>
            </div>
        </div>
    </PageLayout>
</template>

<script setup>
import {defineProps, defineEmits} from 'vue';
import PageLayout from "@/Layouts/page-layout/page-layout.vue";

const props = defineProps({
    movie: Object,
    cinemas: Array
});

const emit = defineEmits();
const goToSessions = (cinemaId) => {
    window.location.href = `/cinemas/${cinemaId}/sessions`;
};
</script>
