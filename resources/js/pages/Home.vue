<script setup>
import Layout from '../Layout/Layout.vue';
import SearchInput from './Components/SearchInput.vue';
import Pagination from './Components/Pagination.vue';
import { defineProps, ref, watch, onMounted, onBeforeUnmount } from 'vue';
import { router } from '@inertiajs/vue3';
import { debounce } from 'lodash';

defineOptions({ layout: Layout });

const props = defineProps({
   products: {
      type: Object,
      required: true,
   },
   categories: {
      type: Object,
      required: true,
   },
   searchTerm: String,
   categoryTerm: String,
   sortOrder: String
});

//search
const search = ref(props.searchTerm || '');
const category = ref(props.categoryTerm || '');
const sort = ref(props.sortOrder || 'rel');

const searchDebounced = debounce(() => {
   if (search == props.searchTerm) {
      router.reload({
         only: ['products'], data: {
            search: search.value,
            category: category.value,
            sort: sort.value
         }, preserveState: true, preserveScroll: true,
      })
   } else {
      router.reload({
         only: ['products'], data: {
            page: 1, 
            search: search.value,
            category: category.value,
            sort: sort.value
         }, preserveState: true, preserveScroll: true,
      })
   }
}, 300)

watch(search, () => {
   searchDebounced();
});
watch(sort, () => {
   searchDebounced();
});
watch(category, () => {
   searchDebounced();
});


/////////////////////////////////////////////////

</script>

<template>

   <Head title="Inicio" />
   <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4 text-gray-800">Productos Disponibles</h1>
      <div class="container mx-auto p-4">
         <div class="grid grid-cols-1 md:grid-cols-4 gap-2">

            <aside class="md:col-span-1">
               <div class="bg-white shadow-md p-4 rounded-md max-w-xs w-48">
                  <h2 class="text-sm font-semibold mb-2">Filtrar por categoría</h2>
                  <ul class="space-y-1">
                     <li>
                        <label class="flex items-center text-sm">
                           <input type="radio" v-model="category" value=" " class="mr-1.5 h-3 w-3" />
                           Ninguno
                        </label>
                     </li>
                     <li v-for="categoryItem in categories" :key="categoryItem.id">
                        <label class="flex items-center text-sm">
                           <input type="radio" v-model="category" :value="categoryItem.name" class="mr-1.5 h-3 w-3" />
                           {{ categoryItem.name }}
                        </label>
                     </li>
                  </ul>
               </div>
            </aside>

            <section class="md:col-span-3">
               <div>
                  <SearchInput v-model:searchValue="search" />
                  
                  <select v-model="sort" class="border p-2 mb-4 rounded">
                     <option value="rel">Relevante</option>
                     <option value="lPrice">Precio: Más barato</option>
                     <option value="hPrice">Precio: Más caro</option>
                  </select>
               </div>

               <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                  <div v-for="product in props.products.data" :key="product.id" class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform 
                     hover:scale-105 flex flex-col justify-between w-56 ">

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
                           <div v-if="product.price_offer"  class="flex items-center justify-between mb-2">
                              <span v-if="product.type.id == 1" class="text-gray-800 font-bold text-xs">Unidad: $<p class="line-through">{{ product.old_price }}</p></span>
                              <span v-if="product.type.id == 2" class="text-gray-800 font-bold text-xs">Kg: $<p class="line-through">{{ product.old_price }}</p></span>
                              <span class="text-green-600 font-bold text-xs">Oferta: ${{ product.price_offer }}</span>
                           </div>
                           <div v-else class="flex items-center justify-between mb-2">
                              <span v-if="product.type.id == 1" class="text-gray-800 font-bold text-xs">Unidad: ${{ product.unit_price }}</span>
                              <span v-if="product.type.id == 2" class="text-gray-800 font-bold text-xs">Kg: ${{ product.unit_price }}</span>
                              <span v-if="product.bulk_unit_price" class="text-gray-800 font-bold text-xs">Bulto: ${{
                                 product.bulk_unit_price }}</span>
                           </div>
                           <div v-if="product.unit_price" class="flex items-center justify-between mb-2">
                              <span class="text-gray-500 text-xs">Stock: {{ product.stock > 0 ? 'Sí' : 'No' }}</span>
                           </div>
                        </div>
                     </div>

                     <div class="p-2 mt-auto">
                        <button @click="addToCart(product)"
                           class="w-full bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-lg text-xs font-semibold transition-colors">
                           Añadir
                        </button>
                     </div>
                  </div>

               </div>

               <div>
                  <Pagination class="mt-4" :links="products.links" />
               </div>
            </section>
         </div>
      </div>
   </div>
</template>