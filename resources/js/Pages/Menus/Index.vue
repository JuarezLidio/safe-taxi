<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';

const props = defineProps({
    menus: {
        type: Object,
    },
});
</script>

<template>
    <AppLayout title="Dashboard - Menús">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10 flex flex-col">
                    <h1 class="text-2xl uppercase mb-3 font-bold">Listado de Menús</h1>
                    <DataTable
                        :data="menus"
                        :dataSelected="['name', 'menu_self.name','destination_url']"
                        :headerSelected="['Nombre', 'Menú padre', 'URL']"
                        :searchInput="['name']"
                        :routeCreate="'menus.create'"
                        :routeTrash="'menus.trash'"
                        :routeShow="{route: 'menus.show'}"
                        :routeEdit="{route: 'menus.edit'}"
                        :routeDestroy="{route: 'menus.destroy'}" />
                    </div>
            </div>
        </div>
    </AppLayout>
</template>
