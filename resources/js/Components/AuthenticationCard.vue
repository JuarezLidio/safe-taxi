<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    regLog: {
        type: Boolean,
        default: false
    },
    link: {
        type: String,
        default: '#'
    },
    reg: {
        type: String,
        default: 'sm:max-w-md'
    }
})
</script>


<template>
    <div class="min-h-screen bg-gray-100 flex flex-col sm:flex-row">
        <div class="z-10 absolute w-[350px] mt-10 ml-5">
            <slot name="logo" />
        </div>
        <div class="flex-1 flex justify-center items-center"> <!-- Añadimos justify-center e items-center aquí -->
            <div :class="`w-full ${reg} mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg bg-white z-10`">
                <slot />
            </div>
        </div>
        <Link
            class="absolute ml-10 mb-10 bottom-0 text-principal-500 hover:text-principal-600 font-black active:text-principal-800"
            :href="'/'">
        <div class="flex items-center"> <!-- Contenedor flex para alinear elementos -->
            <svg class="w-7 fill-principal-500 hover:fill-principal-600 active:fill-principal-800"
                style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <polygon points="352,128.4 319.7,96 160,256 160,256 160,256 319.7,416 352,383.6 224.7,256 " />
            </svg>
            <p class="-m-1">Inicio</p>
        </div>
        </Link>
    </div>

    <div v-if="regLog" class="absolute h-full w-1/2 bottom-0 bg-principal-800 right-0"></div></template>
