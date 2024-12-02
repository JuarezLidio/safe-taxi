<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  bg-principal-500 hover:bg-principal-600 focus:bg-principal-600 active:bg-principal-800 focus:outline-none focus:ring-2 focus:ring-principal-600 focus:ring-offset-2 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
