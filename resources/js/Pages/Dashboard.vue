<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <h1 class="text-2xl font-bold mb-4">Lista de Productos</h1>
                              <table class="table-auto w-full">
                                <thead>
                                  <tr>
                                    <th class="border px-4 py-2">Nombre</th>
                                    <th class="border px-4 py-2">Precio</th>
                                    <th class="border px-4 py-2">Cantidad</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="producto in productos" :key="producto.id">
                                    <td class="border px-4 py-2">{{ producto.nombre }}</td>
                                    <td class="border px-4 py-2">${{ producto.precio }}</td>
                                    <td class="border px-4 py-2">{{ producto.cantidad }}</td>
                                  </tr>
                                </tbody>
                              </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
