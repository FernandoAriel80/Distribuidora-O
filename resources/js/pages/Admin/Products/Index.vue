<script setup>
import ImagePreview from '../../Components/ImagePreview.vue';
import Pagination from '../../Components/Pagination.vue';
import SearchInput from '../../Components/SearchInput.vue';
import Modal from '../../Components/Modal.vue';
import ModalAsk from '../../Components/ModalAsk.vue';
import CreateProduct from './Create.vue'
import UpdateProduct from './Update.vue'
import routes from '../../../router';
import { ref, defineProps, watch } from 'vue';
import { router } from '@inertiajs/vue3';
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

const current_id = ref();
const current_objet = ref();
//showModal
const showFlash = ref(true);
const showAlert = ref(false);
const modalAsk = ref(false);

//modal destroy
const openModalAlert = (id) => {
    showAlert.value = true;
    showFlash.value = true;
    current_id.value = id;
}
const closeModalAlert = () => {
    showAlert.value = false;
}
const closeModalAlertYes = () => {
    modalAsk.value = true;
    showFlash.value = false;
    deleteProduct(current_id.value, modalAsk.value);
    closeModalAlert();
}
const closeModalAlertNo = () => {
    modalAsk.value = false;
    showFlash.value = true;
    closeModalAlert();
}

const deleteProduct = (id, ask) => {
    if (ask == true) {
        router.delete(routes.products.delete(id), {
            onSuccess: () => {
            },
            onError: (error) => {
                console.error(error);
            },
        });
    }
};

//modal create and edit
const showModalCreate = ref(false);
const showModalEdit = ref(false);

const openModalCreate = () => {
    showModalCreate.value = true;
    showFlash.value = true;
};

const closeModalCreate = () => {
    showModalCreate.value = false;
    showFlash.value = false;
};

const openModalEdit = (objet) => {
    current_objet.value = objet;
    showModalEdit.value = true;
    showFlash.value = true;
};
const closeModalEdit = () => {
    showModalEdit.value = false;
    showFlash.value = false;
};
const closeFlashAndModal = () => {
    showModalCreate.value = false;
    showModalEdit.value = false;
    showFlash.value = true;
}

</script>
<template>

    <Head title="Admin" />
    <p v-if="showFlash == false && $page.props.flash.greet" class="p-4 bg-green-200">{{ $page.props.flash.greet }}</p>
    <!-- Modal -->
    <div>
        <button @click="openModalCreate" class="px-4 py-2 bg-blue-500 text-white rounded">Cargar Producto</button>
        <Modal :isOpen="showModalCreate" :closeModal="closeFlashAndModal">
            <CreateProduct :categories="props.categories" :types="props.types" @actionExecuted="closeModalCreate" />
        </Modal>
    </div>
    <div v-if="current_objet">
        <Modal :isOpen="showModalEdit" :closeModal="closeFlashAndModal">
            <UpdateProduct :products="current_objet" :categories="props.categories" :types="props.types"
                @actionExecuted="closeModalEdit" />
        </Modal>
    </div>
    <div>
        <ModalAsk :isOpen="showAlert" :closeNo="closeModalAlertNo" :closeYes="closeModalAlertYes"
            message="Esta seguro de eliminar este producto?" />
    </div>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Productos</h1>
        <!-- busqueda-->
        <SearchInput v-model:searchValue="search" />

        <div v-if="props.products.data.length">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripción</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio por Bulto</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio por Unidad</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                % Off
                            </th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio Oferta</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio Anterior</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock
                            </th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Imagen</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Categoría</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo
                            </th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Editar</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="product in products.data" :key="product.id">
                            <td class="px-2 py-3 text-sm text-gray-900">{{ product.catalog_id }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ product.name }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ product.description }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ product.bulk_unit_price }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ product.unit_price }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">
                                {{ product.percent_off === null ? product.percent_off : '%' + product.percent_off }}
                            </td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ product.price_offer }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ product.old_price}}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">
                                {{ product.stock === 1 ? 'SI' : 'NO' }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">
                                <ImagePreview class="w-16 h-16" :src="`/storage/${product.image_url}`"
                                    alt="Imagen del producto" />
                            </td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ product.category.name }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ product.type.name }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">
                                <button @click="openModalEdit(product)"
                                    class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                                    Editar
                                </button>
                            </td>
                            <td class="px-2 py-3 text-sm text-gray-500">
                                <button @click="openModalAlert(product.id)"
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

<!--  <input :type="type" v-model="form.precio_bulto"
                        :class="{ '!ring-red-500': form.errors.precio_bulto }" class="block w-full min-w-[200px] rounded-md border-0 p-10 text-slate-900 shadow-sm ring-1 ring-inset
                        ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500
                        sm:text-sm bg-white mb-4" /> -->