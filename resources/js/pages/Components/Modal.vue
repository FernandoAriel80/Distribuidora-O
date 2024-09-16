    <script setup>
    import { defineProps, defineEmits } from 'vue';

    const props = defineProps({
        title: {
            type: String,
            required: true
        },
        isVisible: {
            type: Boolean,
            required: true
        }
    });

    const emit = defineEmits(['close']);

    const closeModal = () => {
        emit('close');
    };
</script>
    
<template>
    <div v-if="isVisible" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 max-w-lg w-full">
            <h2 class="text-xl font-bold mb-4">{{ title }}</h2>
            <slot></slot> <!-- Para contenido dinámico -->
            <div class="mt-4 flex justify-end">
                <button @click="closeModal" class="px-4 py-2 bg-red-500 text-white rounded">Cerrar</button>
            </div>
        </div>
    </div>
</template>

