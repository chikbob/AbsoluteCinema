<template>
    <PageLayout>
        <div class="flex flex-col items-center min-h-screen bg-[#16151C] py-10 px-4">
            <div class="flex flex-col lg:flex-row gap-6 w-full max-w-6xl">

                <!-- Блок резюме замовлення -->
                <div class="bg-[#222129] rounded-2xl shadow-md p-6 flex-1 text-white">
                    <h2 class="text-lg font-bold mb-4">Резюме замовлення</h2>

                    <div class="flex gap-4 mb-4">
                        <img
                            :src="page.props.movie?.poster_url || 'https://via.placeholder.com/80x100'"
                            alt="Постер"
                            class="w-20 h-28 rounded-lg object-cover"
                        />
                        <div class="flex flex-col justify-between">
                            <div>
                                <p class="font-semibold text-base">{{
                                        page.props.movie?.title || 'Назва фільму'
                                    }}</p>
                                <p class="text-sm text-gray-400">Кінотеатр: {{ page.props.cinema?.name }}</p>
                                <p class="text-sm text-gray-400">Сеанс: {{ page.props.session?.time }}
                                    {{ page.props.session?.date }}</p>
                                <p class="text-sm text-gray-400">Зал: {{ page.props.hall?.name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-sm text-gray-300 mb-4">
                        <span class="font-semibold text-white">Місця:</span>
                        <ul class="list-none mt-1 ml-2">
                            <li v-for="seat in formattedSeats" :key="seat.id">
                                Ряд {{ seat.row_number }}, місце {{ seat.seat_number }}
                            </li>
                        </ul>
                    </div>

                    <p class="mt-4 font-semibold text-white text-lg">
                        Сума оплати: <span class="text-white">{{ totalPrice.toFixed(2) }} грн.</span>
                    </p>
                </div>

                <!-- Блок оплати -->
                <div class="bg-[#222129] rounded-2xl shadow-md p-6 flex-1 text-white">
                    <h2 class="text-lg font-bold mb-4">Деталі оплати</h2>

                    <form @submit.prevent="processPayment" class="flex flex-col gap-4">
                        <div>
                            <label class="text-sm text-gray-300">ПІБ</label>
                            <input
                                v-model="customerName"
                                type="text"
                                class="bg-[#2B2A33] text-white rounded-md px-4 py-2 w-full focus:outline-none"
                                placeholder="Іваненко Іван Іванович"
                                required
                            />
                        </div>

                        <div>
                            <label class="text-sm text-gray-300">Електронна пошта</label>
                            <input
                                v-model="customerEmail"
                                type="email"
                                class="bg-[#2B2A33] text-white rounded-md px-4 py-2 w-full focus:outline-none"
                                placeholder="example@email.com"
                                required
                            />
                        </div>

                        <div>
                            <label class="text-sm text-gray-300">Номер картки</label>
                            <input
                                v-model="cardNumber"
                                type="text"
                                maxlength="19"
                                @input="formatCardNumber"
                                class="bg-[#2B2A33] text-white rounded-md px-4 py-2 w-full focus:outline-none"
                                placeholder="1234 5678 9012 3456"
                                required
                            />
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="text-sm text-gray-300">Місяць/Рік</label>
                                <input
                                    v-model="expiryDate"
                                    type="text"
                                    maxlength="5"
                                    @input="formatExpiryDate"
                                    class="bg-[#2B2A33] text-white rounded-md px-4 py-2 w-full focus:outline-none"
                                    placeholder="MM/YY"
                                    required
                                />
                            </div>
                            <div class="flex-1">
                                <label class="text-sm text-gray-300">CVV</label>
                                <input
                                    v-model="cvv"
                                    type="text"
                                    maxlength="3"
                                    class="bg-[#2B2A33] text-white rounded-md px-4 py-2 w-full focus:outline-none"
                                    placeholder="123"
                                    required
                                />
                            </div>
                        </div>

                        <button type="submit"
                                class="bg-indigo-500 hover:bg-indigo-600 text-white py-3 rounded-lg font-semibold transition-all mt-2">
                            Оплатити
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </PageLayout>
</template>

<script setup>
import {ref, computed} from 'vue';
import {useForm, usePage} from '@inertiajs/vue3';
import PageLayout from "@/Layouts/page-layout/page-layout.vue";
import Swal from 'sweetalert2'

const page = usePage();
const rawSeats = ref(page.props.selectedSeats || []);
const sessionId = ref(page.props.session_id || null);

const customerName = ref('');
const customerEmail = ref('');
const cardNumber = ref('');
const expiryDate = ref('');
const cvv = ref('');

// Перетворення структури місць
const formattedSeats = computed(() => {
    const seats = [];
    let tempSeat = {};

    rawSeats.value.forEach(item => {
        const key = Object.keys(item)[0];
        const value = item[key];
        tempSeat[key] = value;

        if (tempSeat.id && tempSeat.seat_number && tempSeat.row_number && tempSeat.price) {
            seats.push({...tempSeat});
            tempSeat = {};
        }
    });

    return seats;
});

const totalPrice = computed(() => {
    const total = formattedSeats.value.reduce((sum, seat) => {
        const price = parseFloat(seat.price);
        return !isNaN(price) ? sum + price : sum;
    }, 0);
    return parseFloat(total.toFixed(2));
});

const form = useForm({
    name: '',
    email: '',
    session_id: sessionId.value,
    seats: formattedSeats.value,
    total: totalPrice.value,
});

const formatCardNumber = () => {
    cardNumber.value = cardNumber.value.replace(/\D/g, '')
        .replace(/(.{4})/g, '$1 ')
        .trim();
};

const formatExpiryDate = () => {
    expiryDate.value = expiryDate.value.replace(/\D/g, '')
        .replace(/^(\d{2})(\d{0,2})/, '$1/$2')
        .trim();
};

const processPayment = () => {
    const roundedSeats = formattedSeats.value.map(seat => ({
        ...seat,
        price: Math.round(seat.price * 100) / 100,
    }));

    const roundedTotal = Math.round(totalPrice.value * 100) / 100;

    form.name = customerName.value;
    form.email = customerEmail.value;
    form.session_id = sessionId.value;
    form.seats = roundedSeats;
    form.total = roundedTotal;

    form.post(route('payment.process'), {
        preserveScroll: true,
        onSuccess: () => {
            Swal.fire({
                title: "Квиток успішно створено!",
                icon: "success",
                draggable: true
            });
        },
        onError: (errors) => {
            console.error("Помилка при створенні квитка:", errors);
            Swal.fire({
                icon: "error",
                title: "Помилка при створенні квитка!",
                text: "Сталася невідома помилка. Спробуйте пізніше."
            });
        }
    });
};
</script>
