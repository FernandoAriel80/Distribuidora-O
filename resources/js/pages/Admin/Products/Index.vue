<script setup>
import ImagePreview from '../../Components/ImagePreview.vue';


const props = defineProps({
    categories: {
        type: Object,
        required: true
    },
    types: {
        type: Object,
        required: true,
    },
    products: {
        type: Object,
        required: true,
    },
});
</script>
<template>
<Head title="Admin" />
<p v-if="$page.props.flash.greet" class="p-4 bg-green-200">{{ $page.props.flash.greet }}</p>

    <div class="container mx-auto p-4">
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
    </div>

</template>