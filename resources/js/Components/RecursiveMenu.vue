<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>
<template>
    <div v-for="(item, index) in items" :key="item.id" class="hidden space-x-8 sm:-my-px  sm:flex">
        <NavLink class="group" v-if="item.children" :href="item[url] ? route(item[url]) : ''" :active="item[url] ? route().current(item[url]) : false">
            <div>
                <div class="flex">
                    <p>{{ item[target] }}</p>
                    <i class="pi pi-angle-down pl-1 font-normal"></i>
                </div>
                <div
                    class="invisible absolute z-10 flex flex-col bg-slate-50 mt-5 py-1 px-4 text-gray-800 shadow-xl group-hover:visible">
                    <RecursiveMenu :items="item.children" :target="target" :url="url" :level="level + 1" />
                </div>
            </div>
        </NavLink>
        <NavLink v-else :href="route(item[url])" :active="route().current(item[url])">
            <p>{{ item[target] }}</p>
        </NavLink>
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
