<template>
    <PageLayout>
        <div class="pt-[56px] max-w-6xl mx-auto px-4">
            <h1 class="text-[52px] font-bold mb-6 text-center">{{ cinema.name }}</h1>
            <p class="text-[30px] text-center text-[#888AA5] mb-[48px]">Оберіть сеанс:</p>

            <div v-for="(sessions, date) in groupedSessions" :key="date" class="mb-10">
                <h2 class="text-2xl font-bold mb-6">{{ formatDate(date) }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div v-for="session in sessions" :key="session.id"
                         class="bg-white rounded-lg shadow-lg p-4 hover:shadow-xl transition-shadow"
                         style="border-radius: 20px;">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-[26px] text-[#16161C] font-semibold" style="font-weight: 800;">
                                    {{ formatTime(session.date_time) }}</h3>
                                <p class="text-[#888AA5] text-[18px] mt-1">Зал: {{ session.hall.name }}</p>
                            </div>
                            <button
                                @click="goToSeats(session.id)"
                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm"
                                style="border-radius: 8px;"
                            >
                                Обрати
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PageLayout>
</template>

<script setup>
import {defineProps, computed} from 'vue';
import PageLayout from "@/Layouts/page-layout/page-layout.vue";

const props = defineProps({
    cinema: Object,
    sessions: Array
});

// Функція для отримання ключа дати (без часу)
const getDateKey = (dateTime) => {
    const date = new Date(dateTime);
    return date.toISOString().split('T')[0]; // YYYY-MM-DD
};

// Групування та сортування сеансів
const groupedSessions = computed(() => {
    const groups = {};

    const sorted = [...props.sessions].sort((a, b) => {
        return new Date(a.date_time) - new Date(b.date_time);
    });

    sorted.forEach(session => {
        const dateKey = getDateKey(session.date_time);
        if (!groups[dateKey]) {
            groups[dateKey] = [];
        }
        groups[dateKey].push(session);
    });

    return groups;
});

// Форматування дати з днем тижня
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const options = {
        weekday: 'short',
        day: 'numeric',
        month: 'long'
    };
    return date.toLocaleDateString('uk-UA', options);
};

// Форматування часу
const formatTime = (dateTime) => {
    const date = new Date(dateTime);
    return date.toLocaleTimeString('uk-UA', {
        hour: '2-digit',
        minute: '2-digit'
    });
};

// Перехід до вибору місць
const goToSeats = (sessionId) => {
    window.location.href = `/sessions/${sessionId}/seats`;
};
</script>

<style scoped>
@media (max-width: 767px) {
    .grid {
        grid-template-columns: 1fr;
    }
}

@media (min-width: 768px) and (max-width: 1023px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
</style>
