<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '../../Components/TextInput.vue';
import FormButton from '../../Components/FormButton.vue';
import formSelect from '../../Components/formSelect.vue';
import routes from '../../../router';
import { defineProps } from 'vue';

const props = defineProps({
    categories: {
        type: Object,
        required: true
    },
    types: {
        type: Object,
        required: true,
    },
    product: Object
});
const form = useForm({
    catalog_id: props.product.catalog_id,
    name: props.product.name,
    description: props.product.description,
    bulk_unit_price: props.product.bulk_unit_price,
    unit_price: props.product.unit_price,
    percent_off: props.product.percent_off,
    offer: props.product.offer === 1 ? true : false,
    price_offer: props.product.price_offer,
    stock: props.product.stock === 1 ? true : false,
    image_url: null,
    category_id: props.product.category_id,
    type_id: props.product.type_id,
});

const change = (e) => {
    form.image_url = e.target.files[0];
};

const submit = () => {
    console.log(form);
    form.put(routes.products.update(props.product.id));

};
/* const submit = () => {
    const data = new FormData();
    for (const [key, value] of Object.entries(form)) {
        data.append(key, value);
    }
    data.append('image_url', form.image_url); // Agrega el archivo si existe
    
    form.put(routes.products.update(props.product.id), {
        data,
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    });
}; */


</script>

<template>

    <Head title="Admin" />

    <div class="w-full max-w-4xl mx-auto">
        <form @submit.prevent="submit" class="p-8 rounded-md ring-1 ring-slate-300">
            <label class="block text-3xl font-bold leading-8 text-slate-900 mb-6 text-center">Editar Producto</label>
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
                    <div>
                        <img :src="`/storage/${props.product.image_url}`" alt="Imagen actual"
                            class="mb-2 w-32 h-32 object-cover" />
                    </div>
                    <div class="flex flex-col space-y-2 m-1">
                        <label for="image_url" class="text-sm font-medium text-gray-700">Foto producto</label>
                        <input type="file" id="image_url" @change="change"
                            class="text-sm p-2 border border-gray-300 rounded-md" />

                        <p class="text-red-500 text-sm">{{ form.errors.image_url }}</p>
                    </div>

                </div>
            </div>
            <div>
                <FormButton :name="'Guardar'" class=" max-w-[200px] ml-auto" />
            </div>
        </form>
    </div>

</template>