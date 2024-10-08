<script setup>
import ImagePreview from '../../Components/ImagePreview.vue';
import Pagination from '../../Components/Pagination.vue';
import SearchInput from '../../Components/SearchInput.vue';
import Modal from '../../Components/Modal.vue';
import CreateProduct from '../Products/Create.vue'
import EditProduct from '../Products/Edit.vue'
import routes from '../../../router';
import { ref, defineProps, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { debounce } from 'lodash';

const props = defineProps({
    products: {
        type: Object,
        required: true,
    },
    categories: {
        type: Object,
        required: true
    },
    types: {
        type: Object,
        required: true,
    },
    searchTerm: String
});

//search
const search = ref(props.searchTerm);
const searchDebounced = debounce(() => {
    if (search == props.searchTerm) {
        router.reload({ only: ['products'], data: { search: search.value }, preserveState: true, preserveScroll: true, })
    } else {
        router.reload({ only: ['products'], data: { page: 1, search: search.value }, preserveState: true, preserveScroll: true, })
    }
}, 300)

watch(search, () => {
    searchDebounced();
});

//delete
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

/* const isModalVisible = ref(false);

const openModal = () => {
    isModalVisible.value = true;
}; */

//showModal
const showModal = ref(false);
const showModalEdit = ref(false);

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const openModalEdit = () => {
    showModalEdit.value = true;
};
const closeModalEdit = () => {
    showModal.value = false;
};
</script>
<template>

    <Head title="Admin" />
    <p v-if="$page.props.flash.greet" class="p-4 bg-green-200">{{ $page.props.flash.greet }}</p>
    <!-- Modal -->
    <div>
        <button @click="openModal" class="px-4 py-2 bg-blue-500 text-white rounded">Abrir Modal</button>
       <!--  <div v-if="showModalEdit">
      
            <Modal :isOpen="showModalEdit" :closeModal="closeModalEdit">
       
               <EditProduct :categories="props.categories" :types="props.types" :products="props.products" @actionExecuted="closeModalEdit"/>
            </Modal>
        </div>
        <div v-else>

            <Modal :isOpen="showModal" :closeModal="closeModal">
       
                <CreateProduct :categories="props.categories" :types="props.types" @actionExecuted="closeModal" />
            </Modal>
        </div> -->
        <Modal :isOpen="showModal" :closeModal="closeModal">
                <!-- class="w-full max-w-md p-1 bg-white rounded-lg shadow-lg" -->
                <CreateProduct :categories="props.categories" :types="props.types" @actionExecuted="closeModal" />
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
            <Pagination class="mt-4" :links="products.links" />
        </div>

    </div>
</template>


<!-- <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Productos</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Descripción</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio por Bulto</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio por Unidad</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">% Off
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio Oferta</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Imagen</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categoría</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Editar</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Eliminar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="product in props.products" :key="product.id">
                        <td class="px-4 py-3 text-sm text-gray-900">{{ product.catalog_id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ product.name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ product.description }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ product.bulk_unit_price }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ product.unit_price }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ product.percent_off }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ product.price_offer }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ product.stock }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            <ImagePreview :src="`/storage/${product.image_url}`" alt="Imagen del producto" />
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ product.category_id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ product.type_id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            <button @click="editProduct(product)"
                                class="bg-blue-500 text-white px-3 py-1 rounded text-xs">Editar</button>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            <button @click="deleteProduct(product.id)"
                                class="bg-red-500 text-white px-3 py-1 rounded text-xs">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> -->

<!-- <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Lista de Productos</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <div v-for="product in products" :key="product.id" class="border p-4 rounded-lg shadow-md bg-white">
        <h2 class="text-xl font-semibold">{{ product.name }}</h2>
        <p><strong>Descripción:</strong> {{ product.description || 'No disponible' }}</p>
        <p><strong>Precio:</strong> ${{ product.unit_price }}</p>
        <p><strong>Stock:</strong> {{ product.stock ? 'Disponible' : 'Sin stock' }}</p>
        <p><strong>En Oferta:</strong> {{ product.offer ? 'Sí' : 'No' }}</p>
        <p v-if="product.offer"><strong>Precio de Oferta:</strong> ${{ product.price_offer }}</p>
        <img v-if="product.image_url" :src="`/storage/${product.image_url}`" alt="Imagen del producto"
             class="w-16 h-16 mt-2">
        <div class="mt-4 flex justify-between">
          <button @click="editProduct(product)" class="bg-blue-500 text-white px-4 py-2 rounded">Editar</button>
          <button @click="deleteProduct(product.id)" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
        </div>
      </div>
    </div>
  </div> -->

<!--  <input :type="type" v-model="form.precio_bulto"
                        :class="{ '!ring-red-500': form.errors.precio_bulto }" class="block w-full min-w-[200px] rounded-md border-0 p-10 text-slate-900 shadow-sm ring-1 ring-inset
                        ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500
                        sm:text-sm bg-white mb-4" /> -->