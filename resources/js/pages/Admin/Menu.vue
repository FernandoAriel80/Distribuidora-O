<script setup>
import { Link } from '@inertiajs/vue3';
import routes from '../../router';
</script>

<template>

  <Head title="Admin" />
  <div class="p-6 bg-gray-800 text-white rounded-lg shadow-lg max-w-sm mx-auto">
    <h1 class="text-3xl font-bold mb-6 text-center">Menú Administrativo</h1>
    <ul class="space-y-4">
      <li>
        <Link :href="routes.products.index"
          class="block px-4 py-2 rounded-md bg-green-500  hover:bg-green-400 transition duration-200">
        Ver Productos
        </Link>
      </li>
     <!--  <li>
        <Link :href="routes.products.create"
          class="block px-4 py-2 rounded-md bg-green-500 hover:bg-green-400 transition duration-200">
        Cargar Producto
        </Link>
      </li> -->
      
    </ul>
  </div>
</template>
