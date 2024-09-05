<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '../../Components/TextInput.vue';
import FormButton from '../../Components/FormButton.vue';

const form = useForm({
    catalog_id: null,
    name: null,
    description: null,
    bulk_unit_price: null,
    unit_price: null,
    percent: null,
    offer: null,
    price_offer: null,
    stock: null,
    image_url: null,
    type_id: null,
});

const submit = () => {
    /*  form.post("register", {
         onError: () => form.reset("password", "password_confirmation"),
     }); */
};

</script>

<template>

    <Head title="Admin" />
    <div class="w-full max-w-4xl mx-auto">
        <form @submit.prevent="submit" class="p-8 rounded-md ring-1 ring-slate-300">
            <label class="block text-3xl font-bold leading-8 text-slate-900 mb-6 text-center">Carga Producto</label>
            <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
                <TextInput name="ID producto" v-model="form.id_producto" :message="form.errors.id_producto" />
                <TextInput name="Nombre producto" v-model="form.nombre_producto"
                    :message="form.errors.nombre_producto" />
                <TextInput name="Precio unico por bulto" v-model="form.descripcion"
                    :message="form.errors.descripcion" />
                <div class="m-4">
                    <label class="block text-sm font-medium leading-6 text-slate-900">Descripcion</label>
                    <input :type="type" v-model="form.precio_bulto" :class="{ '!ring-red-500': form.errors.precio_bulto }"
                     class="block w-full min-w-[200px] rounded-md border-0 p-10 text-slate-900 shadow-sm ring-1 ring-inset
                        ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500
                        sm:text-sm bg-white mb-4" />
                    <small class="error" v-if="message">{{ form.errors.precio_bulto }}</small>
                </div>

                <TextInput name="Precio unico" v-model="form.precio_unico" :message="form.errors.precio_unico" />
                <TextInput name="Porcentaje de descuento" v-model="form.descuento" :message="form.errors.descuento" />
                <TextInput name="Esta en oferta?" v-model="form.oferta" :message="form.errors.oferta" />
                <TextInput name="Precio oferta" v-model="form.precio_oferta" :message="form.errors.precio_oferta" />
                <TextInput name="Tiene stock?" v-model="form.stock" :message="form.errors.stock" />
                <TextInput name="Imagen producto" v-model="form.imagen_producto"
                    :message="form.errors.imagen_producto" />
                <TextInput name="Tipo de categoria" v-model="form.tipo_categoria"
                    :message="form.errors.tipo_categoria" />
                <TextInput name="Por unidad o por kg?" v-model="form.unidad_kg" :message="form.errors.unidad_kg" />
            </div>
            <div>
                <FormButton :name="'Registrarse'" :progress="form.progress" class=" max-w-[200px] ml-auto" />
            </div>
        </form>
    </div>


</template>