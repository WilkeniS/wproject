<template>
    <div>
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
  </template>
  
  <script setup>
  defineProps({
    productos: Array
  })
  </script>
  