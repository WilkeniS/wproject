<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
<section class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md mt-6">
  <header>
    <h2 class="text-xl font-semibold text-gray-900">Actualizar Contraseña</h2>
    <p class="mt-1 text-sm text-gray-600">
      Asegúrate de que tu cuenta use una contraseña larga y segura.
    </p>
  </header>

  <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
    <!-- Contraseña actual -->
    <div>
      <InputLabel for="current_password" value="Contraseña Actual" />
      <TextInput
        id="current_password"
        ref="currentPasswordInput"
        v-model="form.current_password"
        type="password"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
        autocomplete="current-password"
      />
      <InputError class="mt-2 text-red-500 text-sm italic" :message="form.errors.current_password" />
    </div>

    <!-- Nueva contraseña -->
    <div>
      <InputLabel for="password" value="Nueva Contraseña" />
      <TextInput
        id="password"
        ref="passwordInput"
        v-model="form.password"
        type="password"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
        autocomplete="new-password"
      />
      <InputError class="mt-2 text-red-500 text-sm italic" :message="form.errors.password" />
    </div>

    <!-- Confirmar nueva contraseña -->
    <div>
      <InputLabel for="password_confirmation" value="Confirmar Contraseña" />
      <TextInput
        id="password_confirmation"
        v-model="form.password_confirmation"
        type="password"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
        autocomplete="new-password"
      />
      <InputError class="mt-2 text-red-500 text-sm italic" :message="form.errors.password_confirmation" />
    </div>

    <!-- Botón guardar -->
    <div class="flex items-center gap-4 mt-4">
      <PrimaryButton
        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md"
        :disabled="form.processing"
      >
        Guardar
      </PrimaryButton>

      <Transition
        enter-active-class="transition ease-in-out"
        enter-from-class="opacity-0"
        leave-active-class="transition ease-in-out"
        leave-to-class="opacity-0"
      >
        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Guardado.</p>
      </Transition>
    </div>
  </form>
</section>
</template>
