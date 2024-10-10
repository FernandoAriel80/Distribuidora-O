<script setup>

const props = defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },
    closeModal: {
        type: Function,
        required: true,
    },
});
</script>
<template>
    <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-2 rounded-lg shadow-lg w-full max-w-2xl max-h-full overflow-y-auto">
            <button @click="closeModal" class="px-4 py-2 bg-red-500 text-white rounded">Cerrar</button>            
            <slot></slot>
        </div>        
    </div>
</template>
