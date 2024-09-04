<script setup>
    import { Link } from '@inertiajs/vue3';
</script>
<template>
    <div>
        <header class="bg-green-500 text-white">
            <nav class="flex items-center justify-between p-4 max-w-screen-lg 
            mx-auto">
                <div>
                    <h1 class="title"> {{ $page.props.auth.user.name }}</h1>
                </div>
                <div class="space-x-6">
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