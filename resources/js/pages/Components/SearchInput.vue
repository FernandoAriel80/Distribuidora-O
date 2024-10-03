<script setup>
import { ref } from 'vue';

const props = defineProps(['searchValue']);
const emit = defineEmits(['update:searchValue']);

const search = ref(props.searchValue);

const updateSearch = () => {
    emit('update:searchValue', search.value);
};
</script>
<template>
    <div class="flex justify-end mb-4">
        <div class="w-1/4">
            <input
                type="search"
                placeholder="Busqueda"
                v-model="search"
                @input="updateSearch"
                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>
    </div>
</template>

