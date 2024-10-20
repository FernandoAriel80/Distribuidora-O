<script setup>
import { Link } from '@inertiajs/vue3';
import routes from '../router';
</script>

<template>
    <div>
        <header class="bg-green-500 text-white">
            <nav class="flex items-center justify-between p-4 max-w-screen-lg mx-auto">
                <div class="">
                    <h1>LOGO</h1>
                </div>
                <div class="flex space-x-6 ml-auto" v-if="$page.props.auth.user">
                    <Link :href="routes.home">Inicio</Link>
                    <h1 class="title"> {{ $page.props.auth.user.name }}</h1>
                    <Link :href="routes.cart.index" class="bg-blue-500 text-white ">
                    <div>
                        {{ $page.props.cart.user != null ? $page.props.cart.user : '0' }}  Carrito
                    </div>
                   
                    </Link>
                    <Link :href="routes.auth.logout" method="post" as="button" type="button" class="nav-link"> Cerrar
                    Sesión</Link>
                    <div v-if="$page.props.auth.user.role === 'admin' || $page.props.auth.user.role === 'super_admin'">
                        <Link :href="routes.admin.menu">Administración</Link>
                    </div>

                </div>
                <div class="space-x-6 ml-auto" v-else>
                    <Link :href="routes.home">Inicio</Link>
                    <Link :href="routes.auth.login"> Iniciar Sesión</Link>
                </div>
            </nav>
        </header>
        <main class="p-4">
            <slot />
        </main>
    </div>

</template>