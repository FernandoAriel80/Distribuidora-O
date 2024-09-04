<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '../Components/TextInput.vue';
import FormButton from '../Components/FormButton.vue';

const form = useForm({
    email: null,
    password: null,
});

const submit = () => {
    form.post("register");
}; 
 
</script>

<template>
    <Head title="Login" />
    <div class="w-2/5 mx-auto">
        <form @submit.prevent="submit" class="p-6 rounded-md ring-1 ring-slate-300 max-w-md">
            <label class="block text-3xl font-bold leading-8 text-slate-900 mb-6 text-center">Inicia Sesión</label>
            <div class="mb-6">
                <TextInput name="Gmail" type="email" v-model="form.email" :message="form.errors.email" />
                <TextInput name="Contraseña" type="password" v-model="form.password" :message="form.errors.password" />
                <div>
                    <p class="text-slate-600 mb-2">
                        aun no tenes cuenta? <a href="/register" class="text-link text-blue-400">Registrate </a>
                    </p>
                   <FormButton :name="'Iniciar Sesión'" :progress="form.progress" />
                </div>
            </div>
        </form>

    </div>
</template>