<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    searchValue: String
});

const search = ref(props.searchValue);

const emit = defineEmits(['update:searchValue']);

watch(search, (newValue) => {
    emit('update:searchValue', newValue);
});
</script>

<template>
  <div class="flex justify-end mb-4">
    <div class="w-1/8">
      <input
        type="search"
        placeholder="Busqueda"
        v-model="search"
        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
    </div>
  </div>
</template>
