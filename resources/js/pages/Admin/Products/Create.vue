<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '../../Components/TextInput.vue';
import FormButton from '../../Components/FormButton.vue';
import formSelect from '../../Components/formSelect.vue';
import { defineProps } from 'vue';

const form = useForm({
    catalog_id: null,
    name: null,
    description: null,
    bulk_unit_price: null,
    unit_price: null,
    percent_off: null,
    offer: false,
    price_offer: null,
    stock: true,
    image_url: null,
    category_id: null,
    type_id: null,
});

const props = defineProps({
    categories: {
        type: Object,
        required: true
    },
    types: {
        type: Object,
        required: true,
    },
    /*  products: {
        type: Object,
        required: true,
        }, */
});
const change = (e) => {
    form.image_url = e.target.files[0];
    // form.preview = URL.createObjectURL(e.target.files[0]);
};
const submit = () => {
    form.post("create");
    // console.log(form);
    /* form.post("create")
         .then(() => {
             console.log('El registro se ha guardado exitosamente.');
         })
         .catch(error => {
             console.log(error.response.data.errors + 'acaaaaaaaa errrrrorrrrr'); // Muestra los errores de validación
         }); */
};


</script>

<template>

    <Head title="Admin" />

    <div class="w-full max-w-4xl mx-auto">
        <form @submit.prevent="submit" class="p-8 rounded-md ring-1 ring-slate-300">
            <label class="block text-3xl font-bold leading-8 text-slate-900 mb-6 text-center">Cargar Producto</label>
            <div>
                <div class="p-3 bg-green-500">
                    <div>
                        <label for="stock"> ¿Tiene stock?</label>
                        <input type="checkbox" id="stock" class="m-2" v-model="form.stock" />
                        <label for="offer"> ¿Esta en oferta?</label>
                        <input type="checkbox" id="offer" class="m-2" v-model="form.offer" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <TextInput name="ID producto" v-model="form.catalog_id" :message="form.errors.catalog_id" />
                <TextInput name="Nombre producto" v-model="form.name" :message="form.errors.name" />


                <formSelect name="Undiad de medida" v-model="form.type_id" :datas="props.types"
                    :message="form.errors.types" />
                <formSelect name="Seleccione Categoria" v-model="form.category_id" :datas="props.categories"
                    :message="form.errors.categories" />

                <div v-if="form.offer">
                    <TextInput name="Porcentaje de descuento (no obligatorio)" v-model="form.percent_off"
                        :message="form.errors.percent_off" />
                    <TextInput name="Precio oferta" v-model="form.price_offer" :message="form.errors.price_offer" />
                </div>
                <div v-else-if="(!form.offer && form.type_id == 1)">
                    <TextInput name="Precio por unidad" v-model="form.unit_price" :message="form.errors.unit_price" />
                    <TextInput name="Precio unico por bulto" v-model="form.bulk_unit_price"
                        :message="form.errors.bulk_unit_price" />
                </div>
                <div v-else-if="!form.offer">
                    <TextInput name="Precio" v-model="form.unit_price" :message="form.errors.unit_price" />
                </div>


            </div>
            <div class="">

                <div class="m-1">
                    <label class="block text-sm font-medium leading-6 text-slate-900">Descripcion</label>
                    <textarea id="largeText" v-model="form.description" rows="6" class="mt-1 block w-full p-2 
                        border border-gray-300 rounded-md shadow-sm
                      focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Escribe aquí una descripción detallada..."></textarea>
                    <small class="error" v-if="form.errors.price_offer">{{ form.errors.description }}</small>
                </div>

                <div class="flex flex-col space-y-2 m-1">
                    <label for="image_url" class="text-sm font-medium text-gray-700">Foto producto</label>
                    <input type="file" id="image_url" @input="change"
                        class="text-sm p-2 border border-gray-300 rounded-md" />
                    <p class="text-red-500 text-sm">{{ form.errors.image_url }}</p>
                </div>

                <!--  <div class=" grid place-items-center">
                    <div class="relative w-28 h-28
                     rounded-full overflow-hidden border border-slate-300">
                        <label for="image" class="absolute inset-0 grid content-end 
                        cursor-pointer">
                            <span class="bg-while/70 pb-2 text-center">imagen</span>
                        </label>
                        <input type="file" @input="change" id="image" hidden>
                        <img class="object-cover w-28 h-28" 
                        :src="form.preview ?? 'storage/images/default.jpeg'"/>
                    </div>
                    <p class="error mt-2">{{ form.errors,image }}</p>
                </div> -->
            </div>
            <div>
                <FormButton :name="'Guardar'" class=" max-w-[200px] ml-auto" />
            </div>
        </form>
    </div>
    <!-- //////////////////////////////////////////////////////////TABLA////////////////////////////////////////// -->

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

</template>

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