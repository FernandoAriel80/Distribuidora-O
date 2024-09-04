<script setup>
import { router, useForm } from '@inertiajs/vue3';
import TextInput from '../Components/TextInput.vue';
const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.post("register", {
        onError: () => form.reset("password", "password_confirmation"),
    });
   // return { form, submit };
}; 
 


</script>

<template>

    <Head title="Registro" />
    <div class="w-2/5 mx-auto">
        <form @submit.prevent="submit" class="p-6 rounded-md ring-1 ring-slate-300 max-w-md">
            <label class="block text-3xl font-bold leading-8 text-slate-900 mb-6 text-center">Registrarse</label>
            <div class="mb-6">
                <TextInput name="Nombre" v-model="form.name" :message="form.errors.name"/>
                <TextInput name="Gmail" type="email" v-model="form.email" :message="form.errors.email" />
                <TextInput name="Contraseña" type="password" v-model="form.password" :message="form.errors.password" />
                <TextInput name="Confirmar Contraseña" type="password" v-model="form.password_confirmation" :message="form.errors.password_confirmation" />

                <div>
                    <p class="text-slate-600 mb-2">
                        ya tienes usuario? <a href="/" class="text-link">Iniciar Sesion</a>
                    </p>
                    <button class="primary-btn flex w-full justify-center rounded-md bg-green-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 disabled:bg-gray-400 disabled:cursor-not-allowed" :disabled="form.progress">Registrarse</button>
                </div>
            </div>
        </form>

    </div>
</template>