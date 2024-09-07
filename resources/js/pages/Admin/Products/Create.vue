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
    percent: null,
    isOffer: null,
    price_offer: null,
    stock: null,
    image_url: null,
    category_id: null,
    type_id: null,
    type_name: null,
    iskg: false,

});

const props = defineProps({
    categories: {
        type: Object,
        required: true
    },
    types:{
        type: Object,
        required: true,
    },
});

const submit = () => {
    /*  form.post("register", {
         onError: () => form.reset("password", "password_confirmation"),
     }); */
     console.log(props);
};

</script>

<template>

    <Head title="Admin" />

    <div class="w-full max-w-4xl mx-auto">
        <form @submit.prevent="submit" class="p-8 rounded-md ring-1 ring-slate-300">
            <label class="block text-3xl font-bold leading-8 text-slate-900 mb-6 text-center">Carga Producto</label>
            <div>
                <div class="p-3 bg-green-500">
                    <div>
                        <label for="stock"> ¿Tiene stock?</label>
                        <input type="checkbox" id="stock" class="m-2" v-model="form.stock" />
                        <label for="offer"> ¿Esta en oferta?</label>
                        <input type="checkbox" id="offer" class="m-2" v-model="form.isOffer" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <TextInput name="ID producto" v-model="form.catalog_id" :message="form.errors.catalog_id" />
                <TextInput name="Nombre producto" v-model="form.name" :message="form.errors.name" />
              

                <formSelect name="Undiad de medida" v-model="form.type_id" :datas="props.types" />
                <formSelect name="Seleccione Categoria" v-model="form.category_id" :datas="props.categories" />

               <!--  <div v-if="form.type_id == '2'">
                    <TextInput name="Precio por " v-model="form.unit_price" :message="form.errors.unit_price" />
                </div> -->
                <div v-if="!form.isOffer">
                    <TextInput name="Precio por unidad" v-model="form.unit_price" :message="form.errors.unit_price" />
                    <TextInput name="Precio unico por bulto" v-model="form.bulk_unit_price"
                        :message="form.errors.bulk_unit_price" />
                </div>
                <div v-if="form.isOffer" :v-model="form.iskg = false">
                    <TextInput name="Porcentaje de descuento (no obligatorio)" v-model="form.percent"
                        :message="form.errors.percent" />
                    <TextInput name="Precio oferta" v-model="form.price_offer"
                        :message="form.errors.price_offer" />

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
                    <label for="image" class="text-sm font-medium text-gray-700">Foto producto</label>
                    <input type="file" id="image" @input="change"
                        class="text-sm p-2 border border-gray-300 rounded-md" />
                </div>

            </div>

            <div>
                <FormButton :name="'Registrarse'" :progress="form.progress" class=" max-w-[200px] ml-auto" />
            </div>
        </form>
    </div>

</template>

<!--  <input :type="type" v-model="form.precio_bulto"
                        :class="{ '!ring-red-500': form.errors.precio_bulto }" class="block w-full min-w-[200px] rounded-md border-0 p-10 text-slate-900 shadow-sm ring-1 ring-inset
                        ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500
                        sm:text-sm bg-white mb-4" /> -->