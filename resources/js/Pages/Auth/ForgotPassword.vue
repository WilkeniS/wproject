<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Restablecer contraseña | WSYSTEM" />

        <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow-md">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <Link href="/">
                    <ApplicationLogo class="h-24 w-24" />
                </Link>
            </div>

            <!-- Título y descripción -->
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">¿Olvidaste tu contraseña?</h1>
            <p class="text-center text-gray-500 mb-6">
                No hay problema. Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.
            </p>

            <!-- Mensaje de estado -->
            <div v-if="status" class="mb-4 text-sm font-medium text-green-600 text-center">
                {{ status }}
            </div>

            <!-- Formulario -->
            <form @submit.prevent="submit" class="space-y-4">
                <!-- Email -->
                <div>
                    <InputLabel for="email" value="Correo electrónico" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2 text-red-500 text-sm italic" :message="form.errors.email" />
                </div>

                <!-- Botones -->
                <div class="mt-6 flex flex-col md:flex-row items-center justify-between gap-2">
                    <PrimaryButton
                        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md w-full md:w-auto"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Enviar enlace
                    </PrimaryButton>

                    <Link
                        href="/login"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-center w-full md:w-auto"
                    >
                        Volver al inicio
                    </Link>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
