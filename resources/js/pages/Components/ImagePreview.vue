
<script setup>
import { ref } from 'vue';

const props = defineProps({
  src: String,
  alt: String
});

const isModalOpen = ref(false);

const openModal = () => {
  isModalOpen.value = true;
};

const closeModal = () => {
  isModalOpen.value = false;
};
</script>

<style scoped>
img {
  transition: transform 0.3s ease-in-out;
}

img:hover {
  transform: scale(1.05);
}
</style>

<template>
  <div>
    <img :src="src" @click="openModal" class="object-cover cursor-pointer" :alt="alt" />
    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75"
      @click="closeModal">
      <img :src="src" class="max-w-full max-h-full" />
    </div>
  </div>
</template>
