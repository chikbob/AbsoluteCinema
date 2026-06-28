<!-- src/Components/LegendItem.vue -->
<template>
    <div class="flex items-center gap-2">
        <div :class="['w-5 h-5 rounded-full', color]"></div>
        <span class="text-sm font-semibold">{{ label }}</span>
    </div>
</template>

<script setup>
defineProps({
    color: String,
    label: String
});
</script>
