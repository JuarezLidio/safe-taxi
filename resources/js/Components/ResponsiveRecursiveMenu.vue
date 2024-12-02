<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

</script>
<template>
    <div v-for="(item, index) in items" :key="item.id" :class="{ 'pb-2': level == 1 }" class="pt-2 space-y-1">
        <ResponsiveNavLink class="group" v-if="item.children" :href="item[url] ? route(item[url]) : ''" :active="item[url] ? route().current(item[url]) : false">
            <div class="flex items-center">
                <p>{{ item[target] }}</p>
                <i class="pi pi-angle-down pl-1 font-normal"></i>
            </div>
            <div
                class="hidden z-10 px-4 group-hover:block">
                <ResponsiveRecursiveMenu :items="item.children" :target="target" :url="url" :level="level + 1" />
            </div>
        </ResponsiveNavLink>
        <ResponsiveNavLink v-else  :href="route(item[url])" :active="route().current(item[url])">
            <p>{{ item[target] }}</p>
        </ResponsiveNavLink>
    </div>
</template>

<script>
export default {
    props: {
        items: Array,
        target: String,
        url: String,
        level: {
            type: Number,
            default: 1,
        },
    },
};

</script>
