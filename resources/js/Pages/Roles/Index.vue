<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';

const props = defineProps({
    roles: {
        type: Object,
    },
});
</script>

<template>
    <AppLayout title="Dashboard - Roles">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl font-bold uppercase mb-3">Listado de Roles</h1>
                    <DataTable
                        :data="roles"
                        :dataSelected="['name']"
                        :headerSelected="['Nombre']"
                        :searchInput="['name']"
                        :routeCreate="'roles.create'"
                        :routeTrash="'roles.trash'"
                        :routeShow="{route: 'roles.show'}"
                        :routeEdit="{route: 'roles.edit'}"
                        :routeDestroy="{route: 'roles.destroy'}" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
