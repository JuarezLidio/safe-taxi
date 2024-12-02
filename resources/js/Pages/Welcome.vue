<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { RiGooglePlayFill, RiAppleFill } from '@remixicon/vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="TAXISEGURO - IMOVEQROO" />
    <!--div class="w-screen animated-background h-screen bg-gradient-to-r from-blue-500 via-blue-500 to-indigo-500" ></div-->
    <div class="min-h-screen bg-[length:400%] animate-background-grad bg-gradient-to-tl from-principal-400 via-principal-600 to-principal-800 flex flex-col overflow-hidden">
        <nav class="mt-10 w-full flex items-center justify-between text-lg font-semibold">
            <div class="ml-5 w-[350px]">
                <Link :href="'/'">
                    <img :src="'/images/imoveqroo-logo-blanco.png'" alt="Home">
                </Link>
            </div>
            <div v-if="canLogin" class="mr-10 flex gap-12 items-center">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')">Dashboard</Link>
                <template v-else>
                    <Link :href="route('login')" class="text-gray-100 hover:text-gray-200 active:text-gray-100">Iniciar sesión</Link>
                    <Link :href="route('register')" class="text-gray-100 hover:text-gray-200 active:text-gray-100">Registrate</Link>
                </template>
            </div>
        </nav>
        <div class="grow w-full flex">
            <div class="grow w-5/12 ml-10 flex flex-col justify-center items-start gap-4 mb-36 text-gray-100">
                <h2 class="tracking-tighter text-8xl font-black font-tiltwarp pb-6 bg-clip-text text-transparent bg-[linear-gradient(to_right,theme(colors.gray.100),theme(colors.gray.100),theme(colors.gray.100),theme(colors.gray.100),theme(colors.amber.200),theme(colors.amber.300),theme(colors.amber.200),theme(colors.gray.100),theme(colors.gray.100),theme(colors.gray.100),theme(colors.gray.100))] bg-[length:200%_auto] animate-text-light">TAXISEGURO</h2>
                <h2 class="font-black text-3xl pb-10 bg-clip-text text-transparent bg-[linear-gradient(to_right,theme(colors.gray.100),theme(colors.gray.100),theme(colors.gray.100),theme(colors.gray.100),theme(colors.amber.200),theme(colors.amber.300),theme(colors.amber.200),theme(colors.gray.100),theme(colors.gray.100),theme(colors.gray.100),theme(colors.gray.100))] bg-[length:200%_auto] animate-text-light">La mejor manera de realizar cada viaje: seguridad y transparencia al momento.</h2>

                <div class="flex gap-10 w-full pb-6">
                    <a href="" class="p-3 flex border rounded-lg hover:border-amber-400  hover:text-amber-400 active:text-amber-500">
                        <RiGooglePlayFill :size="'42'"/>
                        <div class="flex justify-center flex-col pl-3">
                            <p class="text-[10px]">Disponible en</p>
                            <p class="font-bold text-lg -mt-2">Google Play</p>
                        </div>
                    </a>
                    <a href="" class="p-3 flex border rounded-lg hover:border-amber-400  hover:text-amber-400  active:text-amber-500">
                        <RiAppleFill :size="'42'"/>
                        <div class="flex justify-center flex-col pl-3">
                            <p class="text-[10px]">Disponible en</p>
                            <p class="font-bold text-lg -mt-2">Apple Store</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="grow w-7/12  flex items-center justify-end">
                <img class="w-full " :src="'/images/taxi-foto.png'" alt="Taxi" />
            </div>
        </div>
    </div>
</template>

<style></style>
