<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import TextInput from '../../Components/TextInput.vue';
import FormButton from '../../Components/FormButton.vue';
import routes from '../../../router';

const props = defineProps({
    employees:{
        type:Object,
        required: true,
    }
});

const form = useForm({
    name: props.employees.name,
    email: props.employees.email,
    password: null,
    password_confirmation: null,
});

const emit = defineEmits(['actionExecuted']);
console.log(props.employees.id);
const submit = () => {
    form.post(routes.employees.update(props.employees.id), {
        onSuccess: () => {
            emit('actionExecuted');
        },
        onError: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Registro" />

    <div class="flex items-center justify-center">
        <form @submit.prevent="submit" class="p-6 rounded-md ring-1 ring-slate-300 max-w-md w-full">
            <label class="block text-3xl font-bold leading-8 text-slate-900 mb-6 text-center">Registrar</label>
            <div class="mb-6">
                <TextInput name="Nombre" v-model="form.name" :message="form.errors.name"/>
                <TextInput name="Correo" type="email" v-model="form.email" :message="form.errors.email" />
                <TextInput name="Contraseña" type="password" v-model="form.password" :message="form.errors.password" />
                <TextInput name="Confirmar Contraseña" type="password" v-model="form.password_confirmation" :message="form.errors.password_confirmation" />

                <div>
                   <FormButton :name="'Registrar'" :progress="form.progress" />
                </div>
            </div>
        </form>

    </div>
</template>