<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '../Components/TextInput.vue';
const from = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const submit = () => {
    form.post("/register", {
        onerror: () => from.reset("password", "password_confirmation"),
    });
};
</script>

<template>

    <Head title="Registro" />
    <div class="w-2/5 mx-auto">
        <form @submit.prevent="submit" class="p-6 rounded-md ring-1 ring-slate-300 max-w-md">
            <label class="block text-3xl font-bold leading-8 text-slate-900 mb-6 text-center">Registrarse</label>
            <div class="mb-6">
                <TextInput name="Nombre" v-model="from.name" :message="from.errors.name"/>
                <TextInput name="Gmail" type="email" v-model="from.email" :message="from.errors.email" />
                <TextInput name="Contraseña" type="password" v-model="from.password" :message="from.errors.password" />
                <TextInput name="Confirmar Contraseña" type="password" v-model="from.password_confirmation" :message="from.errors.password_confirmation" />

                <div>
                    <p class="text-slate-600 mb-2">
                        ya tienes usuario? <a href="/" class="text-link">Iniciar Sesion</a>
                    </p>
                    <button class="primary-btn flex w-full justify-center rounded-md bg-green-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 disabled:bg-gray-400 disabled:cursor-not-allowed" :disabled="from.progress">Registrarse</button>
                </div>
            </div>
        </form>

        <!------------------------>
        <!-- <form @submit.prevent="submit"
            class="p-6 bg-white border-0 rounded-md shadow-md ring-1 ring-inset ring-slate-300 max-w-md mx-auto">
            <div class="mb-6">
                <label class="block text-sm font-medium leading-6 text-slate-900">Nombre</label>
                <TextInput name="Nombre" v-model="from.name" :message="from.errors.name"
                    class="block w-full rounded-md border-0 p-2 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm bg-white mb-4" />

                <label class="block text-sm font-medium leading-6 text-slate-900">Gmail</label>
                <TextInput name="Gmail" type="email" v-model="from.email" :message="from.errors.email"
                    class="block w-full rounded-md border-0 p-2 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm bg-white mb-4" />

                <label class="block text-sm font-medium leading-6 text-slate-900">Contraseña</label>
                <TextInput name="Contraseña" type="password" v-model="from.password" :message="from.errors.password"
                    class="block w-full rounded-md border-0 p-2 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm bg-white mb-4" />

                <label class="block text-sm font-medium leading-6 text-slate-900">Confirmar Contraseña</label>
                <input type="password" v-model="from.password_confirmation"
                    class="block w-full rounded-md border-0 p-2 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm bg-white mb-6" />

                <div>
                    <p class="text-slate-600 mb-2">
                        ¿Recordar usuario? <a href="#" class="text-link">Iniciar Sesión</a>
                    </p>
                    <button class="primary-btn" :disabled="from.progress">Registro</button>
                </div>
            </div>
        </form> -->
    </div>
</template>