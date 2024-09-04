<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '../Components/TextInput.vue';
import FormButton from '../Components/FormButton.vue';

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
                        ya tienes cuenta? <a href="/login" class="text-link text-blue-400">Iniciar Sesión </a>
                    </p>
                   <FormButton :name="'Registrarse'" :progress="form.progress" />
                </div>
            </div>
        </form>

    </div>
</template>