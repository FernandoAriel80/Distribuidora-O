<script setup>
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import routes from '../../router';

const props = defineProps({
    cart: Object
});

const cartTotal = computed(() => {
    return Object.values(props.cart).reduce((total, product) => {
        return product.type == 'bulk' ? total + product.price * product.bulk_unit * product.quantity : total + product.price * product.quantity
    }, 0);
});

const removeProduct = (id) => {
    router.delete(routes.cart.delete(id), {
        onSuccess: () => {
        },
        onError: (error) => {
            console.error(error);
        },
    });
};

////////////////////////

const increaseQuantity = (id, quantity) => {
    quantity++;
    updateQuantity(id, quantity);
}

const decreaseQuantity = (id, quantity) => {
    if (quantity > 1) {
        quantity--;
        updateQuantity(id, quantity);
    }
}

const updateQuantity = (id, quantity) => {
    const verifica = quantity < 1 ? 1 : quantity;
    router.put(routes.cart.update(id, verifica),
        {
            onSuccess: () => {
                console.log('cambio valor quantity');
            },
        }
    )
}

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
                        <th class="px-4 py-2 text-center">Disponible</th>
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
                            <span class="font-semibold">{{ product.type == 'unit' ? product.name + ' (x1)' :
                                product.name + '(x' + product.bulk_unit + ')' }}</span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex items-center space-x-2">
                                <button @click="decreaseQuantity(id, product.quantity)"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-3 rounded-l-lg"
                                    :disabled="product.quantity === 1">
                                    -
                                </button>
                                <input type="number" v-model="product.quantity" min="1"
                                    class="w-12 text-center border border-gray-300 rounded-md"
                                    @change="updateQuantity(id, product.quantity)" />
                                <button @click="increaseQuantity(id, product.quantity)"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-3 rounded-r-lg">
                                    +
                                </button>
                            </div>
                        </td>
                        <td class="px-4 py-2 text-center">
                            {{ product.stock == 1 ? 'si' : 'no' }}
                        </td>
                        <td class="px-4 py-2 text-right">
                            ${{ product.price }}
                        </td>
                        <td class="px-4 py-2 text-right">
                            ${{ product.type == 'bulk' ? product.price * product.bulk_unit * product.quantity :
                                product.price * product.quantity }}
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

<style scoped>
/* Para navegadores basados en WebKit (Chrome, Safari, etc.) */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Para Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}
</style>