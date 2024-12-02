<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import { computed } from 'vue';

const props = defineProps({
  drivers: {
    type: Object,
    required: true,
  },
});

const drivers = computed(() => {
  return props.drivers.map(driver => {
    return {
      ...driver,
      is_actived: driver.is_actived == 1 ? 'Activo' : 'Inactivo',
    };
  });
});

</script>

<template>
    <AppLayout title="Dashboard - Conductores">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10">
                    <h1 class="text-2xl font-bold uppercase mb-3">Listado de Conductores eliminados</h1>
                    <DataTable
                        :data="drivers"
                        :dataSelected="['full_name','surnames','is_actived','photo']"
                        :headerSelected="['Nombre','Apellidos','Estado','Foto']"
                        :searchInput="['full_name']"
                        :routeRestore="{route: 'drivers.restore'}"
                        :routeDrop="{route: 'drivers.drop'}"
                        :routeRestoreAll="{route: 'drivers.restoreAll'}"
                        :routeDropAll="{route: 'drivers.dropAll'}"
                        :routePrevious="'drivers.index'"
                        :isTrash="true"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
