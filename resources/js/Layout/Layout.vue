<script setup>
    import { Link } from '@inertiajs/vue3';
</script>
<template>
    <div>
        <header class="bg-green-500 text-white">
            <nav class="flex items-center justify-between p-4 max-w-screen-lg mx-auto">
                <!-- v-if="$page.props.auth.user.rol === 'usuario'" -->
                <div class="flex space-x-6 ml-auto" v-if="$page.props.auth.user" >
                    <Link href="/">Inicio</Link>
                    <h1 class="title"> {{ $page.props.auth.user.name }}</h1>
                    <Link 
                    href="/logout"
                    method="post"
                    as="button"
                    type="button"
                    class="nav-link"
                    > Cerrar Sesión</Link>
                </div>
                <div class="space-x-6 ml-auto" v-else>
                    <Link href="/">Inicio</Link>
                    <Link href="/login"> Iniciar Sesión</Link>
                    <Link href="/register"> Registro</Link>    
                </div> 
            </nav>
        </header>
        <main class="p-4">
            <slot />
        </main>
    </div>

</template>