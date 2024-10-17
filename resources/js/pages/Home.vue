<script setup>
import Layout from '../Layout/Layout.vue';
import { defineProps } from 'vue';

defineOptions({ layout: Layout });

const props = defineProps({
   products: {
      type: Object,
      required: true,
   },
});
console.log(props.products);
</script>

<template>

   <Head title="Inicio" />
   <div>
      <!--   <p v-if="$page.props.auth.user" class="p-4 bg-green-200">{{ $page.props.flash.greet }}</p> -->
      <!-- <p class="line-through">$ 6376.09</p> -->
      <h1>Inicio</h1>
      <div class="container mx-auto p-4">
   <h1 class="text-2xl font-bold mb-4 text-gray-800">Productos Disponibles</h1>
   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
      <div v-for="product in props.products" :key="product.id"
         class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 flex flex-col justify-between w-56 "> 

         <div>
            <div class="relative">
               <img :src="`/storage/${product.image_url}`" alt="Imagen del producto"
                  class="w-full h-60 object-cover rounded-t-lg">
               <div v-if="product.percent_off > 0"
                  class="absolute top-2 left-2 bg-red-500 text-white px-1 py-0.5 rounded text-xs">
                  {{ product.percent_off }}% OFF
               </div>
            </div>
            <div class="p-2">
               <h2 class="text-sm font-semibold text-gray-800 mb-1">{{ product.name }}</h2>
               <p class="text-gray-500 text-xs mb-1">{{ product.description }}</p>
               <div v-if="product.unit_price" class="flex items-center justify-between mb-2">
                  <span v-if="product.bulk_unit_price" class="text-gray-800 font-bold text-xs">Bulto: ${{ product.bulk_unit_price }}</span>
                  <span class="text-gray-800 font-bold text-xs">Unidad: ${{ product.unit_price }}</span>
               </div>
               <div v-else class="flex items-center justify-between mb-2">
                  <span class="text-green-600 font-bold text-xs">Oferta: ${{ product.price_offer }}</span>
                  <span class="text-gray-500 text-xs">Stock: {{ product.stock > 0 ? 'Sí' : 'No' }}</span>
               </div>
               <div v-if="product.unit_price" class="flex items-center justify-between mb-2">
                  <span class="text-gray-500 text-xs">Stock: {{ product.stock > 0 ? 'Sí' : 'No' }}</span>
               </div>
            </div>
         </div>

         <div class="p-2 mt-auto"> <!-- Aseguramos que el botón quede abajo con mt-auto -->
            <button @click="addToCart(product)"
               class="w-full bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-lg text-xs font-semibold transition-colors">
               Añadir
            </button>
         </div>
      </div>
   </div>
</div>





   </div>
</template>
