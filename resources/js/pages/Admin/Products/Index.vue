
<script setup>
import ImagePreview from '../../Components/ImagePreview.vue';
import Pagination from '../../Components/Pagination.vue';
import SearchInput from '../../Components/SearchInput.vue';
import Modal from '../../Components/Modal.vue';
import routes from '../../../router';
import { ref, defineProps, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import {debounce} from 'lodash';

const props = defineProps({
    products: {
        type: Object,
        required: true,
    },
    searchTerm:String
});

const search = ref(props.searchTerm);
const searchDebounced = debounce(()=>{ 
    if (search == props.searchTerm) {
        router.reload({only:['products'], data:{search:search.value},preserveState:true,preserveScroll:true,})
    } else {
        router.reload({only:['products'], data:{page:1, search:search.value},preserveState:true,preserveScroll:true,})
    }
},300) 

watch(search, ()=>{
    searchDebounced();
}); 

const deleteProduct = (id) => {
    if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
        Inertia.delete(routes.products.delete(id), {
            onSuccess: () => { },
            onError: (error) => {
                console.error(error);
            },
        });
    }
};

const isModalVisible = ref(false);

const openModal = () => {
    isModalVisible.value = true;
};
</script>
<template>

    <Head title="Admin" />
    <p v-if="$page.props.flash.greet" class="p-4 bg-green-200">{{ $page.props.flash.greet }}</p>
    <!-- Modal -->
    <div>
        <button @click="openModal" class="px-4 py-2 bg-blue-500 text-white rounded">Abrir Modal</button>
        <!-- Modal -->
        <Modal :isVisible="isModalVisible" title="Mi Modal" @close="isModalVisible = false">
            <p>Este es el contenido dentro del modal.</p>
        </Modal>
    </div>
    <!-- Modal -->
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Productos</h1>
        <!-- busqueda-->
        <SearchInput v-model:searchValue="search" />

        <div v-if="props.products.data.length">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripción</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio por Bulto</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio por Unidad</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                % Off
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio Oferta</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Imagen</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Categoría</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Editar</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="product in products.data" :key="product.id">
                            <td class="px-4 py-3 text-sm text-gray-900">{{ product.catalog_id }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ product.name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ product.description }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ product.bulk_unit_price }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ product.unit_price }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ product.percent_off === null ? product.percent_off : '%' + product.percent_off }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ product.price_offer }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ product.stock === 1 ? 'SI' : 'NO' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <ImagePreview class="w-16 h-16" :src="`/storage/${product.image_url}`"
                                    alt="Imagen del producto" />
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ product.category.name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ product.type.name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                                    <Link :href="routes.products.edit(product.id)">Editar</Link>
                                </button>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <button @click="deleteProduct(product.id)"
                                    class="bg-red-500 text-white px-3 py-1 rounded text-xs">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div v-else>
            <p> no encontrado</p>
        </div>
        <div>
            <Pagination class="mt-4" :links="products.links"/>
        </div>

    </div>
</template>