<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';

const props = defineProps({
    permissions: {
        type: Object,
    },
});
</script>

<template>
    <AppLayout title="Dashboard - Permisos">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl font-bold uppercase mb-3">Listado de Permisos</h1>
                    <DataTable
                        :data="permissions"
                        :dataSelected="['permission_self.alias','alias']"
                        :headerSelected="['Permiso Padre','Alias']"
                        :searchInput="['permission_self.alias', 'alias']"
                        :routeCreate="'permissions.create'"
                        :routeTrash="'permissions.trash'"
                        :routeShow="{route: 'permissions.show'}"
                        :routeEdit="{route: 'permissions.edit'}"
                        :routeDestroy="{route: 'permissions.destroy'}" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
