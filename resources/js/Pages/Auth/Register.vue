<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Registro | WSYSTEM" />

        <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow-md">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <Link href="/">
                    <ApplicationLogo class="h-24 w-24" />
                </Link>
            </div>

            <!-- Título -->
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">Crear cuenta</h1>
            <p class="text-center text-gray-500 mb-6">Ingresa tus datos para registrarte</p>

            <form @submit.prevent="submit" class="space-y-4">
                <!-- Nombre -->
                <div>
                    <InputLabel for="name" value="Nombre" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2 text-red-500 text-sm italic" :message="form.errors.name" />
                </div>

                <!-- Email -->
                <div>
                    <InputLabel for="email" value="Correo electrónico" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />
                    <InputError class="mt-2 text-red-500 text-sm italic" :message="form.errors.email" />
                </div>

                <!-- Contraseña -->
                <div>
                    <InputLabel for="password" value="Contraseña" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2 text-red-500 text-sm italic" :message="form.errors.password" />
                </div>

                <!-- Confirmar Contraseña -->
                <div>
                    <InputLabel for="password_confirmation" value="Confirmar contraseña" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2 text-red-500 text-sm italic" :message="form.errors.password_confirmation" />
                </div>

                <!-- Botón y enlace -->
                <div class="mt-6 flex flex-col md:flex-row items-center justify-between gap-2">
                    <PrimaryButton
                        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md w-full md:w-auto"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Registrarse
                    </PrimaryButton>

                    <Link
                        href="/login"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-center w-full md:w-auto"
                    >
                        ¿Ya tienes cuenta? Iniciar sesión
                    </Link>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
