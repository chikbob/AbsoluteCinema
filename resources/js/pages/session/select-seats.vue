<template>
    <PageLayout>
        <div class="flex min-h-screen items-start justify-center gap-6 px-6 py-10 text-white">
            <!-- Ліва частина: вибір місць -->
            <div class="bg-[#2E2E3A] rounded-2xl p-6 flex flex-col items-center w-full max-w-3xl">
                <h2 class="text-white font-bold text-lg mb-4 self-start">Оберіть місця</h2>
                <div class="space-y-4">
                    <div
                        v-for="(row, rowIndex) in sortedSeats"
                        :key="rowIndex"
                        class="flex justify-center gap-4"
                    >
                        <div
                            v-for="seat in row"
                            :key="seat.id"
                            :class="[
                                'w-10 h-10 flex items-center justify-center rounded-full font-bold cursor-pointer transition-colors duration-200',
                                seat.status === 'available' ? 'bg-green-400' : '',
                                seat.status === 'unavailable' ? 'bg-gray-500 pointer-events-none' : '',
                                seat.status === 'sold' ? 'bg-red-500' : '',
                                seat.status === 'reserved' ? 'bg-yellow-400' : '',
                                isSelected(seat) ? 'bg-indigo-500 text-white' : '',
                            ]"
                            @click="toggleSeatSelection(seat)"
                        >
                            {{ seat.seat_number }}
                        </div>
                    </div>
                </div>

                <!-- Легенда -->
                <div class="flex flex-wrap justify-center gap-6 mt-10">
                    <LegendItem color="bg-green-400" label="Доступно"/>
                    <LegendItem color="bg-gray-500" label="Недоступно"/>
                    <LegendItem color="bg-red-500" label="Продано"/>
                    <LegendItem color="bg-yellow-400" label="Заброньовано"/>
                    <LegendItem color="bg-indigo-500" label="Обрано"/>
                </div>
            </div>

            <!-- Права частина: вибрані місця -->
            <div class="bg-[#2E2E3A] rounded-2xl p-6 w-full max-w-sm">
                <h2 class="text-white font-bold text-lg mb-4">Обрані місця</h2>
                <ul class="space-y-2 mb-4">
                    <li v-for="seat in selectedSeats" :key="seat.id" class="flex justify-between">
                        <span>Ряд {{ seat.row_number }}, Місце {{ seat.seat_number }}</span>
                        <span>{{ seat.price }} грн</span>
                    </li>
                </ul>
                <div class="font-bold mb-4 flex justify-between">
                    <span>Сума</span>
                    <span>{{ totalPrice }} грн</span>
                </div>
                <button
                    @click="goToPayment"
                    class="w-full text-white bg-indigo-500 hover:bg-indigo-600 transition rounded-lg py-3 font-semibold text-center"
                >
                    Перейти до оплати
                </button>
            </div>
        </div>
    </PageLayout>
</template>

<script setup>
import {ref, computed, defineProps} from 'vue';
import {router} from '@inertiajs/vue3';
import PageLayout from '@/Layouts/page-layout/page-layout.vue';
import LegendItem from "@/Components/LegendItem.vue";

const props = defineProps({
    session: Object,
    seats: Array,
});

const sortedSeats = computed(() => {
    const rows = {};
    props.seats.forEach(seat => {
        if (!rows[seat.row_number]) rows[seat.row_number] = [];
        rows[seat.row_number].push(seat);
    });
    Object.values(rows).forEach(row => row.sort((a, b) => a.seat_number - b.seat_number));
    return Object.values(rows);
});

const selectedSeats = ref([]);

const isSelected = (seat) => selectedSeats.value.some(s => s.id === seat.id);

const toggleSeatSelection = (seat) => {
    if (seat.status !== 'available') return;
    const idx = selectedSeats.value.findIndex(s => s.id === seat.id);
    if (idx === -1) selectedSeats.value.push({...seat});
    else selectedSeats.value.splice(idx, 1);
};

const totalPrice = computed(() =>
    parseFloat(
        selectedSeats.value.reduce((acc, seat) => acc + parseFloat(seat.price || 0), 0).toFixed(2)
    )
);

const goToPayment = () => {
    router.visit('/payment', {
        method: 'get',
        data: {
            selectedSeats: selectedSeats.value,
            totalPrice: totalPrice.value,
            session_id: props.session.id
        }
    });
};
</script>

<style scoped>
/* Усі стилі покриває Tailwind */
</style>
