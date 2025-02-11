<script setup>
const model = defineModel({
    required: true,
    selected: null,
});

const props = defineProps({
    itens: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <select v-model="model" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option v-for="item in itens" :value="item.id" :key="item.id">{{ item.name }}</option>
    </select>
</template>
