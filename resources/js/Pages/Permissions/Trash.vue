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
    <AppLayout title="Dashboard - Permissions">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl uppercase font-bold mb-3">Listado de Permisos eliminados</h1>
                    <DataTable
                        :data="permissions"
                        :dataSelected="['permission_self.alias','alias']"
                        :headerSelected="['Permiso Padre','Alias']"
                        :searchInput="['permission_self.alias', 'alias']"
                        :routeRestore="{route: 'permissions.restore'}"
                        :routeDrop="{route: 'permissions.drop'}"
                        :routeRestoreAll="{route: 'permissions.restoreAll'}"
                        :routeDropAll="{route: 'permissions.dropAll'}"
                        :routePrevious="'permissions.index'"
                        :isTrash="true"/>
                    </div>
            </div>
        </div>
    </AppLayout>
</template>
