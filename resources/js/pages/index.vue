<template>
    <PageLayout>
        <div class="min-h-screen text-white px-4 mt-6 mb-12">
            <!-- Розділ: Останній реліз -->
            <div class="max-w-[1256px] mx-auto bg-[#2E2E3A] rounded-3xl px-[70px] pt-[41px] pb-[94px]">
                <h2 class="text-[52px] md:text-[52px] font-bold text-center mb-8">Останній реліз</h2>

                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Постер фільму -->
                    <img
                        :src="latestMovie.poster_url || '/placeholder-movie.jpg'"
                        :alt="latestMovie.title"
                        class="w-[380px] h-[540px] rounded-xl object-cover"
                    />

                    <!-- Інформація про фільм -->
                    <div class="flex-1 flex flex-col justify-end ml-[40px]">
                        <h3 class="text-[48px] md:text-[48px] font-bold mb-[14px]">
                            {{ latestMovie.title || 'Molestiae nihil porro.' }}
                        </h3>
                        <p class="text-[36px] md:text-[36px] mb-[60px] leading-relaxed line-clamp-3">
                            {{
                                latestMovie.description || 'Quia nostrum quaerat magni qui. Et recusandae sed ipsam aut itaque corporis.'
                            }}
                        </p>

                        <a
                            href="/movies"
                            class="inline-block bg-[#1C1C24] w-[704px] hover:bg-black font-semibold py-3 px-6 rounded-lg transition duration-300 text-[24px] text-center"
                        >
                            Знайти більше
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </PageLayout>
</template>

<script setup>
import { defineProps } from 'vue'
import PageLayout from "@/Layouts/page-layout/page-layout.vue"

const props = defineProps({
    latestMovie: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<style scoped>
/* При необхідності додамо стилі */
</style>
