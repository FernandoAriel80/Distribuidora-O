<script setup>
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import routes from '../../router';

const props = defineProps({
    cart: Object
});

const cartTotal = computed(() => {
    return Object.values(props.cart).reduce((total, product) => {
        return total + product.price * product.quantity;
    }, 0);
});

const removeProduct = (id) => {
   /*  router.post(routes.cart.delete(id), {
        onSuccess: () => {
            router.reload();
        }
    }); */
    console.log(id);
    router.delete(routes.cart.delete(id), {  
            onSuccess: () => {
            },
            onError: (error) => {
                console.error(error);
            },
        });
};
</script>
<template>

    <Head title="Carrito" />
    <div>
        <h1 class="text-2xl font-bold mb-4">Carrito de Compra</h1>
        <div v-if="Object.keys(cart).length > 0" class="bg-white shadow-md rounded-lg p-4">
            <table class="table-auto w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">ID Carrito</th>
                        <th class="px-4 py-2">ID producto</th>
                        <th class="px-4 py-2">Imagen</th>
                        <th class="px-4 py-2">Producto</th>
                        <th class="px-4 py-2 text-center">Cantidad</th>
                        <th class="px-4 py-2 text-right">Precio</th>
                        <th class="px-4 py-2 text-right">Total</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, id) in cart" :key="id" class="border-t">
                        <td class="px-4 py-2 text-center">
                            {{ product.cart_id }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            {{ product.catalog_id }}
                        </td>
                        <td class="px-4 py-2">
                            <img :src="`/storage/${product.image}`" alt="Imagen del producto"
                                class="w-20 h-20 object-cover rounded-lg">
                        </td>
                        <td class="px-4 py-2">
                            <span class="font-semibold">{{ product.name }}</span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            {{ product.quantity }}
                        </td>
                        <td class="px-4 py-2 text-right">
                            ${{ product.price }}
                        </td>
                        <td class="px-4 py-2 text-right">
                            ${{ product.price * product.quantity }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            <button @click="removeProduct(id)"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-300">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-end mt-6">
                <h2 class="text-xl font-bold">Total: ${{ cartTotal.toFixed(2) }}</h2>
            </div>
        </div>

        <div v-else class="bg-gray-100 p-6 text-center rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Tu carrito está vacío</h3>
        </div>
    </div>
</template>