<template>
    <PageLayout>
        <div class="contacts-page" style="min-height: 90dvh">
            <div class="info-form-container">
                <div class="contact-info">
                    <h2>Контактна інформація</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <img src="/icons/tel.png" class="info-icon" alt="tel.png">
                            <div>
                                <div class="info-label">Телефон</div>
                                <div class="info-value">
                                    +38 068 123 12 21<br/>
                                    +38 068 345 67 78
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <img src="/icons/mail.png" class="info-icon" alt="mail.png">
                            <div>
                                <div class="info-label">Пошта</div>
                                <div class="info-value">
                                    <a href="mailto:absolutecinema@help.com">absolutecinema@help.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <img src="/icons/location.png" class="size-exception info-icon" alt="location.png">
                            <div>
                                <div class="info-label">Локація</div>
                                <div class="info-value">
                                    м. Київ<br/>
                                    вулиця Банкова, 3
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <img src="/icons/social.png" class="info-icon" alt="social.png">
                            <div>
                                <div class="info-label">Соціальні мережі</div>
                                <div class="info-socials">
                                    <a href="#"><img src="/icons/telegram.png" alt="Telegram"/></a>
                                    <a href="#"><img src="/icons/vk.png" alt="VK"/></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="map-container">
                    <iframe class="map-container"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1068.253696137575!2d30.529104866623744!3d50.44576100747295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce5361375c7b%3A0x97858b9fb661e47a!2sQuintessentially%20Ukraine!5e0!3m2!1sru!2snl!4v1763208976464!5m2!1sru!2snl"
                        width="618" height="175" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="contact-form">
                <h2>Напишіть нам</h2>
                <form @submit.prevent="submitForm">
                    <div class="name-fields">
                        <input type="text" v-model="form.first_name" placeholder="Ім’я" required/>
                        <input type="text" v-model="form.last_name" placeholder="Прізвище" required/>
                    </div>
                    <input type="email" v-model="form.email" placeholder="Пошта" required/>
                    <textarea v-model="form.message" placeholder="Ваше повідомлення" required></textarea>
                    <button type="submit">Надіслати ></button>
                    <div v-if="successMessage" class="success-msg">
                        {{ successMessage }}
                    </div>
                </form>
            </div>
        </div>
    </PageLayout>
</template>

<script setup>
import PageLayout from '@/Layouts/page-layout/page-layout.vue'
import {reactive, ref} from 'vue'
import {router} from '@inertiajs/vue3'

const form = reactive({
    first_name: '',
    last_name: '',
    email: '',
    message: '',
})

const successMessage = ref('')

const submitForm = () => {
    router.post(route('contacts.store'), form, {
        onSuccess: () => {
            successMessage.value = 'Повідомлення успішно надіслано!'

            form.first_name = ''
            form.last_name = ''
            form.email = ''
            form.message = ''

            setTimeout(() => {
                successMessage.value = ''
            }, 5000)
        }
    })
}
</script>

<style scoped>
.contacts-page {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 120px 22rem 150px;
}

.info-form-container {
    display: flex;
    flex-direction: column;
    margin: 0 25px 0 0;
}

.contact-form {
    width: 394px;
    height: 683px;
    background: #2c2c3d;
    border-radius: 12px;
    padding: 60px 40px 55px;
    display: flex;
    flex-direction: column;
}

.contact-info {
    width: 618px;
    height: 458px;
    background: #2c2c3d;
    border-radius: 12px;
    padding: 50px 40px;
    color: white;
}

.contact-info h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 40px;
}

.contact-info h2,
.contact-form h2 {
    margin-bottom: 1rem;
    font-size: 30px;
}

.info-grid {
    margin: 46px 0 0 0;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 63px 0;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.info-icon {
    font-size: 24px;
    margin-top: 4px;
    width: 23px;
    height: 23px;
}

.size-exception {
    width: 18px;
    height: 25px;
}

.info-label {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 5px;
}

.info-value {
    font-size: 16px;
    line-height: 1.5;
}

.info-value a {
    color: white;
    text-decoration: underline;
}

.info-socials {
    display: flex;
    gap: 10px;
    margin-top: 5px;
}

.info-socials img {
    width: 28px;
    height: 28px;
}

.contact-form form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    flex-grow: 1;
}

.name-fields {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

input {
    padding: 0.75rem;
    background: #201f2c;
    border: none;
    border-radius: 8px;
}

textarea {
    flex-grow: 1;
    min-height: 150px;
    background: #201f2c;
    border: none;
    border-radius: 8px;
    resize: none;
}

button {
    background: #4b47ff;
    color: white;
    padding: 0.75rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: auto;
}

button:hover {
    background: #3733d4;
}

.success-msg {
    margin-top: 1rem;
    color: #00ffae;
}

.map-container {
    margin: 25px 0 0 0;
    border-radius: 12px;
    overflow: hidden;
}
</style>
