<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
<section class="space-y-6 max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md mt-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">Eliminar Cuenta</h2>
        <p class="mt-1 text-sm text-gray-600">
            Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Antes de eliminar tu cuenta, descarga cualquier información que desees conservar.
        </p>
    </header>

    <DangerButton @click="confirmUserDeletion" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
        Eliminar Cuenta
    </DangerButton>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                ¿Estás seguro de eliminar tu cuenta?
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Todos los recursos y datos se eliminarán permanentemente. Por favor ingresa tu contraseña para confirmar la eliminación.
            </p>

            <div class="mt-6">
                <InputLabel for="password" value="Contraseña" class="sr-only" />
                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                    placeholder="Contraseña"
                    @keyup.enter="deleteUser"
                />
                <InputError :message="form.errors.password" class="mt-2 text-red-500 text-sm italic" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <SecondaryButton @click="closeModal">
                    Cancelar
                </SecondaryButton>

                <DangerButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="deleteUser"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md"
                >
                    Eliminar Cuenta
                </DangerButton>
            </div>
        </div>
    </Modal>
</section>
</template>
