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
      photo: driver.photo ? driver.photo : 'No contiene foto',
    };
  });
});
</script>

<template>
    <AppLayout title="Dashboard - Drivers">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10 flex flex-col">
                    <h1 class="text-2xl uppercase mb-3 font-bold">Listado de Conductores</h1>
                    <DataTable
                        :data="drivers"
                        :dataSelected="['full_name','surnames','is_actived','photo']"
                        :headerSelected="['Nombre','Apellidos','Estado','Foto']"
                        :searchInput="['full_name','surnames']"
                        :routeCreate="'drivers.create'"
                        :routeTrash="'drivers.trash'"
                        :routeShow="{route: 'drivers.show'}"
                        :routeEdit="{route: 'drivers.edit'}"
                        :routeDestroy="{route: 'drivers.destroy'}" />
                    </div>
            </div>
        </div>
    </AppLayout>
</template>

