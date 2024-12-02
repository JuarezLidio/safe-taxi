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
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl font-bold uppercase mb-3">Listado de Menús eliminados</h1>
                    <DataTable
                        :data="menus"
                        :dataSelected="['name', 'menu_self.name','destination_url']"
                        :headerSelected="['Nombre', 'Menú padre', 'URL']"
                        :searchInput="['name']"
                        :routeRestore="{route: 'menus.restore'}"
                        :routeDrop="{route: 'menus.drop'}"
                        :routeRestoreAll="{route: 'menus.restoreAll'}"
                        :routeDropAll="{route: 'menus.dropAll'}"
                        :routePrevious="'menus.index'"
                        :isTrash="true"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
