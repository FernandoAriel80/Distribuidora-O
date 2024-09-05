<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '../Components/TextInput.vue';
import FormButton from '../Components/FormButton.vue';

const form = useForm({
    email: null,
    password: null,
    remeber: null,
});

const submit = () => {
    form.post("login"),{
        onError: () => form.reset("password"),
    };
}; 
 
</script>
<template>
    <Head title="Login" />
    <div class="min-h-screen flex items-center justify-center"> 
        <form @submit.prevent="submit" class="p-6 rounded-md ring-1 ring-slate-300 max-w-md w-full">
            <label class="block text-3xl font-bold leading-8 text-slate-900 mb-6 text-center">Inicia Sesión</label>
            <div class="mb-6">
                <TextInput name="Gmail" type="email" v-model="form.email" :message="form.errors.email" />
                <TextInput name="Contraseña" type="password" v-model="form.password" :message="form.errors.password" />
                <div>
                    <input type="checkbox" v-model="form.remember" id="remember"/>
                    <label for="remember"> Recordar cuenta</label>
                </div>
                <div>
                    <p class="text-slate-600 mb-2">
                        aun no tienes cuenta? <a href="/register" class="text-link text-blue-400">Registrate </a>
                    </p>
                    <FormButton :name="'Iniciar Sesión'" :progress="form.progress" />
                </div>
            </div>
        </form>
    </div>
</template>
