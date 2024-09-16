  <script setup>
  import { ref, defineEmits } from 'vue';

  const props = defineProps({
    message: {
      type: String,
      required: true
    },
    show: {
      type: Boolean,
      required: true
    }
  });

  const emit = defineEmits(['confirm', 'cancel']);
  const confirm = () => emit('confirm');
  const cancel = () => emit('cancel');
</script>
<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-xl font-bold mb-4">Confirmación</h2>
      <p class="mb-4">{{ message }}</p>
      <div class="flex justify-end gap-4">
        <button @click="confirm" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
        <button @click="cancel" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
      </div>
    </div>
  </div>
</template>

