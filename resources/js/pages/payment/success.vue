<template>
    <PageLayout>
        <div class="success-wrapper">
            <div class="success-box">
                <h1 class="text-2xl font-bold text-green-400 mb-4">✅ Квиток успішно створено!</h1>

                <div v-if="ticket" class="ticket-details">
                    <h3 class="text-xl font-semibold text-white mb-2">Деталі квитка #{{ ticket.id }}</h3>
                    <p>Клієнт: {{ ticket.customer_name }}</p>
                    <p>Фільм: {{ ticket.session?.movie?.title || 'Не вказано' }}</p>
                    <p v-if="ticket.session?.hall">Зал: {{ ticket.session.hall.name }}</p>
                    <p v-if="ticket.session?.date_time">Дата і час: {{
                            formatDateTime(ticket.session.date_time)
                        }}</p>
                    <p>Придбано місць: {{ ticket.seats.length }}</p>
                    <p>Разом: {{ formattedTotalPrice }} грн.</p>

                    <div v-if="ticket.seats.length" class="seats-box mt-4">
                        <h4 class="font-semibold mb-2 text-white">Місця:</h4>
                        <ul>
                            <li v-for="seat in sortedSeats" :key="seat.id">
                                Ряд {{ seat.row_number }}, місце {{ seat.seat_number }} —
                                {{ formatPrice(seat.pivot.price) }} грн.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="actions">
                    <a :href="route('tickets.download', ticket.id)" class="btn bg-blue-600 hover:bg-blue-500"
                       target="_blank">
                        📄 Завантажити PDF
                    </a>
                    <a href="/" class="btn bg-green-600 hover:bg-green-500">
                        ⬅️ Повернутися на головну
                    </a>
                </div>
            </div>
        </div>
    </PageLayout>
</template>

<script setup>
import {onMounted, computed} from 'vue';
import {usePage} from '@inertiajs/vue3';
import PageLayout from "@/Layouts/page-layout/page-layout.vue";

const page = usePage();

const ticket = computed(() => page.props.ticket || null);

const formatDateTime = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleString('uk-UA', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const sortedSeats = computed(() => {
    if (!ticket.value?.seats) return [];
    return [...ticket.value.seats].sort((a, b) => {
        if (a.row_number !== b.row_number) return a.row_number - b.row_number;
        return a.seat_number - b.seat_number;
    });
});

const formattedTotalPrice = computed(() => {
    if (!ticket.value?.total_price) return '0.00';
    return parseFloat(ticket.value.total_price).toFixed(2);
});

const formatPrice = (price) => parseFloat(price).toFixed(2);

onMounted(() => {
    if (ticket.value) {
        const link = document.createElement('a');
        link.href = route('tickets.download', ticket.value.id);
        link.download = `ticket-${ticket.value.id}.pdf`;
        link.target = '_blank';
        link.click();
    }
});
</script>

<style scoped>
.success-wrapper {
    display: flex;
    justify-content: center;
    padding: 2rem;
    min-height: 100vh;
}

.success-box {
    background-color: #1f1f1f;
    border-radius: 16px;
    padding: 2rem;
    max-width: 700px;
    width: 100%;
    color: #ddd;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
}

.ticket-details p {
    margin: 0.25rem 0;
}

.seats-box {
    background-color: #2b2b2b;
    padding: 1rem;
    border-radius: 10px;
}

.seats-box ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.seats-box li {
    padding: 0.3rem 0;
    border-bottom: 1px solid #444;
}

.seats-box li:last-child {
    border-bottom: none;
}

.actions {
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
}
</style>
