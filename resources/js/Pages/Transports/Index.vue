<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import { computed } from 'vue';

const props = defineProps({
  transports: {
    type: Object,
    required: true,
  },
});

const transports = computed(() => {
  return props.transports.map(transports => {
    return {
      ...transports,
      is_actived: transports.is_actived == 1 ? 'Activo' : 'Inactivo'
    };
  });
});

</script>

<template>
    <AppLayout title="Dashboard - Transports">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-10 flex flex-col">
                    <h1 class="text-2xl uppercase mb-3 font-bold">Listado de transportes</h1>
                    <DataTable
                        :data="transports"
                        :dataSelected="['model','sub_model','car_plate','brand','sub_brand','economic_number','is_actived']"
                        :headerSelected="['Modelo','Submodelo','Matrícula','Marca','Submarca','Número económico','Estado']"
                        :searchInput="['car_plate']"
                        :routeCreate="'transports.create'"
                        :routeTrash="'transports.trash'"
                        :routeShow="{route: 'transports.show'}"
                        :routeEdit="{route: 'transports.edit'}"
                        :routeDestroy="{route: 'transports.destroy'}" />
                    </div>
            </div>
        </div>
    </AppLayout>
</template>
